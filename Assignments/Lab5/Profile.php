<?php
	if (isset($_POST['submitted'])){
		
		require_once('../mysqli_connect.php');
		require_once('User.php');
		
		$user=unserialize($_SESSION['user']);
		
		//First name check for unwanted characters
		if (preg_match ('%^[A-Za-z\.\'\-]{2,15}$%', stripslashes(trim($_POST['firstName'])))){
			$user->firstName=escape_data($_POST['firstName']);
		}
        
        
        //Check lastname
		if (preg_match ('%^[A-Za-z\.\'\-]{2,15}$%', stripslashes(trim($_POST['lastName'])))){
			$user->lastName=escape_data($_POST['lastName']);
		}
        

        // Check for an email address.
		if (preg_match ('%^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['email'])))) {
			$user->email = escape_data($_POST['email']);
		}
        
        // Check for a street.

		if (preg_match ('%^[A-Za-z0-9\.\' \-]{5,30}$%', stripslashes(trim($_POST['streetAddress'])))) {
			$user->streetAddress = escape_data($_POST['streetAddress']);
		}
		
        //Check Password
		if (preg_match ('%^[A-za-z0-9]{4,20}$%', stripslashes(trim($_POST['password'])))) {
			$test_password = escape_data($_POST['password']);
			if (preg_match ('%^[A-za-z0-9]{4,20}$%', stripslashes(trim($_POST['confirmPassword'])))) {
				$confirmationPassword =escape_data($_POST['confirmPassword']);
				if(passwordChecker($test_password,$confirmationPassword)){
					$user->password = escape_data($_POST['password']);
				}
			}    
		}
		
    
        //Check Postal Code
		if (preg_match ('%^[A-Za-z][0-9][A-Za-z]" "[0-9][A-Za-z][0-9]$%', stripslashes(trim($_POST['postalCode'])))){
			$user->postalCode=escape_data($_POST['postalCode']);
		}
	
		
        //Check Dat of Birth
		if (preg_match ('%^[0-9]{6}$%', stripslashes(trim($_POST['DOB'])))){
			$user->DOB=escape_data($_POST['DOB']);
		}
		
        $user->gender=$_POST['Gender'];
		
		$query = "UPDATE users SET firstName=?, lastName=?, email=?, password=?, streetAddress=?, postalCode=?, DOB =?, gender=? WHERE id=?";
        
        $stmt=mysqli_prepare($dbc, $query);
		
        if ( !$stmt ) {
            die('mysqli error: '.mysqli_error($dbc));
        }
        
        mysqli_stmt_bind_param($stmt, "ssssssdsd", $user->firstName,$user->lastName,$user->email,$user->streetAddress, $user->password, $user->postalCode, $user->DOB, $user->gender, $user->id);
        
		if ( !mysqli_execute($stmt) ) {
            die( 'stmt error: '.mysqli_stmt_error($stmt) );
        }
		$_SESSION['user']=serialize($user);
		
		echo "<p>ACCOUNT UPDATED</p>";
		
		
	}
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Edit your profile</title>
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
		<div class = "row" id = "theContent" style="padding-top: 10px">
			<div id = "left-ish" class="col-sm-8" style="background-color: #F8F8F8; border-radius: 20px;">
				<div class="row" id="buttonHolder">
					<div class ="col-md-6">
						<h2>Your Profile</h2>
					</div>
					<div class="pull-right" style="padding-top: 5px; padding-right: 5px;">
						<button id="edit" type="edit" class="btn btn-warning" onclick="showEdit()">EDIT<span class="glyphicon glyphicon-pencil"></span></button>
						<a id="delete" type="delete" class="btn btn-danger" href="deleteUser.php">DELETE<span class="glyphicon glyphicon-trash"></span></a>
					</div>
				</div>
				<div id="userInfo">
					<form role ="form">
						<?php
						require_once('User.php');
						session_start();
						$user=unserialize($_SESSION["user"]);
						echo '
						<div class = "form-group">
							<label for="fn">First Name:</label>
							<p type="text" class="form-control" id="fn" name="firstName">'.$user->firstName.'</p>
						</div>
						
						<div class = "form-group">
							<label for="fn">Last Name:</label>
							<p type="text" class="form-control" id="ln" name="lastName">'.$user->lastName.'</p>
						</div>
					   
						<div class="form-group">
							<label for="em">Email:</label>
							<p type="email"	class="form-control" id="em" name="email" >'.$user->email.'</p>
						</div>
						
						<div class="form-group">
							<label for="pwd">Password:</label>
							<p type="password" class="form-control" id="pwd" name="password" >********</p>
						</div>
							
						<div class="form-group">
							<label for="SA">Street Address:</label>
							<p type="text"	class="form-control" id="SA" name="streetAddress">'.$user->streetAddress.'</p>
						</div>
						
						<div class="form-group">
							<label for="pc">Postal Code:</label>
							<p type="text" class="form-control" id="pc" name="postalCode" >'.$user->postalCode.'</p>
						</div>
							
						<div class="form-group">
							<label for="thedate">Date of Birth (yyyymmdd):</label>
							<p type="date" class="form-control" id="thedate">'.$user->DOB.'</p>
						</div>
						<div class="form-group">
							<label for="name">Gender:</label>
							<p name="Gender" class = "form-control">'.$user->gender.'</p>
						</div>
						';
						?>
					</form>
				</div>
				<div id="editInfo" style="display: none;">
					<form role ="form" method = "POST">
						
						<div class = "form-group">
							<label for="fn">First Name:</label>
							<input type="text" class="form-control" id="fn" name="firstName" value="<?php echo $user->firstName ?>">
						</div>
						
						<div class = "form-group">
							<label for="fn">Last Name:</label>
							<input type="text" class="form-control" id="ln" name="lastName" value="<?php echo $user->lastName ?>" >
						</div>
					   
						<div class="form-group">
							<label for="em">Email:</label>
							<input type="email"	class="form-control" id="em" name="email" value="<?php echo $user->email ?>">
						</div>
						
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="pwd" name="password" placeholder="*******"  value="<?php echo $user->password ?>">
						</div>
						
						<div class="form-group">
							<label for="cpwd">Confirm Password:</label>
							<input type="password" class="form-control" id="cpwd" name="confirmPassword" placeholder="*******" value="<?php echo $user->password ?>">
						</div>
							
						<div class="form-group">
							<label for="SA">Street Address:</label>
							<input type="text"	class="form-control" id="SA" name="streetAddress" value="<?php echo $user->streetAddress ?>">
						</div>
						
						<div class="form-group">
							<label for="pc">Postal Code:</label>
							<input type="text" class="form-control" id="pc" name="postalCode" value="<?php echo $user->postalCode ?>" pattern="[A-Za-z][0-9][A-Za-z]\ [0-9]+[A-Za-z]+[0-9]" title="Ex. A1A 1A1">
						</div>
							
						<div class="form-group">
							<label for="thedate">Date of Birth (yyyymmdd):</label>
							<input type="date" class="form-control" id="thedate" name="DOB" value="<?php echo $user->DOB ?>" pattern="[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]"/>
						</div>
						
						<div class="form-group">
							<label for="name">Gender:</label>
							<select name="Gender" class = "form-control">
								<option value='Male'>Male</option>
								<option value='Female'>Female</option>
							</select>
						</div>
						
						<div class = "form-group">
							<button type = "submit" class = "btn btn-default">Submit Changes</button>
						</div>
					</form>
				</div>
				
			</div>
			<div id = "right-ish" class="col-sm-4" style="background-color: #ffffe5; border-radius: 20px;">
				<div class="row">
					<h3>Order Summary</h3>
				</div>
				<div class="row">
					<?php
						require_once('../mysqli_connect.php');
						require_once('Cart.php');
						require_once('User.php');
						
						$user=unserialize($_SESSION["user"]);
						
						$query = "SELECT * FROM carts WHERE purchase_id = ?";
			
						$stmt=mysqli_prepare($dbc, $query);
			
						if ( !$stmt ) {
							die('mysqli error: '.mysqli_error($dbc));
						}
						
						mysqli_stmt_bind_param($stmt, 'd', $user->id);
			
						if ( !mysqli_execute($stmt) ) {
							die( 'stmt error: '.mysqli_stmt_error($stmt) );
						}
						
						mysqli_stmt_bind_result($stmt, $id, $holder, $dateCreated,$purchased,$datePurchase, $items, $shipTo, $shipAddress, $shipCity, $shipCountry);
						$i=0;
						while (mysqli_stmt_fetch($stmt)) {
							$cart[$i]=Cart::Reciept($id,$holder, $dateCreated,$purchased,$datePurchase, $items, $shipTo, $shipAddress, $shipCity, $shipCountry);
							echo '<div class="row" style="padding-top: 5px; padding-bottom: 5px; background-color:#FFFFFF; border-radius: 5px">
									<div class="col-sm-4">
										Order #'.$id.'
									</div>
									<div class="col-sm-5">
										Total: '.$cart[$i].cartTotal().'
									</div>
								</div>';
							$i=$i+1;
						}
					?>
				</div>
				
			</div>
		</div>
	</div>

</body>
</html>
