<?php
session_start();

$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "CMS";

$conn = new mysqli($servername, $username_db, $password_db, $dbname);


if (!isset($_SESSION['username']) || !isset($_SESSION['userID'])) {
    header("Location: ../login.php");
    exit;
}

$userID = $_SESSION['userID'];

$isAdmin = false;
$stmt = $conn->prepare("SELECT isAdmin FROM Users WHERE userID = ?");
$stmt->bind_param("i", $userID);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $isAdmin = $row['isAdmin'] == 1;
}
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['recipe_title'];
    $description = $_POST['recipe_description'];
    $timeToCook = $_POST['time_to_cook'];
    $ingredients = $_POST['ingredients'];
    $directions = $_POST['directions'];
    $userID = $_SESSION['userID']; 
    $categoryID = $_POST['categoryID']; 

    $stmt = $conn->prepare("INSERT INTO Recipes (Title, Description, CookingTime, Ingredients, Instructions, PostingDate, UserID, CategoryID) VALUES (?, ?, ?, ?, ?, NOW(), ?, ?)");
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssssiii", $title, $description, $timeToCook, $ingredients, $directions, $userID, $categoryID);

    if ($stmt->execute()) {
        echo "Recipe added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

$conn->close();
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
    <title>Delicious - Food Blog Template | Receipe Post</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">

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
                    <form action="#" method="post">
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
                                    <li><a href="#">Hello World!</a></li>
                                    <li><a href="#">Welcome to Colorlib Family.</a></li>
                                    <li><a href="#">Hello Delicious!</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
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
                                        <li class="active"><a href="../common_resources/receipe-post.php">Receipe Post</a></li>
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
    <!-- ##### Header Area End ##### -->

    <!-- ##### Breadcumb Area Start ##### -->
    <div class="breadcumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/breadcumb3.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="breadcumb-text text-center">
                        <h2>Submit Your Recipe</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcumb Area End ##### -->

    <div class="receipe-post-area section-padding-80">

        <!-- Receipe Content Area -->
        <div class="receipe-content-area">
            <div class="container">

                <div class="row">
                    

                    
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8">
                        

                    
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="section-heading text-left">
                            <h3>New Recipe</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="contact-form-area">
                            <form action="receipe-post.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                <div class="col-12 col-lg-6">
                                    <select name="categoryID" class="form-control" required>
                                        <option value="1">Appetizer</option>
                                        <option value="2">Main Dish</option>
                                        <option value="3">Dessert</option>
                                    </select>
                                </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="recipe_title" placeholder="Recipe Title" required>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="recipe_description" placeholder="Recipe Description" required>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <input type="text" class="form-control" name="time_to_cook" placeholder="Time to Cook" required>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                    <textarea name="ingredients" class="form-control" placeholder="Ingredients" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <textarea name="directions" class="form-control" placeholder="Directions" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn delicious-btn mt-30" type="submit">Post Recipe</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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