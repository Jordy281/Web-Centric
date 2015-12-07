<?php
    require_once('Cart.php');
    require_once('Item.php');
    require_once('../mysqli_connect.php');
    session_start();
    $cart= unserialize($_SESSION["cart"]);
    $puck= new Item("Hockey Puck",5);
    $cart->addItem($puck);
    $cart->update($dbc);
    $_SESSION["cart"]=serialize($cart);
    
    
    
    header('Location: viewCart.php');
    
?>