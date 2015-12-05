<?php
  
    //header('Location: View.php');
    require_once('User.php');
    
    require_once('../mysqli_connect.php');
    //echo "Connected to DB";
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //First name check for unwanted characters
        if (preg_match ('%^[A-Za-z\.\'\-]{2,15}$%', stripslashes(trim($_POST['firstName'])))){
            $firstName=escape_data($_POST['firstName']);
        }else{
            echo '<p><font color="red" size="+1">Please enter your first name!</font></p>';
        }
        
        //Check lastname
        if (preg_match ('%^[A-Za-z\.\'\-]{2,15}$%', stripslashes(trim($_POST['lastName'])))){
            $lastName=escape_data($_POST['lastName']);
        }else{
            echo '<p><font color="red" size="+1">Please enter your last name!</font></p>';
        }
        

        // Check for an email address.
        if (preg_match ('%^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['email'])))) {
            $email = escape_data($_POST['email']);
        } else {
            die("Invalid Email");
        }
        // Check for a street.
        if (preg_match ('%^[A-Za-z0-9\.\' \-]{5,30}$%', stripslashes(trim($_POST['streetAddress'])))) {
            $streetAddress = escape_data($_POST['streetAddress']);
        } else {
            $streetAddress = "";
        }

        //Check Password
        if (preg_match ('%^[A-za-z0-9]{4,20}$%', stripslashes(trim($_POST['password'])))) {
            $password = escape_data($_POST['password']);
            if (preg_match ('%^[A-za-z0-9]{4,20}$%', stripslashes(trim($_POST['confirmPassword'])))) {
                $confirmationPassword =escape_data($_POST['confirmPassword']);
                if(passwordChecker($password,$confirmationPassword)){
                    $password = escape_data($_POST['password']);
                }
                else{
                    $password = FALSE;
                    echo '<p><font color="red" size="+1">Your password did not match the confirmed password!</font></p>';
                }
            }else{
                $password = FALSE;
                echo '<p><font color="red" size="+1">Please enter a valid password!</font></p>';
            }    
        }else{
            $password = FALSE;
            echo '<p><font color="red" size="+1">Please enter a valid password!</font></p>';
        }
        
        //Check Postal Code'
        if (preg_match ('%^[A-Za-z][0-9][A-Za-z]" "[0-9][A-Za-z][0-9]$%', stripslashes(trim($_POST['postalCode'])))){
            $postalCode=escape_data($_POST['postalCode']);
        }else{
            $postalCode="";
        }
        //Check Dat of Birth
        if (preg_match ('%^[0-9]{6}$%', stripslashes(trim($_POST['DOB'])))){
            $DOB=escape_data($_POST['DOB']);
        }else{
            $DOB="00000000";
        }
        
        $gender=$_POST['Gender'];
        
        //Insert info into the database
        $query = "INSERT INTO users(firstName,lastName,email, password, streetAddress, postalCode, DOB, gender) VALUES (?,?,?,?,?,?,?,?)";
        //Prepare mysqli statement
        $stmt=mysqli_prepare($dbc, $query);
        if ( !$stmt ) {
            die('mysqli error: '.mysqli_error($dbc));
        }
        
        //Bind parameters
        mysqli_stmt_bind_param($stmt, "ssssssds", $firstName,$lastName,$email,$password, $streetAddress, $postalCode, $DOB, $gender);
        if ( !mysqli_execute($stmt) ) {
            die( 'stmt error: '.mysqli_stmt_error($stmt) );
        }
        
        //Query to get user ID
        $query="SELECT id FROM users WHERE email=?";
        
        $stmt=mysqli_prepare($dbc,$query);
        if ( !$stmt ) {
            die('mysqli error: '.mysqli_error($dbc));
        }
        mysqli_stmt_bind_param($stmt,"s",$email);
        
        if ( !mysqli_stmt_execute($stmt)){
            die( 'stmt error1: '.mysqli_stmt_error($stmt) );
        }
        
        mysqli_stmt_bind_result($stmt, $id);
        while (mysqli_stmt_fetch($stmt)) {
            $newUser= new User($id, $firstName,$lastName, $email, $password,$streetAddress,$postalCode,$DOB,$gender);
            session_start();
            $_SESSION["user"]=serialize($newUser);
            
            
            
            
            
            
            //Make a new cart and save it to the DB
            //Insert info into the database
            $query = "INSERT INTO carts(holder) VALUES (?)";
            //Prepare mysqli statement
            $stmt=mysqli_prepare($dbc, $query);
            if ( !$stmt ) {
                die('mysqli error1: '.mysqli_error($dbc));
            }
            
            //Bind parameters
            mysqli_stmt_bind_param($stmt, "d", $id);
            if ( !mysqli_execute($stmt) ) {
                die( 'stmt error: '.mysqli_stmt_error($stmt) );
            }
            
            //Query to get cart ID
            $query="SELECT id FROM carts WHERE holder=?";
            
            $stmt=mysqli_prepare($dbc,$query);
            if ( !$stmt ) {
                die('mysqli error2: '.mysqli_error($dbc));
            }
            mysqli_stmt_bind_param($stmt,"d",$id);
            
            if ( !mysqli_stmt_execute($stmt)){
                die( 'stmt error3: '.mysqli_stmt_error($stmt) );
            }
            
            mysqli_stmt_bind_result($stmt, $cart_id);
            
            while (mysqli_stmt_fetch($stmt)) {
                $newCart = new Cart($cart_id, $id);
                $_SESSION=serialize($newCart);
                header('Location: WelcomePage.php');
            }  
        }
     
        
        
        
    }
    
    function passwordChecker($p1,$p2){
        if (strcmp($p1,$p2)!=0){
            exit("Passwords dont match, Goodbye");
        }else{
            return TRUE;
        }
    };
?>