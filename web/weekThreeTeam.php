<?php
	$major_options = ['majorChoice1' => ['id' => 'majorChoice1',
										'value' => 'Computer Science',
										'label' => 'Computer Science'],
					  'majorChoice2' => ['id' => 'majorChoice2',
										'value' => 'Web Design and Development',
										'label' => 'Web Design and Development'],
					  'majorChoice3' => ['id' => 'majorChoice3',
										'value' => 'Computer information Technology',
										'label' => 'Computer information Technology'],
					  'majorChoice4' => ['id' => 'majorChoice4',
										'value' => 'Computer Engineering',
										'label' => 'Computer Engineering'],
					];

	foreach($major_options as $option){
		$major_html .= "<input type='radio' name='major', id='{$option['id']}', value='{$option['value']}'><label for {$option['id']}>{$option['label']}</label>";
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
				<input type="checkbox" name="continents[]" value="North America">North America<br>
				<input type="checkbox" name="continents[]" value="South America">South America<br>
				<input type="checkbox" name="continents[]" value="Europe">Europe<br>
				<input type="checkbox" name="continents[]" value="Asia">Asia<br>
				<input type="checkbox" name="continents[]" value="Australia">Australia<br>
				<input type="checkbox" name="continents[]" value="Africa">Africa<br>
				<input type="checkbox" name="continents[]" value="Antarctica">Antarctica<br>
			</p>
			<input type="submit" value="Submit">
		</form>
		<?php } else {?>
			<p>Hi, <?=$_POST['name']?>!</p>
			<p>We recorded your email address as <a href="mailto:<?=$_POST['email']?>"><?=$_POST['email']?></a></p>
			<p>It looks like you're majoring in <?=$_POST['major']?>; that is very exciting for you!</p>
			<p>Thanks for leaving these comments:<br>
			<?=$_POST['comments']?>
			</p>
			<p>Here are the continents you have visited: <?=implode(", ", $_POST['continents'])?></p>
		<?php } ?>
		</div>
    </div>
  </div>
</body>
</html>