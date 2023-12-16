<?php
$folder = '/Applications/XAMPP/xamppfiles/htdocs/ase230/delicious-master';
if (isset($_GET['file'])) {
    $filename = $_GET['file'];
    $filepath = $folder . '/' . $filename;
    
    if (file_exists($filepath)) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newContent = $_POST['content'];
            file_put_contents($filepath, $newContent);
            echo 'File updated successfully.';
        } else {
            $content = file_get_contents($filepath);
            echo '<h1>Edit File: ' . $filename . '</h1>';
            echo '<form method="post">';
            echo '<textarea name="content" rows="10" cols="50">' . $content . '</textarea><br>';
            echo '<input type="submit" value="Save">';
            echo '</form>';
        }
    } else {
        echo 'File not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
