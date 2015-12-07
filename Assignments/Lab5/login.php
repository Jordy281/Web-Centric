<?php

    //Connect to the database
    require_once('../mysqli_connect.php');
    require_once('User.php');
    require_once('Cart.php');
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

        // Load User
        $newUser=User::loadUser($dbc,$email,$password);
        
        //Load Cart
        $cart=$newUser->loadCart($dbc);
        
        //Save em to session
        session_start();
        $_SESSION["user"]=serialize($newUser);
        $_SESSION["cart"]=serialize($cart);
        
        header('Location: WelcomePage.php');
        
        mysqli_close($dbc);
        
        
    }

?> 