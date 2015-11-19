<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //Check Email
        if (preg_match ('%^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['email'])))) {
            $e = escape_data($_POST['email']);
        } else {
            $e = FALSE;
            echo '<p><font color="red" size="+1">Please enter a valid email address!</font></p>';
        }

        if (preg_match ('%^[A-za-z0-9]{4,20}$%', stripslashes(trim($_POST['password'])))) {
            $password = escape_data($_POST['password']);
        }else{
            $password = FALSE;
            echo '<p><font color="red" size="+1">Please enter a valid password!</font></p>';
        }
        
        //connect to the database
        require_once('../mysqli_connect.php');
        $query = "SELECT password FROM users WHERE email = ? LIMIT 1";
        
        $stmt=mysqli_prepare($dbc, $query);
        mysqli_stmt_bind_param($stmt,"s",$email);
        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_bind_result($stmt, $user_id, $firstName,$lastName,$db_password, $streetAddress, $postalCode, $DOB, $gender);
        $user_info=mysqli_fetch_object($stmt);
        
        if($db_password == $password){
            echo "Login Successful";
            //crete new USER object using user info
            //redirect to welcome page
        }
        else{
            echo"Login Failed";
        }
        
    }
?> 