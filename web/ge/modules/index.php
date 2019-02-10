<?php

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/nwn-model.php';
require_once '../library/functions.php';
require_once '../model/page-manager-model.php';

// Get the array of categories
$pages = getPages();

// var_dump($categories);
// exit;
// Build a navigation bar using the $categories array
$navList = buildNav($pages);

$action = filter_input(INPUT_POST, 'pgt');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'pgt');
    if ($action == NULL) {
        $action = 'Home';
    }
}

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}

switch ($action) {
    default :
		include '../view/404.php';
		break;
}
