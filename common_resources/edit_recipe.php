<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'CMS';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("Database Connection Error: " . $conn->connect_error);
}

function generateEditForm($conn, $table) {
    $sql = "SELECT * FROM " . $conn->real_escape_string($table);
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form method='post'>";
        echo "<table border='1'>";
        echo "<thead><tr>";

        $fieldInfoArray = $result->fetch_fields();
        foreach ($fieldInfoArray as $fieldInfo) {
            echo "<th>" . ucfirst($fieldInfo->name) . "</th>";
        }
        echo "<th>Actions</th>";
        echo "</tr></thead><tbody>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $field => $value) {
                echo "<td>";
                if ($field != 'id') {
                    echo "<input type='text' name='{$field}[]' value='" . htmlspecialchars($value) . "'>";
                } else {
                    echo htmlspecialchars($value);
                    echo "<input type='hidden' name='id[]' value='" . htmlspecialchars($value) . "'>";
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
    if (!isset($_POST['id'])) {
        echo "Error: ID array is missing.";
        exit;
    }

    var_dump($_POST);

    $tableStructureSql = "DESCRIBE " . $conn->real_escape_string($_GET['table']);
    $tableStructureResult = $conn->query($tableStructureSql);
    if (!$tableStructureResult) {
        die("Error getting table structure: " . $conn->error);
    }

    $fieldInfoArray = $tableStructureResult->fetch_fields();

    foreach ($_POST['id'] as $i => $id) {
        $updateCols = [];
        $types = '';
        $params = [];

        foreach ($_POST as $key => $values) {
            if ($key != 'id' && $key != 'update') {
                $updateCols[] = "$key = ?";
                $types .= determineType($key, $fieldInfoArray);
                $params[] = $values[$i];
            }
        }

        array_push($params, $id);
        $types .= 'i';

        $sql = "UPDATE " . $conn->real_escape_string($_GET['table']) . " SET " . implode(', ', $updateCols) . " WHERE id = ?";
        
        echo "SQL Query: $sql<br>";
        echo "Types: $types<br>";

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
