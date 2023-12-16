<?php
session_start();
$folder = '/Applications/XAMPP/xamppfiles/htdocs/ase230/delicious-master/';

if (isset($_GET['dir'])) {
    $dir = $_GET['dir'];
    $path = $folder . $dir;

    if (is_dir($path)) {
        echo "<h1>Contents of Directory: $dir</h1>";
        echo "<table border='1'>";
        echo "<tr><th>Filename</th><th>Actions</th></tr>";

        $files = scandir($path);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                echo "<tr>";
                echo "<td>$file</td>";
                echo "<td>";
                if (is_dir($path . '/' . $file)) {
                    echo "<a href='listDirectory.php?dir=$dir/$file'>Open Directory</a> ";
                } else {
                    echo "<a href='view.php?file=$dir/$file'>View</a> ";
                    echo "<a href='edit.php?file=$dir/$file'>Edit</a> ";
                    echo "<a href='delete.php?file=$dir/$file' onclick='return confirm(\"Are you sure you want to delete this file?\");'>Delete</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
        }

        echo "</table>";
    } else {
        echo "<p>Invalid directory.</p>";
    }
} else {
    echo "<p>No directory specified.</p>";
}

echo '<br><a href="admin.php">Back to Admin Page</a>';
?>
