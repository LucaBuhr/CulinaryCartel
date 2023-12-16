<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'CMS';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

function getPrimaryKey($conn, $table) {
    $sql = "SHOW KEYS FROM " . $conn->real_escape_string($table) . " WHERE Key_name = 'PRIMARY'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Column_name'];
    }
    return null;
}

function getFieldType($fieldType) {
    switch ($fieldType) {
        case 'int':
            return 'i'; 
        case 'tinyint':
        case 'varchar':
        case 'text':
        default:
            return 's'; 
    }
}

function generateEditForm($conn, $table) {
    $primaryKey = getPrimaryKey($conn, $table);
    if (!$primaryKey) {
        echo "No primary key found for table: $table";
        return;
    }

    $sql = "SELECT * FROM " . $conn->real_escape_string($table);
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $fieldInfoArray = $result->fetch_fields();
        echo "<form method='post'>";
        echo "<table border='1'><thead><tr>";

        foreach ($fieldInfoArray as $fieldInfo) {
            echo "<th>" . htmlspecialchars($fieldInfo->name) . "</th>";
        }
        echo "<th>Actions</th></tr></thead><tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($fieldInfoArray as $fieldInfo) {
                $field = $fieldInfo->name;
                echo "<td>";
                if ($field === $primaryKey) {
                    echo htmlspecialchars($row[$field]);
                    echo "<input type='hidden' name='id[]' value='" . htmlspecialchars($row[$field]) . "'>";
                } else {
                    echo "<input type='text' name='{$field}[]' value='" . htmlspecialchars($row[$field]) . "'>";
                }
                echo "</td>";
            }
            echo "<td><input type='submit' name='update[]' value='Update'></td>";
            echo "</tr>";
        }
        echo "</tbody></table></form>";
    } else {
        echo "No records found";
    }
}

if (isset($_GET['table'])) {
    $table = $_GET['table']; 
    generateEditForm($conn, $table);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $primaryKey = getPrimaryKey($conn, $_GET['table']);
    if (!$primaryKey || !isset($_POST['id'])) {
        echo "Error: ID array or primary key is missing.";
        exit;
    }

    $tableStructureResult = $conn->query("DESCRIBE " . $conn->real_escape_string($_GET['table']));
    if (!$tableStructureResult) {
        die("Error getting table structure: " . $conn->error);
    }

    $fieldInfoArray = [];
    while ($fieldInfo = $tableStructureResult->fetch_assoc()) {
        $fieldInfoArray[$fieldInfo['Field']] = $fieldInfo['Type'];
    }

    foreach ($_POST['id'] as $index => $id) {
        $updateCols = [];
        $types = 'i'; 
        $params = [$id]; 

        foreach ($_POST as $key => $values) {
            if ($key != 'id' && $key != 'update') {
                $updateCols[] = "$key = ?";
                $types .= getFieldType($fieldInfoArray[$key]);
                $params[] = $values[$index];
            }
        }

        $sql = "UPDATE " . $conn->real_escape_string($_GET['table']) . " SET " . implode(', ', $updateCols) . " WHERE $primaryKey = ?";
        
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            echo "Error preparing query: " . $conn->error;
            continue;
        }

        $stmt->bind_param($types, ...$params);
        if (!$stmt->execute()) {
            echo "Error updating record with ID $id: " . $stmt->error . "<br>";
        } else {
            echo "Record with ID $id updated successfully.<br>";
        }
        $stmt->close();
    }
}

$conn->close();
?>
