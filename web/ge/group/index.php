<?php

// Create or access a Session
// session_start();

$is_dev = strpos($_SERVER['DOCUMENT_ROOT'], 'mappstack') ? '/cs' : '';
$path = $is_dev ? $_SERVER['DOCUMENT_ROOT'] . '/cs/ge' : $_SERVER['DOCUMENT_ROOT'] . '/ge';
$relative_path = $is_dev ? '/cs/ge/group/' : '/ge/group/';

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
        $function = 'week';
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
    case 'week':
        switch ($action) {
            case 'home':
            case 'Home':
            default:
                include 'home.php';
                break;
        }
        break;
    case 'updateScriptureTopic':
        $update_data = [
            'book' => htmlspecialchars($_POST['book']),
            'chapter' => htmlspecialchars($_POST['chapter']),
            'verse' => htmlspecialchars($_POST['verse']),
            'content' => htmlspecialchars($_POST['content']),
        ];
        $scripture_id = updateScripture($update_data);
        if($_POST['new_topic'] && $_POST['new_topic_name']){
            $topic_name = htmlspecialchars($_POST['new_topic_name']);
            $_POST['topic'][] = updateTopic($topic_name);
        }
        foreach($_POST['topic'] as $topic){
            $topic = htmlspecialchars($topic);
            updateScriptureTopic($topic, $scripture_id);
        }
        include 'home.php';
}

