<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $first= $_POST['Firstname'];
        $last=$_POST['Lastname'];
        $comment=$_POST['comment'];
        echo "Welcome ".$first. $last."<br/>";
        echo "Here is the message". $comment."<br/>";
        
        file_put_contents('temp.txt', $first.','.$last. ',' . $comment.'\n');
        
    }
    
    function getFirst(){
        $data = file_get_contents('temp.txt');
        $pieces = explode(',', $data);
        echo htmlspecialchars($pieces[0]);
    }
    
        function getLast(){
        $data = file_get_contents('temp.txt');
        $pieces = explode(',', $data);
        echo htmlspecialchars($pieces[1]);
    }
    
        function getComment(){
        $data = file_get_contents('temp.txt');
        echo htmlspecialchars($pieces[2]);
    }
    
?>