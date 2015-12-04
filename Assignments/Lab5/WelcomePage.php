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
			<?php
				echo '<h1>WELCOME '.$_SESSION["firstName"].'</h1>';
			?>
		<div>
		<div class="row">
			<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/Am4oKAmc2To?rel=0&autoplay=1\" frameborder=\"0\" allowfullscreen></iframe>
		</div>
		<div class ="row">
			<a type="button" class="btn btn-default" href="edit.php">Update Profile</a>
		</div>
	</div>	
		
</body>
</html>
