<?php
$folder = '/Applications/XAMPP/xamppfiles/htdocs/ase230/delicious-master';
if (isset($_GET['file'])) {
    $filename = $_GET['file'];
    $filepath = $folder . '/' . $filename;
    
    if (file_exists($filepath)) {
        $content = file_get_contents($filepath);
        
        $cssPath = str_replace('.html', '.css', $filepath);
        $cssContent = '';
        if (file_exists($cssPath)) {
            $cssContent = file_get_contents($cssPath);
        }
        
        echo '<h1>View File: ' . $filename . '</h1>';
        
        echo '<style>' . $cssContent . '</style>';
        
        echo $content;
    } else {
        echo 'File not found.';
    }
} else {
    echo 'Invalid request.';
}
?>
