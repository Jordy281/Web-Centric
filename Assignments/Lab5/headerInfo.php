<?php
    $pageTitle= "Hello World";
    //Each link will contain a link name and an address
    // For the purpose of this exercise, we will use a blank address
    
    //Format:
    //$link= array("Page Title", href)
    $link1 = array("All Users",'getUsers.php');
    $link2 = array("Home", 'WelcomePage.php');
    $link3 = array("Link3", '');
    $link4 = array("Link4", '');
    $link5 = array("Link5", '');
    
    //put all information into an array    
    $headervalues = array($link1,$link2,$link3,$link4, $link5);
?>