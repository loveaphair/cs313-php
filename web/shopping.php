<?php
	if(!isset($products))
		header('Location: shopping_view.php');

	$product_html = '';
	foreach($products as $product){
		$product_html .= "<li class='week-display' data-id = {$product['id']}><img src='images/shopping/{$product['image']}'><br><b>{$product['title']}</b><div class='prod-info'>{$product['description']}<br><b>"."$"."{$product['price']}</b></div><div class='add-area' style='display:none;'><form method='POST' action='?v=addToCart'></form></div></li>";
	}

	$cart_num = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
	$message = isset($_SESSION['message']) ? $_SESSION['message']."<a href='?v=cart'> - View Cart</a>" : '';
		unset($_SESSION['message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/a.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<link href="css/style.css?v=1.1.7" rel="stylesheet" type="text/css">
	<title>Hat House</title>
</head>
<script>
	$(function(){ 
		$('.week-display img').click(function(){
			var area = $(this).parent().children('.add-area');
			var form = area.children('form');
			var id = $(this).parent().data('id');
			area.toggle();
			if(!form.has("input").length)
				$("<input type='text' value='1' name='quantity' maxlength='2'><input type='submit' value='Add'><input type='hidden' name='prod_id' value='" + id + "'>").prependTo(form);
		})
	});
</script>
<body>
<div class="main-area" style="z-index:1">
    <h1 class="indent title-text">Mickey Mouse Hat House</h1><div class="right"><a href="?v=cart" style="text-decoration:none;color:#000;"><i class="fas fa-shopping-cart"></i> <?=$cart_num?></a></div>
    <h3 class="indent subtitle-text">Cover Yourself in style</h3>
    <div class="content-area">
      <div class="intro-area">
		<p>Look at all these hats you can "buy"! From Classic to Creative, these hats are sure to please any Disney fan. Click on a hat to order.</p>
		<h3 class="center"><?=$message?></h3>
      </div>
      <ul class="weeks-display">
      <?=$product_html?>
	  </ul>
    </div>
	<p class="center">Mickey Mouse and all logos &copy;Disney</p>
  </div>
</body>
</html>