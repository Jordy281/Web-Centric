<?php
	
	if (isset($_POST['submit'])){
		
		session_start();
		require_once('../mysqli_connect.php');
		require_once('Cart.php');
		require_once('User.php');
		
		$cart=unserialize($_SESSION['cart']);
		$user=unserialize($_SESSION['user']);
		
		//First name check for unwanted characters
		if (preg_match ('%^[A-Za-z\.\'\-]{2,15}$%', stripslashes(trim($_POST['BfirstName'])))){
			$BFN=escape_data($_POST['BfirstName']);
		}
        
        
        //Check lastname
		if (preg_match ('%^[A-Za-z\.\'\-]{2,15}$%', stripslashes(trim($_POST['BlastName'])))){
			$BLN=escape_data($_POST['BlastName']);
		}
        

        	// Check for an email address.
		if (preg_match ('%^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['Bemail'])))) {
			$email = escape_data($_POST['Bemail']);
		}
        
        	// Check for a street.
		if (preg_match ('%^[A-Za-z0-9\.\' \-]{5,30}$%', stripslashes(trim($_POST['BstreetAddress'])))) {
			$BSA = escape_data($_POST['BstreetAddress']);
		}
		
		// Check for a city.
		if (preg_match ('%^[A-Za-z0-9\.\' \-]{5,30}$%', stripslashes(trim($_POST['Bcity'])))) {
			$BC = escape_data($_POST['Bcity']);
		}
		
		// Check for a country.
		if (preg_match ('%^[A-Za-z0-9\.\' \-]{5,30}$%', stripslashes(trim($_POST['Bcountry'])))) {
			$BCoun = escape_data($_POST['Bcountry']);
		}
    
		//Check Postal Code
		if (preg_match ('%^[A-Za-z][0-9][A-Za-z][0-9][A-Za-z][0-9]$%', stripslashes(trim($_POST['BpostalCode'])))){
			$BPC=escape_data($_POST['BpostalCode']);
		}

		//=====================================================
		
				//First name check for unwanted characters
		if (preg_match ('%^[A-Za-z\.\'\-]{2,15}$%', stripslashes(trim($_POST['SfirstName'])))){
			$SFN=escape_data($_POST['SfirstName']);
		}else{
			$SFN=$BFN;
		}
        
        
        	//Check lastname
		if (preg_match ('%^[A-Za-z\.\'\-]{2,15}$%', stripslashes(trim($_POST['SlastName'])))){
			$SLN=escape_data($_POST['SlastName']);
		}else{
			$SLN=$BLN;
		}
                
        	// Check for a street.
		if (preg_match ('%^[A-Za-z0-9\.\' \-]{5,30}$%', stripslashes(trim($_POST['SstreetAddress'])))) {
			$SSA = escape_data($_POST['SstreetAddress']);
		}else{
			$SSA=$BSA;
		}
		
		// Check for a city.
		if (preg_match ('%^[A-Za-z0-9\.\' \-]{5,30}$%', stripslashes(trim($_POST['Scity'])))) {
			$SC = escape_data($_POST['Scity']);
		}else{
			$SC=$BC;
		}
		
		// Check for a country.
		if (preg_match ('%^[A-Za-z0-9\.\' \-]{5,30}$%', stripslashes(trim($_POST['Scountry'])))) {
			$SCoun = escape_data($_POST['Scountry']);
		}else{
			$SCoun=$BCoun;
		}
		
        	//Check Postal Code
		if (preg_match ('%^[A-Za-z][0-9][A-Za-z]" "[0-9][A-Za-z][0-9]$%', stripslashes(trim($_POST['SpostalCode'])))){
			$SPC=escape_data($_POST['SpostalCode']);
		}else{
			$SPC=$BPC;
		}

		//=====================================================

		

		$cart->purchase($BFN,$BLN,$email,$BSA,$BC,$BCoun, $BPC, $SFN,$SLN,$SSA,$SC,$SCoun,$SPC);
		
		//
		unset($_SESSION['cart']);
		unset($cart);
		
		//Make a new cart and save it to the DB
	        $cart = $user->newCart($user->getID());
	        $_SESSION["cart"]=serialize($newCart);
			
	        header('Location: WelcomePage.php');
        
	}
?>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Purchase</title>
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
	<div class = "container-fluid">
		<div class="row" style="padding:3px;">
			<div class="col-sm-1"></div>
			<form role="form">
				<label class="radio-inline"><input type="radio" value="Ship" checked onclick="shipToBill()">Shipping is the same as Billing: </label>
				<label class="radio-inline"><input type="radio" value="Ship" onclick="shipDifBill()">Shipping is different than the Billing: </label>
			</form>
		</div>
		<div class="row" style="padding:1%;margin:1%;">
			<form role ="form" method = "POST">
				<div class="col-md-4"  style="background-color: #F8F8F8; border-radius: 20px; padding:1%; margin:1%;">
					<h3>Billing Information</h3>
				
					<div class = "form-group">
						<label for="fn">First Name:</label>
						<input type="text" class="form-control" id="fn" name="BfirstName" required>
					</div>
					
					<div class = "form-group">
						<label for="fn">Last Name:</label>
						<input type="text" class="form-control" id="ln" name="BlastName" required>
					</div>
				   
					<div class="form-group">
						<label for="em">Email:</label>
						<input type="email"	class="form-control" id="em" name="Bemail" required>
					</div>
						
					<div class="form-group">
						<label for="SA">Street Address:</label>
						<input type="text"	class="form-control" id="SA" name="BstreetAddress" required>
					</div>
					
					<div class="form-group">
						<label for="city">City:</label>
						<input type="text"	class="form-control" id="city" name="Bcity" required>
					</div>
					
					<div class="form-group">
						<label for="city">Country:</label>
						<input type="text"	class="form-control" id="country" name="Bcountry" required>
					</div>
					
					<div class="form-group">
						<label for="pc">Postal Code:</label>
						<input type="text" class="form-control" id="pc" name="BpostalCode" required pattern="[A-Za-z][0-9][A-Za-z][0-9][A-Za-z][0-9]" title="Ex. A1A1A1">
					</div>
										
					<div class = "form-group">
						<button name='submit' id="Billing" type = "submit" class = "btn btn-success">BUY</button>
					</div>
				
				</div>
			
				<div class="col-md-4" style="background-color: #F8F8F8; border-radius: 20px; padding:1%; margin:1%;" id="Shipping">
					<h3>Shipping Info</h3>
					<div class = "form-group">
						<label for="fn">First Name:</label>
						<input type="text" class="form-control" id="fn" name="SfirstName">
					</div>
					
					<div class = "form-group">
						<label for="fn">Last Name:</label>
						<input type="text" class="form-control" id="ln" name="SlastName">
					</div>
						
					<div class="form-group">
						<label for="SA">Street Address:</label>
						<input type="text"	class="form-control" id="SA" name="SstreetAddress">
					</div>
					
					<div class="form-group">
						<label for="city">City:</label>
						<input type="text"	class="form-control" id="city" name="Scity">
					</div>
					
					<div class="form-group">
						<label for="city">Country:</label>
						<input type="text"	class="form-control" id="country" name="Scountry">
					</div>
					
					<div class="form-group">
						<label for="pc">Postal Code:</label>
						<input type="text" class="form-control" id="pc" name="SpostalCode" pattern="[A-Za-z][0-9][A-Za-z][0-9][A-Za-z][0-9]" title="Ex. A1A1A1">
					</div>
										
					<div class = "form-group">
						<button name='submit' type = "submit" class = "btn btn-success">BUY</button>
					</div>
				</div>
			</form>
		</div>
	</div>


</body>
</html>
