<?php

// Create or access a Session
session_start();

$is_dev = strpos($_SERVER['DOCUMENT_ROOT'], 'mappstack') ? '/cs' : '';
$path = $is_dev ? $_SERVER['DOCUMENT_ROOT'] . '/cs/ge' : $_SERVER['DOCUMENT_ROOT'] . '/ge';
$relative_path = $is_dev ? '/cs/ge/' : '/ge/';

require_once $path . '/library/dbConnect.php';
require_once $path . '/library/functions.php';
require_once $path . '/library/accounts-model.php';

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
            case 'deleteRecipe':
                $recipe_id = trim(htmlspecialchars($_POST['rid']));
                $result = deleteRecipeById($recipe_id);
                header("Location: " .$realtive_path. "?a=".$_POST['catid']);
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
    case 'account':
        switch($action){
            case 'login':
            default:
                include 'pages/account-in.php';
                break;

            case 'register':
                    include 'pages/account-up.php';
                break;

            case 'registerNew':
            $firstname = filter_input(INPUT_POST, 'firstname');
            $lastname = filter_input(INPUT_POST, 'lastname');
            $email = filter_input(INPUT_POST, 'email');
            $passphrase = filter_input(INPUT_POST, 'passphrase');
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $verify_password = filter_input(INPUT_POST, 'verify_password', FILTER_SANITIZE_STRING);
            // Let's get rid of the password from the Post Data
            array_pop($_POST);
    
            $email = checkEmail($email);
            $checkPassword = checkPassword($password, $verify_password);
            $hash = hashEmail($email);
            
            if(!$checkPassword['success']){
                $message = '<p class="notice">' .$checkPassword['message'] . '</p>';
                include 'pages/account-up.php';
                exit;
            }
    
            $existingEmail = checkExistingEmail($email);
    
            $passphrase_match = verifyPassPhrase($passphrase);
    
            if ($existingEmail) {
                $message = '<p class="notice">That email address already exists. Do you want to <a href="?f=account&a=login">login</a> instead?</p>';
                include 'pages/account-up.php';
                exit;
            }
    
            if(!$passphrase_match){
                $message = '<p class="notice">The registration passphrase is incorrect. Please try again.</p>';
                include 'pages/account-up.php';
                exit;
            }
    
            if (empty($firstname) || empty($lastname) || empty($email) || empty($checkPassword) || empty($passphrase)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include 'pages/account-up.php';
                exit;
            }
            $password = password_hash($password, PASSWORD_DEFAULT);
    
            $regOutcome = regVisitor($firstname, $lastname, $email, $password, $hash);
    
            if ($regOutcome['success']) {
                setcookie('firstname', $firstname, strtotime('+1 year'), '/');
                $message = "<p>Thanks for registering $firstname. Please use your email and password to login.</p>";
                include 'pages/account-in.php';
                exit;
            } else {
                $message = "<p>Sorry $firstname, but the registration failed. Please try again.</p>";
                include 'pages/account-up.php';
                exit;
            }
            break;
        case 'signin':
            $email = filter_input(INPUT_POST, 'email');
            $email = checkEmail($email);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $passwordCheck = checkPassword($password);

            if (empty($email) || empty($passwordCheck)) {
                $message = '<p class="notice">Please provide a valid email address and password.</p>';
                include 'pages/account-in.php';
                exit;
            }

            $clientData = getClient($email);
            $hashCheck = password_verify($password, $clientData['clientpassword']);
            if (!$hashCheck) {
                $message = '<p class="notice">Please check your password and try again.</p>';
                include 'pages/account-in.php';
                exit;
            }
            $_SESSION['loggedin'] = TRUE;
            setcookie('firstname', '', time() - 3600, '/');
            array_pop($clientData);
            $_SESSION['clientData'] = $clientData;
            $_SESSION['message'] = "You have succesfully logged in!";
            header('location: ?f=account&a=login');
            unset($message);
            unset($_SESSION['message']);
            break;
        case 'signOut':
            unset($_SESSION);
            session_destroy();
            header('location: ?f=account&a=login');
            break;
        }
        break;
    case 'recipes':
        switch ($action) {
            case 'home':
            case 'Home':
                header("Location: " . $relative_path);
                break;
            case 'updateRecipeForm' :
                if(!isset($_SESSION) || $_SESSION['clientData']['clientlevel'] < 1){
                    header("Location: " . $relative_path);
                    break;
                }
                $create_new = $_GET['rid'] ? false : true;

                if(!$create_new)
                    $recipe_info = getRecipeById($_GET['rid'])[0];

                $categories = getCategories();
                $category_html = '<option disabled selected value> Select Category... </option>';
                foreach($categories as $c){
                    if($c['id'] == $_GET['catId'] || $c['id'] == $recipe_info['category_id'])
                        $category_html .= "<option selected='selected' name='recipe_category' value='{$c['id']}'>{$c['name']}</option>";
                    else
                        $category_html .= "<option name='recipe_category' value='{$c['id']}'>{$c['name']}</option>";
                }

                $ingredient_types = getIngredientTypes();
                $ingredient_type_html = '<option disabled selected value> Select Ingredient Type... </option>';
                foreach($ingredient_types as $it){
                    $ingredient_type_html .= "<option name='ingredient_type' value='{$it['id']}'>{$it['name']}</option>";
                }

                $measurements = getMeasurements();
                $measurement_html = '<option disabled selected value> Select Measurement... </option>';
                foreach($measurements as $m){
                    $measurement_html .= "<option name='measurement' value='{$m['id']}'>{$m['name']}</option>";
                }

                $ingredients = getIngredients();
                $ingredient_html = '<option disabled selected value> Select an Ingredient... </option>';
                foreach($ingredients as $i){
                    $ingredient_html .= "<option name='ingredient' value='{$i['id']}'>{$i['ingredient']}</option>";
                }

                if(!$create_new && !empty($recipe_info['ingredients'])){
                    $i = 1;
                    $measurement_html = '<option disabled selected value> Select Measurement... </option>';
                    $existing_ingredient_info = "";
                    foreach($recipe_info['ingredients'] as $ingredient){
                        foreach($measurements as $m){
                            if($m['id'] == $ingredient['mid'])
                                $measurement_html .= "<option selected='selected' name='ingredient' value='{$m['id']}'>{$m['name']}</option>";
                            else
                                $measurement_html .= "<option name='measurement' value='{$m['id']}'>{$m['name']}</option>";
                        }
                        $existing_ingredient_info .= "<div id='ingredient" . $i ."'>";
                        $existing_ingredient_info .= "<br><input type='hidden' name='ingredient_id[]' value='{$ingredient['ingredient_id']}'>";
                        $existing_ingredient_info .= "<span class='input-ingredient'>{$ingredient['ingredient']}: </span>";
                        $existing_ingredient_info .= "<input type='text' required name='ingredient_amount[]' value='{$ingredient['measurement_amt']}' placeholder='Amount (number)'>";
                        $existing_ingredient_info .= "<select class='measurement-type SlectBox' name='measurement_type[]'>{$measurement_html}</select><a href='javascript:void(0);' class='close-ingredient no-decor' data-id='{$i}'><i class='fas fa-times-circle'></i></a>";
                        $existing_ingredient_info .= "</div>";
                        $i++;
                    }
                }
                include 'pages/recipe_template.php';
                break;

            case 'addNewIngredient':
                if(!isset($_SESSION) || $_SESSION['clientData']['clientlevel'] < 1){
                    header("Location: " . $relative_path);
                    break;
                }
                $result = insertNewIngredient($_POST);
                echo json_encode($result);
                break;

            case 'updateRecipe':
                if(!isset($_SESSION) || $_SESSION['clientData']['clientlevel'] < 1){
                    header("Location: " . $relative_path);
                    break;
                }
                $result = updateRecipe($_POST);
                if($result['success']){
                    $recipe_data = getRecipeById($result['id']);
                }
                else {
                    $recipe_data = getRecipeById($_POST['id']);
                }
                $message = $result['message'];
                include 'pages/recipe_template.php';
                unset($message);
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

