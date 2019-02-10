<?php

// Create or access a Session
// session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/cs/ge/library/dbConnect.php';
// require_once 'model/nwn-model.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/cs/ge/library/functions.php';
// require_once 'model/page-manager-model.php';

// Get the array of categories
$pages = getPages();

// var_dump($categories);
// exit;
// Build a navigation bar using the $categories array
$navList = buildNav($pages);

$action = filter_input(INPUT_POST, 'cat');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'cat');
    if ($action == NULL) {
        $action = 'Home';
    }
}

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'home':
    case 'Home':
        include 'pages/home.php';
        break;
    default:
        $page_data = getCategoryPageById($action);
        $page_title = $page_data['name'];
        $recipes = getRecipesByCategoryId($action);
        include $page_data['file'];
        $recipes = '';
        break;
}
