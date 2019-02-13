<?php
$topics = getScriptureTopics();
foreach($topics as $topic){
  $topic_check .= "<input type='checkbox' name='topic[]' value='{$topic['id']}'>{$topic['name']}";
}

$scriptures = getScriptures();
$scripture_html = '';
foreach($scriptures as $s){
  $scripture_topics = implode(', ', array_column(getTopicByScriptureId($s['id']), 'name'));
  $scripture_html .= "<h3>{$s['book']} {$s['chapter']}:{$s['verse']}</h3>";
  if($scripture_topics)
    $scripture_html .= "<h4 style='margin-top:-10px'>Topics: {$scripture_topics}</h4>";
  $scripture_html .= "<p>{$s['content']}</p>";
  $scripture_html .= "<hr>";
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
  <link href="../css/style.css?v=1.1.7" rel="stylesheet" type="text/css">
  <title>Kevin Phair - CS313</title>
</head>
<body>
  <div class="main-area">
    <h1 class="indent title-text">Scriptures</title>
    <h3 class="indent subtitle-text">Search, Ponder, and Pray</h3>
    <div class="content-area">
      <div class="intro-area">
        <p>Let's have some fun with PHP, PostgreSQL, and Scriptures!</p>
      </div>
      <div class="weeks-display"><div class="week-display">
        <form id="scriptopic" name="scriptopic" method="POST" action="?f=updateScriptureTopic">
          <p><input type="text" name="book" placeholder="Book..." required></p>
          <p><input type="chapter" name="chapter" placeholder="Chapter..." required></p>
          <p><input type="verse" name="verse" placeholder="Verse..."required ></p>
          <p><textarea name="content" cols="30" rows="7" required>Content...</textarea></p>
          <p><?=$topic_check?></p>
          <p><input type="checkbox" name="new_topic" value="1"> New Topic: <input type="text" name="new_topic_name" placeholder="Insert New Topic Name..."></p>
          <input type="submit">
        </form>
      </div>
      <div class="week-display">
        <?=$scripture_html?>
      </div>
      </div>
    </div>
  </div>
</body>
</html>