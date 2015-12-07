<?php
    require_once('Cart.php');
    require_once('Item.php');
    require_once('../mysqli_connect.php');
    session_start();
    $cart= unserialize($_SESSION["cart"]);
    $ball= new Item("Football",15);
    $cart->addItem($ball);
    $cart->update($dbc);
    $_SESSION["cart"]=serialize($cart);
    
    
    
    header('Location: viewCart.php');
    
?>