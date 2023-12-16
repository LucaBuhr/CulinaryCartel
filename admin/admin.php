
<?php
session_start();
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'CMS';

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$folder = '/Applications/XAMPP/xamppfiles/htdocs/ase230/delicious-master/';
$files = scandir($folder);
$files = array_diff($files, array('.', '..'));

$isAdmin = false;
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT isAdmin FROM Users WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $isAdmin = $row['isAdmin'] == 1;
    }
    $stmt->close();
}

$tables = [];
$result = $conn->query("SHOW TABLES");
while ($row = $result->fetch_array()) {
    $tables[] = $row[0];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newFileName = $_POST['newFileName'];
    $newFileContent = $_POST['newFileContent'];

    $newFilePath = $folder . '/' . $newFileName;

    if (file_put_contents($newFilePath, $newFileContent) !== false) {
        echo 'File created successfully.';
    } else {
        echo 'Failed to create the file.';
    }
}
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Delicious - Food Blog Template | About</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="/Applications/XAMPP/xamppfiles/htdocs/ase230/delicious-master/style.css">
    

</head>
<body>
     <!-- Top Header Area -->
     <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center justify-content-between">
                    <!-- Breaking News -->
                    <div class="col-12 col-sm-6">
                        <div class="breaking-news">
                            <div id="breakingNewsTicker" class="ticker">
                                <ul>
                                <li><a href="#">Flavor Bosses Unite</a></li>
                                <li><a href="#">Culinary Cartel 'til We Bite</a></li>                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Top Social Info -->
                    
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="delicious-main-menu">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="deliciousNav">

                        <!-- Logo -->
                        <a class="nav-brand" href="index.html"><img src="img/core-img/logo.png" alt=""></a>

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                            <ul>
                                <li><a href="/ase230/delicious-master/user_pages/user_<?php echo $_SESSION['username']; ?>.php">Home</a></li>
                                <li><a href="../common_resources/user_profile.php">User Profile</a></li>
                                        <li><a href="../common_resources/about.php">About Us</a></li>
                                        <li><a href="../common_resources/receipe-post.php">Receipe Post</a></li>
                                        <li  class="active"><a href="../common_resources/recipes.php">Recipes from Current Users</a></li>
                                        <li><a href="../common_resources/recipebycat.php">Recipes by Category</a></li>
                                        <?php if ($isAdmin): ?>
                                            <li><a href="/ase230/delicious-master/admin/admin.php">Admin Panel</a></li>
                                        <?php endif; ?>

                                        
                                        <?php
                    if (isset($_SESSION['username'])) {
                        echo '<li><a href="/ase230/delicious-master/ContentManagementSystem.php">Sign Out</a></li>';
                    }
                    ?>
                                    </li>
                                    
                                </ul>

                                <!-- Newsletter Form -->
                                <div class="search-btn">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>

                            </div>
                            <!-- Nav End -->
                        </div>
                    </nav>
                </div>
            </div>
        </div>

    <div class="container" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
        <div style="flex: 1; margin-right: 20px;">
            <h2>File Management</h2>
            <table border="1">
    <tr><th>Filename</th><th>Type</th><th>Actions</th></tr>
    <?php foreach ($files as $filename): ?>
        <tr>
            <td><?php echo htmlspecialchars($filename); ?></td>
            <td><?php echo is_dir($folder . $filename) ? 'Directory' : 'File'; ?></td>
            <td>
                <?php if (is_dir($folder . $filename)): ?>
                    <a href='listDirectory.php?dir=<?php echo urlencode($filename); ?>'>Open Directory</a>
                <?php else: ?>
                    <a href='view.php?file=<?php echo urlencode($filename); ?>'>View</a>
                    <a href='edit.php?file=<?php echo urlencode($filename); ?>'>Edit</a>
                    <a href='delete.php?file=<?php echo urlencode($filename); ?>'>Delete</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
        </div>
        <style>
<?php echo file_get_contents('style1.css'); ?>
</style>
        <div style="flex: 1;">
            <h2>Database Tables</h2>
            <table border="1">
                <tr><th>Table Name</th><th>Actions</th></tr>
                <?php foreach ($tables as $table): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($table); ?></td>
                        <td>
                            <a href='viewTable.php?table=<?php echo urlencode($table); ?>'>View</a>
                            <a href='editTable.php?table=<?php echo urlencode($table); ?>'>Edit</a>
                            <a href='deleteTable.php?table=<?php echo urlencode($table); ?>'>Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>

    <!-- Form for creating a new file -->
    <div class="container" style="flex: 1;">
        <h2>Create New File</h2>
        <form method="post">
                <label for="newFileName">New File Name:</label>
                <input type="text" name="newFileName" required><br>
                <label for="newFileContent">File Content:</label>
                <textarea name="newFileContent" rows="10" cols="50"></textarea><br>
                <input type="submit" value="Create File">
            </form>
    </div>
    <footer class="footer-area">
        <div class="container h-100">
            <div class="row h-100">
                <div class="col-12 h-100 d-flex flex-wrap align-items-center justify-content-between">
                    <!-- Footer Social Info -->
                    
                    <!-- Footer Logo -->
                    <div class="footer-logo">
                        <a href="index.html"><img src="img/core-img/logo.png" alt=""></a>
                    </div>
                    <!-- Copywrite -->
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>  
    </footer>

    <!-- Footer, Scripts, etc., as in your provided structure -->
    <footer class="footer-area">
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="../js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="../js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="../js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="../js/active.js"></script>    </footer>
    <script src="../js/jquery/jquery-2.2.4.min.js"></script>
    <!-- More scripts as needed -->
</body>
</html>
