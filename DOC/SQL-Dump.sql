-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 16, 2023 at 03:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`AdminID`, `Username`, `Email`, `Password`) VALUES
(1, 'orabio1', 'orabio1@mymail.nku.edu', '1234'),
(2, 'buhrmestel', 'buhrmestel@mymail.nku.edu', '12345'),
(3, 'Admin', 'Email', 'Password');

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `CategoryID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`CategoryID`, `Name`) VALUES
(1, 'Appetizers'),
(2, 'Main Dishes'),
(3, 'Desserts');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `CommentID` int(11) NOT NULL,
  `TextContent` text NOT NULL,
  `PostingDate` datetime NOT NULL,
  `UserID` int(11) NOT NULL,
  `RecipeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`CommentID`, `TextContent`, `PostingDate`, `UserID`, `RecipeID`) VALUES
(1, 'I like this dish', '2023-11-21 02:37:57', 1, 1),
(2, 'I like this dish a lot', '2023-11-21 02:37:57', 2, 2),
(3, 'I like this dish too', '2023-11-21 02:37:57', 3, 3),
(4, 'This dish looks cool!', '2023-12-08 15:23:11', 21, 1),
(11, 'I really like your recipe!', '2023-12-15 21:32:49', 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Recipes`
--

CREATE TABLE `Recipes` (
  `RecipeID` int(11) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `CookingTime` int(11) NOT NULL,
  `Ingredients` text NOT NULL,
  `Instructions` text NOT NULL,
  `PostingDate` datetime NOT NULL,
  `UserID` int(11) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Recipes`
--

INSERT INTO `Recipes` (`RecipeID`, `Title`, `Description`, `CookingTime`, `Ingredients`, `Instructions`, `PostingDate`, `UserID`, `CategoryID`) VALUES
(1, 'Cartel Burger', 'A homemade burger is a delicious and customizable culinary creation that starts with ground meat, usually beef, although variations can include chicken, turkey, or even plant-based options. This ground meat is seasoned to taste, often with a blend of salt, pepper, garlic, and other spices, and then formed into a patty. The patty is cooked to perfection, typically on a grill, stovetop, or in an oven, until it reaches the desired level of doneness.', 15, 'Ground beef patty,\r\nHamburger bun,\r\nSlice of cheese (e.g., cheddar or American),\r\nLettuce,\r\nTomato,\r\nOnion,\r\nPickles,\r\nKetchup,\r\nMustard,\r\nMayonnaise,\r\nSalt,\r\nPepper.', '1. Preheat grill or pan to medium-high heat,\r\n2. Season the beef patty with salt and pepper,\r\n3. Place the patty on the grill or pan,\r\n4. Cook for about 3-4 minutes on one side,\r\n5. Flip the patty and cook for another 3-4 minutes,\r\n5. Place a slice of cheese on the patty during the last minute of cooking,\r\n7.Toast the hamburger bun on the grill or pan,\r\n8. Apply ketchup, mustard, and mayonnaise on the bun,\r\n9. Place the cooked patty with cheese on the bun\'s bottom half,\r\n10. Add lettuce, tomato, onion, and pickles on top of the patty,\r\n11. Cover with the bun\'s top half,\r\n12. Serve hot.', '2023-11-21 02:34:43', 1, 2),
(2, 'Classic Bruschetta', 'Classic Bruschetta is a quintessential Italian appetizer that combines the freshness of ripe tomatoes with aromatic basil and garlic. This dish features a delightful contrast of textures: the crispness of lightly toasted baguette slices topped with a juicy mixture of diced tomatoes. The bruschetta is further enhanced with a drizzle of extra-virgin olive oil and a splash of balsamic vinegar, offering a harmonious blend of tangy and savory flavors. It\'s a simple yet elegant starter that\'s perfect for any occasion, embodying the essence of Mediterranean cuisine.', 10, 'Baguette (sliced),\r\nRipe tomatoes (diced),\r\nFresh basil leaves (chopped)\r\nGarlic clove (minced),\r\nExtra-virgin olive oil,\r\nBalsamic vinegar,\r\nSalt,\r\nPepper,', '1. Preheat the oven to 350°F (175°C),\r\n2. Combine diced tomatoes, basil, garlic, olive oil, balsamic vinegar, salt, and pepper in a bowl,\r\n3. Place baguette slices on a baking sheet,\r\n5. Toast in the oven for 5-6 minutes until slightly golden,\r\n6. Spoon the tomato mixture onto each toasted baguette slice,\r\n7. Serve immediately.\r\n', '2023-11-21 02:34:43', 2, 1),
(3, 'Lemon Herb Roasted Chicken', 'Lemon Herb Roasted Chicken is a classic main dish that offers a comforting and hearty meal. The chicken is lovingly prepared with a rub of olive oil, salt, and pepper, and then stuffed with fresh lemons and a bouquet of herbs such as rosemary, thyme, and parsley. These ingredients infuse the chicken with a bright, citrusy flavor and an irresistible aroma as it roasts to perfection. The result is a succulent and flavorful chicken with a golden, crispy skin, making it an ideal centerpiece for family dinners or special gatherings. It pairs wonderfully with a variety of side dishes, from roasted vegetables to mashed potatoes.', 60, 'Whole chicken\r\nFresh lemon, halved\r\nFresh herbs (rosemary, thyme, parsley)\r\nGarlic cloves\r\nOlive oil\r\nSalt\r\nBlack pepper.', '1. Preheat oven to 375°F (190°C),\r\n2. Rub the chicken with olive oil, salt, and pepper,\r\n3. Stuff the cavity with lemon halves, herbs, and garlic cloves,\r\n4. Place chicken in a roasting pan,\r\n5. Roast for about 1 hour and 20 minutes, or until the juices run clear,\r\n6. Let the chicken rest for 10 minutes before carving,\r\n7. Serve with a side of your choice.', '2023-11-21 02:34:43', 3, 2),
(4, 'Classic Chocolate Brownies', 'Classic Chocolate Brownies are the ultimate treat for chocolate lovers. These brownies strike the perfect balance between cakey and fudgy, with a rich and intense chocolate flavor that comes from the generous use of cocoa powder. The addition of vanilla extract enhances their sweet, chocolaty aroma. Optionally, incorporating chopped walnuts or chocolate chips adds a delightful crunch or extra chocolatey goodness. Once baked, these brownies have a crackly top and a moist, tender interior. They are incredibly versatile and can be enjoyed on their own, or dressed up with a scoop of ice cream or a drizzle of caramel for a more decadent dessert experience.', 35, 'Unsalted butter,\r\nGranulated sugar,\r\nCocoa powder,\r\nVanilla extract,\r\nEggs,\r\nAll-purpose flour,\r\nBaking powder,\r\nSalt,\r\nChopped walnuts or chocolate chips (optional)', '1. Preheat oven to 350°F (175°C),\r\n2. Melt butter in a saucepan, then remove from heat,\r\n3. Stir in sugar, cocoa, and vanilla,\r\n4. Beat in eggs one at a time,\r\n5. Combine flour, baking powder, and salt, then stir into the cocoa mixture,\r\n6. Fold in nuts or chocolate chips if using,\r\n7. Pour batter into a greased baking pan,\r\n8. Bake for 20-25 minutes until the center is set,\r\n9. Cool in the pan, then cut into squares,\r\n10. Serve as is or with a scoop of ice cream.', '2023-12-06 22:03:08', 21, 3),
(20, 'Classic Chocolate Chip Cookies', 'Crispy on the outside, chewy on the inside, these chocolate chip cookies are a timeless treat.', 25, '2 1/4 cups all-purpose flour,\r\n1/2 tsp baking soda,\r\n1 cup unsalted butter at room temperature,\r\n1/2 cup granulated sugar,\r\n1 cup packed brown sugar,\r\n1 tsp salt,\r\n2 tsp vanilla extract,\r\n2 large eggs,\r\n2 cups semisweet chocolate chips,', '1. Preheat the oven to 350°F (175°C).\r\n2. In a small bowl, whisk together flour and baking soda.\r\n3. In a large bowl, beat butter, granulated sugar, brown sugar, salt, and vanilla until creamy.\r\n4. Add eggs one at a time, beating well after each addition.\r\n5. Gradually beat in flour mixture. Stir in chocolate chips.\r\n6. Drop rounded tablespoonfuls of dough onto ungreased baking sheets.\r\n7. Bake for 8 to 10 minutes, or until golden brown.\r\n8. Cool on baking sheets for 2 minutes; remove to wire racks to cool completely.', '2023-12-14 15:54:16', 25, 3),
(21, 'Stuffed Mushrooms', 'These stuffed mushrooms are a delightful appetizer, perfect for any gathering. Each mushroom cap is filled with a savory mixture of cream cheese, garlic, and herbs, topped with breadcrumbs for a crunchy finish.', 30, '20 whole fresh mushrooms,\r\n1 tablespoon olive oil,\r\n1 tablespoon minced garlic,\r\n1 (8 oz) package cream cheese, softened,\r\n1/4 cup grated Parmesan cheese,\r\n1/4 teaspoon ground black pepper,\r\n1/4 teaspoon onion powder,\r\n1/4 teaspoon ground cayenne pepper,\r\n1/4 cup Italian seasoned breadcrumbs', '1', '2023-12-14 15:58:09', 25, 1),
(22, 'Grilled Lemon Garlic Salmon', 'A light and healthy main dish, this grilled lemon garlic salmon is both refreshing and flavorful. The salmon is marinated in a zesty blend of lemon, garlic, and herbs, then grilled to perfection. It\'s perfect for a summer evening dinner.', 45, '4 salmon fillets,\r\n2 lemons, thinly sliced,\r\n2 tablespoons olive oil,\r\n3 cloves garlic, minced,\r\n1 tablespoon lemon juice,\r\n1 tablespoon fresh dill, chopped,\r\nSalt and pepper, to taste', '1', '2023-12-14 15:58:57', 25, 2),
(23, 'Creamy Tomato Basil Soup', 'This creamy tomato basil soup is rich and comforting, with a velvety texture and a balance of acidity and sweetness from the tomatoes. The fresh basil adds a fragrant aroma, making it a perfect dish for any season.', 40, '1 tablespoon olive oil,\r\n1 onion, chopped,\r\n2 cloves garlic, minced,\r\n1 can (28 oz) crushed tomatoes,\r\n2 cups vegetable broth,\r\n1/2 cup heavy cream,\r\n1/4 cup fresh basil, chopped,\r\nSalt and pepper, to taste', '1', '2023-12-14 15:59:58', 25, 1),
(24, 'Classic Caesar Salad', 'This classic Caesar salad combines fresh romaine lettuce with a homemade dressing, crunchy croutons, and shaved Parmesan cheese. It\'s a timeless salad, perfect as a starter or a light meal.', 20, '3 cups romaine lettuce, chopped,\r\n1/2 cup croutons,\r\n1/4 cup Parmesan cheese, shaved,\r\nFor dressing: 1 egg yolk, 2 tablespoons lemon juice, 1 teaspoon Dijon mustard, 1 clove garlic, minced, 1/4 cup olive oil, Salt and pepper, to taste', '1', '2023-12-14 16:00:37', 25, 1),
(25, 'Fluffy Buttermilk Pancakes', 'These buttermilk pancakes are light, fluffy, and a little tangy, thanks to the buttermilk. Serve them with your favorite toppings, like maple syrup, fresh berries, or a dollop of whipped cream for a delightful breakfast.', 30, '2 cups all-purpose flour,\r\n2 tablespoons sugar,\r\n1 teaspoon baking powder,\r\n1/2 teaspoon baking soda,\r\n1/2 teaspoon salt,\r\n2 cups buttermilk,\r\n2 large eggs,\r\n4 tablespoons unsalted butter melted', '1', '2023-12-14 16:01:31', 25, 1),
(26, 'eggs on toast', 'eggs on toast', 15, 'eggs,\r\ntoast\r\n', '1', '2023-12-15 21:27:05', 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile picture` varchar(255) DEFAULT NULL,
  `Email` varchar(255) NOT NULL,
  `Bio` text DEFAULT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Username`, `password`, `profile picture`, `Email`, `Bio`, `isAdmin`) VALUES
(1, 'orabio1', '1234', 'pic1.jpg', 'orabio1@mymail.nku.edu', 'My name is Omar.', 0),
(2, 'buhrmestel', '12345', 'pic2.jpg', 'buhrmestel1@mymail.nku.edu', 'My name is Luca.', 0),
(3, 'person3', '123456', 'pic3.jpg', 'person3@mymail.nku.edu', 'I am person3.', 0),
(4, '1', '$2y$10$cnYDRZOerMbH/b2dCpir9.FSnF8rSV2Gow/nvavV19gMLOUmxcrhi', NULL, '1@1', NULL, 0),
(5, '2', '$2y$10$x7qJtyXWoWV3ZEL..CCCeOUIovS7LBb6VUHYZKp4V2yMeQUDmEUHO', NULL, '2@2', NULL, 0),
(6, '3', '$2y$10$Ki1SvKcZF4CxWHKST/C7RetQ4mF1WDr6lLzU6oyuxzzF/gq7Nwqvy', NULL, '3@3', NULL, 0),
(7, '4', '$2y$10$KiZgHG5gi.c4VYKsRpO81OSmFa4EFxF65.pru86vVYoY9cROA5ZVS', NULL, '4@4', NULL, 0),
(8, '5', '$2y$10$qrj/qQzFLjBK58iJDH.9wOzx7SzxnvZDMdHr.f8clrcJQTBI9QKWS', NULL, '5@5', NULL, 0),
(9, '6', '$2y$10$PhxY/DVeADkXqiOeYRBhbO3F2I89n4cFA0fg7zOt50nfC0qqkk2Oe', NULL, '6@6', NULL, 0),
(10, '7', '$2y$10$GyiQ7V0/bqkVYhJ7SiuU5u0KSlhL1/CYGuc3XFfZLnavtdilwsCHu', NULL, '7@7', NULL, 0),
(11, '8', '$2y$10$R2Ow4pQF.Bfuzv2mprtfnO2iCB3U.J9CH0P8wCd5J8S8j1yty4cpG', NULL, '8@8', NULL, 0),
(12, '9', '$2y$10$cnaFvjl6sSVHLvM9tvTzM.0P57MOXWeoFhHp7hmTdjI7jarTe.K0m', NULL, '9@9', NULL, 0),
(13, '10', '$2y$10$mDVGGQf1ZisQTWjBTmddcOxNd3wq1Ii0bRIdiAMEs2z/MKe6bgTDW', NULL, '10@10', NULL, 0),
(14, '12', '$2y$10$QkDJOBUD.FKoz/YboyvklehXOPpuDB2ZMAZG6PlwpKZo90fP6dW9.', NULL, '12@12', NULL, 0),
(15, '11', '$2y$10$AiIOlDB5gsIKnGplkbiEgedZIY3Ak/ClITFUq0jUPCc34DQMdlpua', NULL, '11@11', NULL, 0),
(16, '13', '$2y$10$N6vx5vhePyRHxawcpDNCTOZwUw96wF38Mtu8YsVP9gMbIAt/jQZcG', NULL, '13@13', NULL, 0),
(17, '14', '$2y$10$urKwKBCQnqWufuBcQD8D7es4LUpEZ3xi2A1XPW3O9m/5JG3HBP9Gi', NULL, '14@14', NULL, 0),
(18, '15', '$2y$10$pJdUSw.ehDtKpVzHc15D.e/IsuA/Iaaj3x3fEPPYjmQdka7/qa29i', NULL, '15@15', NULL, 0),
(19, 'omz', '$2y$10$JkeRI2cAEWjWFXXTyRHMOOm9CPzvMfcgL2nHZPm5bSWHaOXVl4Jze', NULL, 'omz@omz', NULL, 0),
(20, 'luc', '$2y$10$iWb6Lx13CFgBB8BPFL6zVOkPp8VW5H3FOA.yQ1Ror60EgYfIOJgZy', NULL, 'luc@l', NULL, 0),
(21, 'omar', '$2y$10$atxVMkbs/R.M2kxUGmnYoeMAtcYIUJjTH9NkZZJrcbcUm67ZdOL0O', NULL, 'omar@omar', 'My name is oma', 1),
(22, 'm', '$2y$10$xbdCZivVsaivliHkzgRzhujlIlRseX/aPaUKApR/KUWgg8ufYVzDO', NULL, 'm@m', NULL, 0),
(24, 'lucab', '$2y$10$QcBrx0.09A1nHqdwF8v5SeAc/KB4JLYIMg.JnkzEQJx3kTiP/pcRS', NULL, 'l@l', NULL, 0),
(25, 'r', '$2y$10$bg2IUW48596FX1tQAf7c.ujBLOUnYUR4YkqMzs1si8WurvThMcvp6', NULL, 'r@r', NULL, 0),
(26, 'e', '$2y$10$BWWfa.oWrmo9W9l4bmx1QuJ8EPd7s73MrupN7RuxFJM6zsEqxk0l6', NULL, 'e@e', NULL, 0),
(28, 'mark', '$2y$10$gqXaEfezCRjtEms/JNppI..Lmo0bCEHaY43Jv0CtM02Lhlcr.fFIG', NULL, 'mark@mark', NULL, 0),
(29, 'rob', '$2y$10$5HLPlNNMX4K/Ll30aeH/HOeo9fM8AaBAMiIn.3NPc.mHFg2btSvrO', NULL, 'rob@gmail.com', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`CommentID`);

--
-- Indexes for table `Recipes`
--
ALTER TABLE `Recipes`
  ADD PRIMARY KEY (`RecipeID`),
  ADD KEY `ID to CAT` (`CategoryID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Recipes`
--
ALTER TABLE `Recipes`
  MODIFY `RecipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Recipes`
--
ALTER TABLE `Recipes`
  ADD CONSTRAINT `ID to CAT` FOREIGN KEY (`CategoryID`) REFERENCES `Categories` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
