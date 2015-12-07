<?php
	require_once('User.php');
	session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Welcome!</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">

</head>

<body>
	
	<div class="container-fluid">
		<div class = "row" id ="header">
			<div>
				<?php
					require_once('User.php');
					echo '<div class="col-sm-8 vcenter">';
						$user=unserialize($_SESSION["user"]);
						echo '<h1>WELCOME '.$user->firstName.'</h1>';
					echo '</div>
						<div class="col-sm-3 vcenter">
							<a type="button" class="btn btn-default" href="viewCart.php">Cart<span class="glyphicon glyphicon-shopping-cart"></span></a>
							<a type="button" class="btn btn-default" href="Profile.php">Profile<span class="glyphicon glyphicon-user"</span></a>
							<a type="button" class="btn btn-success" href="logout.php">Log-out</a>
						</div>';						
				?>
			</div>
		</div>
		
		<div class="row">
			<div class="container-fluid">
				<div class="row" style="margin: 4%;"></div>
				<div class="row">
					<div class="col-sm-3" style="background-color: #F8F8F8; border-radius: 20px; margin: 1%;">
						<div class="row">
							<img src="img/soccer.jpeg" alt="soccer ball" width="90%">
						</div>
						<div class="row">
							<a class="btn btn-default" href="addSoccer.php">Add</a>
						</div>
					</div>
					<div class="col-sm-3" style="background-color: #F8F8F8; border-radius: 20px; margin: 1%;">
						<div class="row">
							<img src="img/ppuck.jpg" alt="hockey puck" width="90%">
						</div>
						<div class="row">
							<a class="btn btn-default" href="addPuck.php">Add</a>
						</div>
					</div>
					<div class="col-sm-3" style="background-color: #F8F8F8; border-radius: 20px; margin: 1%;">
						<div class="row">
							<img src="img/football.jpg" alt="football" width="90%">
						</div>
						<div class="row">
							<a class="btn btn-default" href="addFootball.php">Add</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
		
</body>
</html>
