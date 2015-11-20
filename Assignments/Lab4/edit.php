<?php
	session_start();
	if (isset($_POST['submitted'])){
		
		require_once('../mysqli_connect.php');
		
		//First name check for unwanted characters
		if (preg_match ('%^[A-Za-z\.\'\-]{2,15}$%', stripslashes(trim($_POST['firstName'])))){
			$_SESSION['firstName']=escape_data($_POST['firstName']);
		}
        
        
        //Check lastname
		if (preg_match ('%^[A-Za-z\.\'\-]{2,15}$%', stripslashes(trim($_POST['lastName'])))){
			$_SESSION['lastName']=escape_data($_POST['lastName']);
		}
        

        // Check for an email address.
		if (preg_match ('%^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['email'])))) {
			$_SESSION['email'] = escape_data($_POST['email']);
		}
        
        // Check for a street.

		if (preg_match ('%^[A-Za-z0-9\.\' \-]{5,30}$%', stripslashes(trim($_POST['streetAddress'])))) {
			$_SESSION['streetAddress'] = escape_data($_POST['streetAddress']);
		}
		
        //Check Password
		if (preg_match ('%^[A-za-z0-9]{4,20}$%', stripslashes(trim($_POST['password'])))) {
			$test_password = escape_data($_POST['password']);
			if (preg_match ('%^[A-za-z0-9]{4,20}$%', stripslashes(trim($_POST['confirmPassword'])))) {
				$confirmationPassword =escape_data($_POST['confirmPassword']);
				if(passwordChecker($test_password,$confirmationPassword)){
					$_SESSION['password'] = escape_data($_POST['password']);
				}
			}    
		}
		
    
        //Check Postal Code
		if (preg_match ('%^[A-Za-z][0-9][A-Za-z]" "[0-9][A-Za-z][0-9]$%', stripslashes(trim($_POST['postalCode'])))){
			$_SESSION['postalCode']=escape_data($_POST['postalCode']);
		}
	
		
        //Check Dat of Birth
		if (preg_match ('%^[0-9]{6}$%', stripslashes(trim($_POST['DOB'])))){
			$_SESSION['DOB']=escape_data($_POST['DOB']);
		}
		
        $_SESSION['gender']=$_POST['Gender'];
		
		$query = "UPDATE users SET firstName=?, lastName=?, email=?, password=?, streetAddress=?, postalCode=?, DOB =?, gender=? WHERE id=?";
        
        $stmt=mysqli_prepare($dbc, $query);
		
        if ( !$stmt ) {
            die('mysqli error: '.mysqli_error($dbc));
        }
        
        mysqli_stmt_bind_param($stmt, "ssssssdsd", $_SESSION['firstName'],$_SESSION['lastName'],$_SESSION['email'],$_SESSION['password'], $_SESSION['streetAddress'], $_SESSION['postalCode'], $_SESSION['DOB'], $_SESSION['gender'], $_SESSION['id']);
        
		if ( !mysqli_execute($stmt) ) {
            die( 'stmt error: '.mysqli_stmt_error($stmt) );
        }
		
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
		<div class = "row" id = "theContent">
			<div id = "left-ish" class="col-sm-8">
				<div class="row" id="buttonHolder">
					<button id="edit" type="edit" class="btn btn-default" onclick="showEdit()">EDIT</button>
					<button id="delete" type="delete" class="btn btn-default" action="deleteUser.php">DELETE</button>
				</div>
				<div id="userInfo">
					<form role ="form">
						
						<div class = "form-group">
							<label for="fn">First Name:</label>
							<p type="text" class="form-control" id="fn" name="firstName"><?php echo $_SESSION["firstName"] ?></p>
						</div>
						
						<div class = "form-group">
							<label for="fn">Last Name:</label>
							<p type="text" class="form-control" id="ln" name="lastName"><?php echo $_SESSION["lastName"] ?></p>
						</div>
					   
						<div class="form-group">
							<label for="em">Email:</label>
							<p type="email"	class="form-control" id="em" name="email" ><?php echo $_SESSION["email"] ?></p>
						</div>
						
						<div class="form-group">
							<label for="pwd">Password:</label>
							<p type="password" class="form-control" id="pwd" name="password" >********</p>
						</div>
							
						<div class="form-group">
							<label for="SA">Street Address:</label>
							<p type="text"	class="form-control" id="SA" name="streetAddress"><?php echo $_SESSION["streetAddress"] ?></p>
						</div>
						
						<div class="form-group">
							<label for="pc">Postal Code:</label>
							<p type="text" class="form-control" id="pc" name="postalCode" ><?php echo $_SESSION["postalCode"] ?></p>
						</div>
							
						<div class="form-group">
							<label for="thedate">Date of Birth (yyyymmdd):</label>
							<p type="date" class="form-control" id="thedate"><?php echo $_SESSION["DOB"] ?></p>
						</div>
						<div class="form-group">
							<label for="name">Gender:</label>
							<p name="Gender" class = "form-control"><?php echo $_SESSION["gender"] ?></p>
						</div>
						
					</form>
				</div>
				<div id="editInfo" style="display: none;">
					<form role ="form" method = "POST">
						
						<div class = "form-group">
							<label for="fn">First Name:</label>
							<input type="text" class="form-control" id="fn" name="firstName" value="<?php echo $_SESSION["firstName"] ?>">
						</div>
						
						<div class = "form-group">
							<label for="fn">Last Name:</label>
							<input type="text" class="form-control" id="ln" name="lastName" value="<?php echo $_SESSION["lastName"] ?>" >
						</div>
					   
						<div class="form-group">
							<label for="em">Email:</label>
							<input type="email"	class="form-control" id="em" name="email" value="<?php echo $_SESSION["email"] ?>">
						</div>
						
						<div class="form-group">
							<label for="pwd">Password:</label>
							<input type="password" class="form-control" id="pwd" name="password" placeholder="*******"  value="<?php echo $_SESSION["password"] ?>">
						</div>
						
						<div class="form-group">
							<label for="cpwd">Confirm Password:</label>
							<input type="password" class="form-control" id="cpwd" name="confirmPassword" placeholder="*******" value="<?php echo $_SESSION["password"] ?>">
						</div>
							
						<div class="form-group">
							<label for="SA">Street Address:</label>
							<input type="text"	class="form-control" id="SA" name="streetAddress" value="<?php echo $_SESSION["streetAddress"] ?>">
						</div>
						
						<div class="form-group">
							<label for="pc">Postal Code:</label>
							<input type="text" class="form-control" id="pc" name="postalCode" value="<?php echo $_SESSION["postalCode"] ?>" pattern="[A-Za-z][0-9][A-Za-z]\ [0-9]+[A-Za-z]+[0-9]" title="Ex. A1A 1A1">
						</div>
							
						<div class="form-group">
							<label for="thedate">Date of Birth (yyyymmdd):</label>
							<input type="date" class="form-control" id="thedate" name="DOB" value="<?php echo $_SESSION["DOB"] ?>" pattern="[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]"/>
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
		</div>
	</div>

</body>
</html>
