<?php
    require_once('../mysqli_connect.php');
    //save cart
    unserialize($_SESSION['cart'])->saveCart($dbc);
    
    //clear session data
    var_dump($_SESSION['user']);
    var_dump($_SESSION['cart']);
    
    //disconnect database
    
    mysqli_close();
    
    //redirect to login
    header('Location: index.php');
?>
