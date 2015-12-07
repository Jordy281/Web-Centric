<?php
  
    //header('Location: View.php');
    require_once('User.php');
    require_once('Cart.php');
    require_once('../mysqli_connect.php');

    
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
 
        $newUser= User::newUser($dbc, $firstName,$lastName, $email, $password,$streetAddress,$postalCode,$DOB,$gender);
        $newCart = $newUser->newCart($dbc,$newUser->getID());
        
            
        session_start();
        $_SESSION["user"]=serialize($newUser);
        $_SESSION["cart"]=serialize($newCart);
        header('Location: WelcomePage.php');
    }
    
    function passwordChecker($p1,$p2){
            if (strcmp($p1,$p2)!=0){
                exit("Passwords dont match, Goodbye");
            }else{
                return TRUE;
            }
        }
?>