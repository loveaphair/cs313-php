<?php
  $weeks = [
    'week2' => ['img_src' => 'images/week2_tn.png',
                'caption' => 'Week 2 Team Assignment',
                'Description' => 'Three interactive buttons',
                'href' => '/hello.html' ]
  ];
  foreach($weeks as $week){
    $week_display .= "<li class='week-display'><a href='{$week['href']}'><img src='{$week['img_src']}'></a><br><h4>{$week['caption']}</h4></li>";
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
  <link href="css/style.css?v=1.1.6" rel="stylesheet" type="text/css">
  <title>Kevin Phair - CS313</title>
</head>
<body>
  <div class="main-area">
    <h1 class="indent title-text">Kevin Phair - CS313</title>
    <h3 class="indent subtitle-text">Professional Student-Level Web Design</h3>
    <div class="content-area">
      <ul class="weeks-display">
      <?=$week_display?>
      </ul>
    </div>
  </div>
</body>
</html>