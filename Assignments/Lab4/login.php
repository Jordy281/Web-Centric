<?php

    //Connect to the database
    require_once('../mysqli_connect.php');
    require_once('User.php');
    if($_SERVER['REQUEST_METHOD']=='POST'){
        //Check Email
        if (preg_match ('%^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['email'])))) {
            $email = escape_data($_POST['email']);
        } else {
            $email = FALSE;
            echo '<p><font color="red" size="+1">Please enter a valid email address!</font></p>';
        }

        if (preg_match ('%^[A-za-z0-9]{4,20}$%', stripslashes(trim($_POST['password'])))) {
            $password = escape_data($_POST['password']);
        }else{
            $password = FALSE;
            echo '<p><font color="red" size="+1">Please enter a valid password!</font></p>';
        }       
        
        $query = "SELECT * FROM users WHERE email = ?";
        
        $stmt=mysqli_prepare($dbc,$query);
        if ( !$stmt ) {
            die('mysqli error: '.mysqli_error($dbc));
        }
        mysqli_stmt_bind_param($stmt,"s",$email);
        
        if ( !mysqli_stmt_execute($stmt)){
            die( 'stmt error1: '.mysqli_stmt_error($stmt) );
        }
        
        mysqli_stmt_bind_result($stmt, $id, $firstName,$lastName,$email, $db_password, $streetAddress, $postalCode, $DOB, $gender);
        
        while (mysqli_stmt_fetch($stmt)) {
            if(strcmp($db_password,$password)==0){
                $newUser= new User($id, $firstName,$lastName, $email, $password,$streetAddress,$postalCode,$DOB,$gender);
                $newUser->sessionUser();
                header('Location: WelcomePage.php');
                
            }else{
                echo"Login Failed : <br>email: ".$email."<br>db:".$db_password." actual:".$password;
            }
        }
        
        mysqli_close($dbc);
        
        
    }

?> 