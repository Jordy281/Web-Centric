<?php
    require_once('../Cart.php');
    session_start();
    $cart= unserialize($_SESSION["cart"]);
    $ball= new Item("soccer",10);
    $cart->addItem($ball);
    
    header('Location: ../Profile.php')
    
?>
