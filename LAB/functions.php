<?php
    
    function form_contact($first, $last, $gender, $comment){
        namePrinter($first,$last, $gender);
        echo " said: ".$comment;
    }
    
    function namePrinter($first, $last, $gender){
        switch($gender){
            case 'Male': 
                echo 'Mr. '.$first.' '.$last."<br/>";    
            case 'Female':
                echo 'Ms. '.$first.' '.$last."<br/>";
            
        }
    }
?>