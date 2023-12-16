<?php
if (isset($_GET['action']) || isset($_POST['action'])) {
    $action = isset($_GET['action']) ? $_GET['action'] : $_POST['action'];

    if ($action === 'edit') {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['index'])) {
                $index = $_POST['index'];

                $recipeData = json_decode(file_get_contents('../common_resources/recipes.json'), true);

                if (isset($recipeData[$index])) {
                    $recipeData[$index]['recipe_title'] = $_POST['recipe_title'];
                    $recipeData[$index]['recipe_description'] = $_POST['recipe_description'];
                    $recipeData[$index]['time_to_cook'] = $_POST['time_to_cook'];
                    $recipeData[$index]['ingredients'] = explode(PHP_EOL, $_POST['ingredients']);
                    $recipeData[$index]['directions'] = explode(PHP_EOL, $_POST['directions']);

                    file_put_contents('../common_resources/recipes.json', json_encode($recipeData, JSON_PRETTY_PRINT));

                    header('Location: recipes.php');
                    exit;
                } else {
                    echo "Recipe not found.";
                }
            } else {
                echo "Invalid request.";
            }
        }
    } elseif ($action === 'delete') {
        if (isset($_POST['index'])) {
            $index = $_POST['index'];

            $recipeData = json_decode(file_get_contents('../common_resources/recipes.json'), true);

            if (isset($recipeData[$index])) {
                unset($recipeData[$index]);

                $recipeData = array_values($recipeData);

                file_put_contents('../common_resources/recipes.json', json_encode($recipeData, JSON_PRETTY_PRINT));

                header('Location: recipes.php');
                exit;
            } else {
                echo "Recipe not found.";
            }
        }
    }
}
?>
