<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Cart</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<script src="js/Lab4.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	
</head>

<body>
	<div class = "row" id ="header">
		<?php
			require('header.php');
		?>
	</div>
	<div class="container-fluid">
		<div id = "left-ish" class="col-sm-8" style="background-color: #F8F8F8; border-radius: 20px;">
			<div class="row">
				<div class="row" id="column-titles">
					<div class="col-sm-6" style="padding-left: 5%">
						<h4>Item</h4>
                    </div>
                    <div class="col-sm-6 col-centered" style="padding-left: 5%">
						<h4>Value</h4>
                    </div>
				</div>
				<?php
					session_start();
					require_once('Cart.php');
					require_once('User.php');
					require_once('Item.php');
					
					$cart=unserialize($_SESSION["cart"]);
					$user=unserialize($_SESSION["user"]);
					
					$cart->viewItems();
				?>
			</div>
		</div>
		<div id = "right-ish" class="col-sm-4" style="background-color: #ffffe5; border-radius: 20px;">
			<div class="row">
				<h3>
					Order Total: 
					<?php
						$cart=unserialize($_SESSION["cart"]);
						echo '$'.$cart->cartTotal();
					?>
				</h3>
			</div>
			<div class="row">
				<a type = "button" class = "btn btn-success" href="purchase.php">Purchase</a>
				<a type = "Clear" class="btn btn-warning" href="#">Clear</a>
			</div>
		</div>
	</div>


</body>
</html>
