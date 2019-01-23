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
      <form id="weekThree" method="POST">
		<p>Name: <input type="text" name="name" required></p>
		<p>Email: <input type="text" name="email" required></p>
		<p>Major: <br>
			<input type="radio" name="major" id="majorChoice1" value="computerScience">
			<label for="majorChoice1">Computer Science</label>
			<br>
			<input type="radio" name="major" id="majorChoice2" value="webDesign">
			<label for="majorChoice2">Computer Science</label>
			<br>
			<input type="radio" name="major" id="majorChoice3" value="cit">
			<label for="majorChoice3">Computer Science</label>
			<br>
			<input type="radio" name="major" id="majorChoice4" value="computerEngineer">
			<label for="majorChoice4">Computer Science</label>
		</p>
	  </form>
    </div>
  </div>
</body>
</html>