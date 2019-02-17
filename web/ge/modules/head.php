<?php
// if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
//     // last request was more than 30 minutes ago
//     session_unset();     // unset $_SESSION variable for the run-time 
//     session_destroy();   // destroy session data in storage
//     header("location: /");
// }
// $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

// if (!isset($_SESSION['CREATED'])) {
//     $_SESSION['CREATED'] = time();
// } else if (time() - $_SESSION['CREATED'] > 1800) {
//     // session started more than 30 minutes ago
//     session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
//     $_SESSION['CREATED'] = time();  // update creation time
// }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gourmet Escape<?=isset($_GET['pgt']) ? ' -'.implode(' ', preg_split('/(?=[A-Z])/',$_GET['pgt'])) : '';?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/sumoselect.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
        <link href="css/styles.css?v=1.0.06" rel="stylesheet" type="text/css">
        <link href="css/sumoselect.min.css?v=1.0.01" rel="stylesheet" type="text/css">
        <script>
            $(document).ready(function() {
                function setHeight() {
                    windowHeight = $(window).innerHeight();
                    if(windowHeight > 1080)
                        $('main').css('min-height', windowHeight * .8);
                    else
                        $('main').css('min-height', windowHeight * .7);
            };
                setHeight();
                
                $(window).resize(function() {
                    setHeight();
                });
            });
            function showMenu() {
                var x = document.getElementById("main_nav");
                if (x.className === "mainNav") {
                    x.className += " responsive";
                } else {
                    x.className = "mainNav";
                }
            }
        </script>
    </head>
<body>