<?php
    
    
    //clear session data
    $_SESSION['user']='';
    $_SESSION['cart']='';
    
    //disconnect database
    require_once('../mysqli_connect.php');
    mysqli_close();
    
    //redirect to login
    header('Location: index.php');
?>