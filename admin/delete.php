<?php
$folder = '/Applications/XAMPP/xamppfiles/htdocs/ase230/delicious-master';
if (isset($_GET['file'])) {
    $filename = $_GET['file'];
    $filepath = $folder . '/' . $filename;
    
    if (file_exists($filepath)) {
        if (unlink($filepath)) {
            echo 'File deleted successfully.';
        } else {
            echo 'Failed to delete the file.';
        }
    } else {
        echo 'File not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
