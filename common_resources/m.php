<?php
session_start();
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
    <!-- Preloader -->
    <div id="preloader">
        <i class="circle-preloader"></i>
        <img src="img/core-img/salad.png" alt="">
    </div>

    <!-- Search Wrapper -->
    <div class="search-wrapper">
        <!-- Close Btn -->
        <div class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="signup.php" method="post">
                        <input type="search" name="search" placeholder="Type any keywords...">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ##### Header Area Start ##### -->
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
                                        <li><a href="../common_resources/about.php">About Us</a></li>
                                        <li><a href="../common_resources/receipe-post.php">Receipe Post</a></li>
                                        <li  class="active"><a href="../common_resources/recipes.php">Recipes from Current Users</a></li>
                                        <li><a href="../common_resources/login.php">Login</a></li>
                                        <li><a href="../common_resources/signup.php">Sign Up</a></li>
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
    <!-- ##### Header Area End ##### -->
    
    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb1.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Recipes From Current Users</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    
    <div class="container">
    <?php


$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "CMS";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $recipeID = intval($_GET['id']);

    $sql = "SELECT * FROM Recipes WHERE RecipeID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipeID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $recipe = $result->fetch_assoc();

        echo "<h2>" . htmlspecialchars($recipe['Title']) . "</h2>";
        echo "<p>" . htmlspecialchars($recipe['Description']) . "</p>";
        echo "<p>Cooking Time: " . htmlspecialchars($recipe['CookingTime']) . "</p>";
        echo "<p>Ingredients:</p>";
        echo "<ul style='list-style-type: disc; margin-left: 20px;'>";
        $ingredients = explode(',', $recipe['Ingredients']);
        foreach ($ingredients as $ingredient) {
            echo "<li>" . htmlspecialchars(trim($ingredient)) . "</li>";
        }
        echo "</ul>";
        echo "<p>Directions:</p>";
        echo "<ol>";
        $directions = explode("\n", $recipe['Instructions']);
        foreach ($directions as $step) {
            echo "<li>" . htmlspecialchars($step) . "</li>";
        }
        echo "</ol>";
        echo "<a href='recipes.php'>Back to Recipes</a>";
    } else {
        echo "Recipe not found.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
</div>
    <!-- ##### Footer Area Start ##### -->
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
    <script src="js/active.js"></script>
</body>

</html>