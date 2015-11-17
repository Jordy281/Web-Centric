<?php

    include 'functions.php';
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $meetsRequirements=TRUE;
        if (preg_match ('%^[A-Za-z\.\' \-]{2,15}$%', stripslashes(trim($_POST['fn'])))) {
            $firstname = escape_data($_POST['fn']);
        }else{
            $meetsRequirements = FALSE;
        }
        if (preg_match ('%^[A-Za-z\.\' \-]{2,15}$%', stripslashes(trim($_POST['ln'])))) {
            $lastname = escape_data($_POST['ln']);
        }
        else{
            $meetsRequirements = FALSE;
        }
        
        if (preg_match ('%^[A-Za-z0-9._\%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$%', stripslashes(trim($_POST['email'])))) {
            $email = escape_data($_POST['email']);
        }else{
            $meetsRequirements = FALSE;
        }
        
        if (preg_match ('%^([0-9]( |-)?)?(\(?[0-9]{3}\)?|[0-9]{3})( |-)?([0-9]{3}( |-)?[0-9]{4}|[a-zA-Z0-9]{7})$%', stripslashes(trim($_POST['work_phone'])))) {
            $phone = escape_data($_POST['work_phone']);
        } else {
                    $meetsRequirements = FALSE;
        }
        
        if(!$meetsRequirements){
            die();
        }
        
        $_SESSION["firstname"]=$firstname;
        $_SESSION["lastname"]=$lastname;
        $_SESSION["email"]=$email;
        $_SESSION["phone"]=$phone;
        

    }

    
?>