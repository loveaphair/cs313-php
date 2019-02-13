<?php
  $weeks = [
    'week2' => ['img_src' => 'images/week2.png',
                'caption' => 'Week 2 Team Assignment',
                'description' => 'Three interactive js buttons',
                'href' => 'hello.html' ],
    'week3' => ['img_src' => 'images/week3.png',
                'caption' => 'Week 3 Team Assignment',
                'description' => 'Secure PHP Form Handling',
                'href' => 'weekThreeTeam.php'],
    'week3-ind' => ['img_src' => 'images/week3-ind.png',
                'caption' => 'Week 3 Individual Assignment',
                'description' => 'Shopping Cart',
                'href' => 'shopping_view.php'],
    'week5' => ['img_src' => 'images/week5.png',
                'caption' => 'Week 5 Individual Assignment',
                'description' => 'Database Calls',
                'href' => 'ge/'],
    'week6-team' => ['img_src' => 'images/week6-team.png',
                    'caption' => 'Week 6 Team Assignment',
                    'description' => 'Database CRUD',
                    'href' => 'ge/group'],
  ];
  $week_display = '';
  foreach($weeks as $week){
    $week_display .= "<li class='week-display'><a href='{$week['href']}' target='_blank'><img src='{$week['img_src']}'></a><br><h4 class='caption'>{$week['caption']}</h4>{$week['description']}</li>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- <script src="a.js"></script> -->
  <link href="css/style.css?v=1.1.7" rel="stylesheet" type="text/css">
  <title>Kevin Phair - CS313</title>
</head>
<body>
  <div class="main-area">
    <h1 class="indent title-text">Kevin Phair - CS313</title>
    <h3 class="indent subtitle-text">Professional Student-Level Web Design</h3>
    <div class="content-area">
      <div class="intro-area">
        <p>This is a website! Why does this website exist, you ask? It's an assignment! I may be a professional web developer, but when a professor says "build a website" I say, "will do, but what are the requirements?" And then I follow those requirements with exactness.</p>
      </div>
      <h2 class="indent">ASSIGNMENTS</h2>
      <ul class="weeks-display">
      <?=$week_display?>
      </ul>
    </div>
  </div>
</body>
</html>