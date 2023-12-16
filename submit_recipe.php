<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipeTitle = $_POST['recipe_title'];
    $recipeDescription = $_POST['recipe_description'];
    $timeToCook = $_POST['time_to_cook'];
    
    $ingredients = explode(PHP_EOL, $_POST['ingredients']);
    $directions = explode(PHP_EOL, $_POST['directions']);
    
    $newRecipe = array(
        'recipe_title' => $recipeTitle,
        'recipe_description' => $recipeDescription,
        'time_to_cook' => $timeToCook,
        'ingredients' => $ingredients,
        'directions' => $directions
    );

    $existingRecipes = json_decode(file_get_contents('../common_resources/recipes.json'), true);

    $existingRecipes[] = $newRecipe;

    file_put_contents('../common_resources/recipes.json', json_encode($existingRecipes, JSON_PRETTY_PRINT));

    header('Location: ../common_resources/recipes.php');
    exit;
}
?>
