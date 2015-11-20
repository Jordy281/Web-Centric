<?php
    DEFINE('servername', '127.0.0.1');
    DEFINE('database', 'webcentric');
    DEFINE('username','webuser');
    DEFINE('password','password');
    global $dbc;
    
    if ($dbc= @mysqli_connect(servername,username,password)){
        if (!mysqli_select_db($dbc, database)){
            trigger_error('Could not select database');
            exit();
        }
    } else {
        trigger_error("Could not connect to MYSQL");
        exit();
    }
    
    function escape_data($data){
        if (function_exists('mysqli_real_escape_string')){
            global $dbc;
            $data = mysqli_real_escape_string($dbc, trim($data));
            $data = strip_tags($data);
        }else{
            $data = mysqli_escape_string($trim($data));
            $data = strip_tags($data);
        }
        return $data;
    }   
    
?> 