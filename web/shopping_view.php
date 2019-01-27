<?php

$products = [
	'm1' => ['title' => 'Classic Mickey Mouse Hat',
		'image' => 'mickey1.jpg',
		'description' => 'Classic Mickey Mouse Hat that has been available for decades.',
		'price' => '9.99',
		'id' => 'm1'],
	'm2' => ['title' => 'Mickey Baseball Cap',
		'image' => 'mickey2.jpg',
		'description' => 'Baseball cap style with Mickey Mouse Ears.',
		'price' => '12.99',
		'id' => 'm2'],
	'm3' => ['title' => 'Mickey Mouse Tail Hat',
		'image' => 'mickey3.jpg',
		'description' => 'Try to make heads or tails of this adorable Mickey Hat.',
		'price' => '14.99',
		'id' => 'm3'],
	'm4' => ['title' => 'Children\'s Basebball Cap',
		'image' => 'mickey4.jpg',
		'description' => 'Lighthearted, colorful children\'s cap.',
		'price' => '10.99',
		'id' => 'm4'],
	'm5' => ['title' => '"Just Mickey"',
		'image' => 'mickey5.jpg',
		'description' => 'Baseball cap with full image Mickey Mouse.',
		'price' => '13.99',
		'id' => 'm5'],
	'm6' => ['title' => 'Mickey Stocking Cap',
		'image' => 'mickey6.jpg',
		'description' => 'Custom made Mickey stocking cap. Keeps your ears warm!',
		'price' => '16.99',
		'id' => 'm6'],
	'm7' => ['title' => 'Mickey\'s Magic Hat',
		'image' => 'mickey7.jpg',
		'description' => 'Feel the magic of Mickey Mouse!',
		'price' => '22.99',
		'id' => 'm7'],
	'm8' => ['title' => 'Vintage Mickey Bill Cap',
		'image' => 'mickey8.jpg',
		'description' => 'Vintage Mickey Mouse on baseball cap.',
		'price' => '16.99',
		'id' => 'm8'],
];

// Create or access a Session
session_start();

$action = filter_input(INPUT_POST, 'v');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'v');
    if ($action == NULL) {
        $action = 'view';
    }
}

switch ($action) {
	case 'view':
	default:
		include 'shopping.php';
		break;

	case 'cart':
		include 'shopping_cart.php';
		break;

	case 'addToCart':
		$item = filter_input(INPUT_POST, 'prod_id');
		$qty = filter_input(INPUT_POST, 'quantity');
		if(!isset($_SESSION['cart'][$item]['quantity']))
			$_SESSION['cart'][$item]['quantity'] = $qty;
		else
			$_SESSION['cart'][$item]['quantity'] += $qty;
		print_r($_SESSION);
		$_SESSION['cart_count'] = array_sum(array_column($_SESSION['cart'], 'quantity'));
		$_SESSION['message'] = "Successfully added to cart";
		header('Location: shopping_view.php');
		break;

	case 'deleteFromCart':
		$item = filter_input(INPUT_POST, 'prod_id');
		unset($_SESSION['cart'][$item]);
		$_SESSION['cart_count'] = array_sum(array_column($_SESSION['cart'], 'quantity'));
		include 'shopping_cart.php';
		break;

	case 'checkout':
		$_SESSION['order']['first_name'] = htmlspecialchars($_POST['first_name']);
		$_SESSION['order']['last_name'] = htmlspecialchars($_POST['last_name']);
		$_SESSION['order']['street'] = htmlspecialchars($_POST['street']);
		$_SESSION['order']['city'] = htmlspecialchars($_POST['city']);
		$_SESSION['order']['state'] = htmlspecialchars($_POST['state']);
		$_SESSION['order']['zip'] = htmlspecialchars($_POST['zip']);

		if(!$_SESSION['order']['first_name'] || !$_SESSION['order']['last_name'] || !$_SESSION['order']['street'] || !$_SESSION['order']['city'] || !$_SESSION['order']['state'] || !$_SESSION['order']['zip'])
			header('Location: shopping_view.php');
		
		header('Location: shopping_view.php?v=order_confirmation');
		break;

	case 'order_confirmation':
		if(!$_SESSION['order']['first_name'] || !$_SESSION['order']['last_name'] || !$_SESSION['order']['street'] || !$_SESSION['order']['city'] || !$_SESSION['order']['state'] || !$_SESSION['order']['zip'])
			header('Location: shopping_view.php');
			
		include 'checkout_info.php';
		break;
}
?>