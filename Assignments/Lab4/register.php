<?php
    $pageTitle = 'The website';
    
    //header('Location: View.php');
    include "User.php";
    $Users = array();
    
    if(isset($_POST['submitted'])){
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
            $e = escape_data($_POST['email']);
        } else {
            $e = FALSE;
            echo '<p><font color="red" size="+1">Please enter a valid email address!</font></p>';
        }
        // Check for a street.
        if (preg_match ('%^[A-Za-z0-9\.\' \-]{5,30}$%', stripslashes(trim($_POST['street'])))) {
            $s = escape_data($_POST['street']);
        } else {
            $s = FALSE;
            echo '<p><font color="red" size="+1">Please enter your street address!</font></p>';
        }

        //Check Password
        if (preg_match ('%^[A-za-z0-9]{4,20}$%', stripslashes(trim($_POST['password'])))) {
            if (preg_match ('%^[A-za-z0-9]{4,20}$%', stripslashes(trim($_POST['confirmPassword'])))) {
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
        
        //Check Postal Code
        if (preg_match ('[A-Z]|[a-z]+[0-9]+[A-Z]|[a-z]+ +[0-9]+[A-Z]|[a-z]+[0-9]', stripslashes(trim($_POST['postalCode'])))){
            $postalCode=escape_data($_POST['postalCode']);
        }else{
            echo '<p><font color="red" size="+1">Please enter your postal code!</font></p>';
        }
        //Check Dat of Birth
        if (preg_match ('%^[0-9]{6}$%', stripslashes(trim($_POST['DOB'])))){
            $DOB=escape_data($_POST['DOB']);
        }else{
            echo '<p><font color="red" size="+1">Please enter your dat of birth!</font></p>';
        }
        
        


        $gender=$_POST['Gender'];
        
        $newUser= new User($firstName,$lastName, $email, $password,$confirmationPassword,$streetAddress,$postalCode,$DOB,$gender);
        
        //connect to the database
        require_once('../mysqli_connect.php');
        $query = "INSERT INTO students(firstName, lastName, email, password, streetAddress, postalCode, DOB, gender) VALUES (NULL,?,?,?,?,?,?,?,?)";
        
        $stmt=mysqli_prepare($dbc, $query);
        
        mysqli_stmt_bind_param($stmt, "ssssssds", $firstName,$lastName,$email,$password, $streetAddress, $postalCode, $DOB, $gender);
        
        mysqli_stmt_execute($stmt);
        
        $affected_rows = mysqli_affected_rows($stmt);
        
        //Check if the information entered correctly
        if($affected_rows==1){
            echo ' Student Entered';
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }else{
            echo 'ERROR OCCURED';
            mysqli_error();
            mysqli_stmt_close($stmt);
            mysqli_close($dbc);
        }
    }
    
    function passwordChecker($p1,$p2){
        if (strcmp($p1,$p2)!=0){
            exit("Passwords dont match, Goodbye");
        }
    };
?>