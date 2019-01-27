<?php
	if(!isset($products))
		header('Location: shopping_view.php');

	if(!isset($_SESSION['cart']) || !$_SESSION['cart'])
		$cart_html = "Nothing is in your cart.";
	else{
		$cart_html = '';
		$cart_total = 0;
		foreach($_SESSION['cart'] as $key => $value){ 
		$total_price = $value['quantity'] * $products[$key]['price'];
		$cart_html .= "<li class='cart-display' data-id='{$key}'><img src='images/shopping/{$products[$key]['image']}' height='100%'>";
		$cart_html .= "<div style='width:55%;display:inline-block;'><b>{$products[$key]['title']}</b><br>{$products[$key]['description']}</div>";
		$cart_html .= "<div style='width:23%;display:inline-block;'><b>Quantity:</b> {$value['quantity']}<br><b>Total:</b> ".'$'."{$total_price}</div>";
		$cart_html .= "</li>";
		$cart_total += $total_price;
		}
		$cart_html .= "<li style='float:right;margin-right:100px;'><b>Order Total </b>"."$"."{$cart_total}</li>";
	}

	$cart_num = 0;
	$first_name = $_SESSION['order']['first_name'];
	$last_name = $_SESSION['order']['last_name'];
	$street = $_SESSION['order']['street'];
	$city = $_SESSION['order']['city'];
	$state = $_SESSION['order']['state'];
	$zip = $_SESSION['order']['zip'];

	unset($_SESSION['order']);
	unset($_SESSION['cart']);
	unset($_SESSION['cart_count']);
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
	<title>Hat House - Order Confirmation</title>
</head>
<script>
	$(function(){ 
		$('#checkout').click(function(){
			$('#checkout_form').toggle();
			$(this).empty();
		})
	});
</script>
<body>
<div class="main-area" style="z-index:1">
    <h1 class="indent title-text"><a href="shopping_view.php">Mickey Mouse Hat House</a></h1><div class="right"><a href="?v=cart" style="text-decoration:none;color:#000;"><i class="fas fa-shopping-cart"></i> <?=$cart_num?></a></div>
    <h3 class="indent subtitle-text">Cover Yourself in style</h3>
    <div class="content-area">
      <div class="intro-area">
		<h3 class="center">Order Confirmation - <a href="shopping_view.php">Buy More Things -> </a></h3>
		<p>Thank you for your purchase! Here are your order details:</p>
      </div>
      <ul class="carts-display">
	  <?=$cart_html?>
	  </ul>
		<div class="intro-area">
			<p>We will send this order to the following location:</p>
			<p><?=$first_name?> <?=$last_name?><br>
			<?=$street?><br>
			<?=$city?>, <?=$state?> <?=$zip?>
		</div>
    </div>
	<p class="center">Mickey Mouse and all logos &copy;Disney</p>
  </div>
	
</body>
</html>