<?php
	require 'dbConnect.php';
	$db = get_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!-- <script src="a.js"></script> -->
  <link href="css/style.css?v=1.1.1" rel="stylesheet" type="text/css">
  <title>Kevin Phair - CS313</title>
</head>
<body>
  <div class="main-area">
    <h1 class="indent title-text">Week Three - CS313</title>
    <h3 class="indent subtitle-text">Team Assignment</h3>
    <div class="content-area">
	<div class="intro-area">
		<?php if(!isset($_POST) || (isset($_POST) && !$_POST)){ ?>
		<form id="weekThree" method="POST" action="">
			<p>Name: <input type="text" name="name" required></p>
			<p>Email: <input type="text" name="email" required></p>
			<p>Major: <br>
				<?=$major_html?>
				<!-- <input type="radio" name="major" id="majorChoice1" value="Computer Science">
				<label for="majorChoice1">Computer Science</label>
				<br>
				<input type="radio" name="major" id="majorChoice2" value="Web Design and Development">
				<label for="majorChoice2">Web Design and Development</label>
				<br>
				<input type="radio" name="major" id="majorChoice3" value="Computer information Technology">
				<label for="majorChoice3">Computer information Technology</label>
				<br>
				<input type="radio" name="major" id="majorChoice4" value="Computer Engineering">
				<label for="majorChoice4">Computer Engineering</label> -->
			</p>
			<p>Comments:<br>
			<textarea rows="5" cols="50" name="comments"></textarea>
			</p>
			<p>List the Continents you have visited<br>
				<?=$continent_html?>
				<!-- <input type="checkbox" name="continents[]" value="North America">North America<br>
				<input type="checkbox" name="continents[]" value="South America">South America<br>
				<input type="checkbox" name="continents[]" value="Europe">Europe<br>
				<input type="checkbox" name="continents[]" value="Asia">Asia<br>
				<input type="checkbox" name="continents[]" value="Australia">Australia<br>
				<input type="checkbox" name="continents[]" value="Africa">Africa<br>
				<input type="checkbox" name="continents[]" value="Antarctica">Antarctica<br> -->
			</p>
			<input type="submit" value="Submit">
		</form>
		<?php } else {
			// Process all the $_POST data
			$name = htmlspecialchars($_POST['name']);
			$email = htmlspecialchars($_POST['email']);
			$major = htmlspecialchars($_POST['major']);
			$comments = htmlspecialchars($_POST['comments']);
			$continents = $_POST['continents'];
			?>
			
			<p>Hi, <?=$name?>!</p>
			<p>We recorded your email address as <a href="mailto:<?=$email?>"><?=$email?></a></p>
			<p>It looks like you're majoring in <?=$major?>; that is very exciting for you!</p>
			<p>Thanks for leaving these comments:<br>
			<?=$comments?>
			</p>
			<p>Here are the continents you have visited: </p>
			<ul class="continent-list">
			<?php foreach($continents as $c){
				$clean_c = htmlspecialchars($c);
				echo "<li>$clean_c</li>";
			} ?>
			</ul>
		<?php } ?>
		</div>
    </div>
  </div>
</body>
</html>