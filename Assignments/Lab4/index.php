
<html>
<head>
	<title>Whats Your Name?</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<script src="js/Lab4.js"></script>
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	
</head>

<body>
	<div class= "container-fluid">
		<div class = "row" id ="header">
			<?php
				require('header.php');
			?>
		</div>
		<div class="container-fluid">
			<div class = "row" id = "theContent">
				<div id = "left-ish" class="col-sm-4">
					<div class="row" id="buttonHolder">
						<button id="signup" type="Sign Up" class="btn btn-default" onclick="showNewUser()">SIGN UP</button>
						<button id="login" type="Login" class="btn btn-default" onclick="showExistingUser()">LOGIN</button>
					</div>
					<div id="registrationForm" style="display: none;">
						<form role ="form"  action= "register.php" method = "POST">
							
							<div class = "form-group">
								<label for="fn">First Name:</label>
								<input type="text" class="form-control" id="fn" name="firstName" placeholder="John">
							</div>
							
							<div class = "form-group">
								<label for="fn">Last Name:</label>
								<input type="text" class="form-control" id="ln" name="lastName" placeholder="Cena" >
							</div>
						   
							<div class="form-group">
								<label for="em">Email:</label>
								<input type="email"	class="form-control" id="em" name="email" required placeholder="someone@email.example">
							</div>
							
							<div class="form-group">
								<label for="pwd">Password:</label>
								<input type="password" class="form-control" id="pwd" name="password" placeholder="Password" required>
							</div>
							
							<div class="form-group">
								<label for="cpwd">Confirm Password:</label>
								<input type="password" class="form-control" id="cpwd" name="confirmPassword" placeholder="Password" required>
							</div>
								
							<div class="form-group">
								<label for="SA">Street Address:</label>
								<input type="text"	class="form-control" id="SA" name="streetAddress" placeholder="Address">
							</div>
							
							<div class="form-group">
								<label for="pc">Postal Code:</label>
								<input type="text" class="form-control" id="pc" name="postalCode" placeholder="A1A 1A1" pattern="[A-Z]|[a-z]+[0-9]+[A-Z]|[a-z]+ +[0-9]+[A-Z]|[a-z]+[0-9]" title="Ex. A1A 1A1">
							</div>
								
							<div class="form-group">
								<label for="thedate">Date of Birth (yyyymmdd):</label>
								<input type="date" class="form-control" id="thedate" name="DOB" pattern="[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]+[0-9]"/>
							</div>
							
							<div class="form-group">
								<label for="name">Gender:</label>
								<select name="Gender" class = "form-control">
									<option value='Male'>Male</option>
									<option value='Female'>Female</option>
								</select>
							</div>
							
							<div class = "form-group">
								<button type = "submit" class = "btn btn-default">Sign in</button>
							</div>
						</form>
					</div>
					<div id="loginForm" style="display: none;">
						<form role="form" action="login.php" method="POST">
							<div class="form-group">
								<label for="em">Email:</label>
								<input type="email"	class="form-control" id="em" name="email" required placeholder="someone@email.example">
							</div>
							<div class="form-group">
								<label for="pwd">Password:</label>
								<input type="password" class="form-control" id="pwd" name="password" placeholder="Password" required>
							</div>
							<div class = "form-group">
								<button type = "submit" class = "btn btn-default">Sign in</button>
							</div>
						</form>
					</div>
					
				</div>
				
				<div id ="right-ish" class="col-sm-8">
					<div class="row">
						<div id="col-sm-12">
							<iframe width="420" height="315" src="https://www.youtube.com/embed/ZfRr1Rcu5fw?rel=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

	