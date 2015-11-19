<?php
    DEFINE('servername', '127.0.0.1');
    DEFINE('database', 'webcentric');
    DEFINE('username','webuser');
    DEFINE('password','password');

    if ($dbc= @mysqli_connect(servername,username,password)){
        if (!mysqli_select_db(database)){
            trigger_error('Could not select database');
            exit();
        }
    } else {
        trigger_error("Could not connect to MYSQL");
        exit();
    }
    
    function escape_data($data){
        if (function_exists('mysql_real_escape_string')){
            global $dbc;
            $data = mysql_real_escape_string(trim($data),$dbc);
            $data = strip_tags($data);
        }else{
            $data = mysql_escape_string($trim($data));
            $data = strip_tags($data);
        }
        return $data;
    }
    
    
    
?> 