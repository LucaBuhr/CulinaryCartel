<?php
session_start(); 

$servername = "localhost";
$username = "root";
$password = '';
$dbname = "CMS";

$conn = new mysqli($servername, $username, $password, $dbname);


$recipeId = $_GET['id'] ?? 0; 
$sql = "SELECT Comments.CommentID, Comments.TextContent, Comments.PostingDate, Users.Username FROM Comments JOIN Users ON Comments.UserID = Users.UserID WHERE Comments.RecipeID = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $recipeId);
$stmt->execute();
$result = $stmt->get_result();

$isAdmin = false;

if (isset($_SESSION['userID'])) {
    $userId = $_SESSION['userID'];
    $userQuery = "SELECT isAdmin FROM Users WHERE UserID = ?";
    $userStmt = $conn->prepare($userQuery);
    $userStmt->bind_param("i", $userId);
    $userStmt->execute();
    $userResult = $userStmt->get_result();

    if ($userRow = $userResult->fetch_assoc()) {
        $isAdmin = $userRow['isAdmin'] == 1; // Assuming 'isAdmin' is a boolean or similar
    }
    $userStmt->close();
}
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
    <link rel="stylesheet" href="style.css">

    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .recipe-card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }

        .recipe-card h2 {
            font-size: 24px;
            margin: 0;
        }

        .recipe-card p {
            font-size: 16px;
        }
    </style>
</head>
<body>
<header class="header-area">

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
                                        <li class="active"><a href="../common_resources/about.php">About Us</a></li>
                                        <li><a href="../common_resources/receipe-post.php">Receipe Post</a></li>
                                        <li><a href="../common_resources/recipes.php">Recipes from Current Users</a></li>
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
    </header>
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    .<div class="breadcumb-text text-center">
                        <h2>Comments</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br></br>
    <div class="container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $date = new DateTime($row['PostingDate']);
            $formattedDate = $date->format('Y-m-d'); // Format as Year-Month-Day

            echo "<div class='recipe-card'>";
            echo "<p><strong>" . htmlspecialchars($row['Username']) . "</strong>: " . htmlspecialchars($row['TextContent']) . "</p>";
            echo "<p class='comment-date'>Posted on: " . htmlspecialchars($formattedDate) . "</p>";
            if ($isAdmin) {
                echo "<a href='delete_comment.php?comment_id=" . $row['CommentID'] . "'>Delete</a>"; // Delete link for each comment
            }
            echo "</div>";
        }
    } else {
        echo "<p>No comments found.</p>";
    }
    ?>
    <a href='recipes.php'>Back to Recipes</a>
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
    <!-- ##### Footer Area Start ##### -->

    <!-- ##### All Javascript Files ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script></body></body>
</html>


