<?php

// Create or access a Session
// session_start();

$is_dev = strpos($_SERVER['DOCUMENT_ROOT'], 'mappstack') ? '/cs' : '';
$path = $is_dev ? $_SERVER['DOCUMENT_ROOT'] . '/cs/ge' : $_SERVER['DOCUMENT_ROOT'] . '/ge';
$relative_path = $is_dev ? '/cs/ge/' : '/ge/';

require_once $path . '/library/dbConnect.php';
require_once $path . '/library/functions.php';

// Get the array of categories
$pages = getPages();

// Build a navigation bar using the $categories array
$navList = buildNav($pages);

$function = filter_input(INPUT_POST, 'f');
if(!$function) {
    $function = filter_input(INPUT_GET, 'f');
    if(!$function){
        $function = 'categories';
    }
}

$action = filter_input(INPUT_POST, 'a');
if (!$action) {
    $action = filter_input(INPUT_GET, 'a');
    if (!$action) {
        $action = 'home';
    }
}

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}
switch ($function){
    case 'categories':
        switch ($action) {
            case 'home':
            case 'Home':
                include 'pages/home.php';
                break;
            default:
                $page_data = getCategoryPageById($action);
                if(!$page_data)
                    header("Location: " . $relative_path);
                $page_title = $page_data['name'];
                $recipes = getRecipesByCategoryId($action);
                include 'pages/categories.php';
                $recipes = '';
                break;
        }
        break;
    case 'recipes':
        switch ($action) {
            case 'home':
            case 'Home':
                header("Location: " . $relative_path);
                break;
            default:
                $recipe_data = getRecipeById($action);
                if(!$recipe_data)
                    header("Location: " . $relative_path);
                include 'pages/recipe_template.php';
                break;
        }
        break;
}

