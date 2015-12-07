<?php
    
    //save cart
    
    //clear session data
    var_dump($_SESSION['user']);
    var_dump($_SESSION['cart']);
    
    //disconnect database
    require_once('../mysqli_connect.php');
    mysqli_close();
    
    //redirect to login
    header('Location: index.php');
?>