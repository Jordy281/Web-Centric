<?php
// Define these as constants so that they can’t be changed
DEFINE ('DBUSER', 'user');
DEFINE ('DBPW', 'pwd');
DEFINE ('DBHOST', 'localhost');
DEFINE ('DBNAME', 'lab');

//create connection
$conn=new mysqli(DBHOST, "admin", "password");

//create database
$sql = "CREATE DATABASE lab";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}

//sql to create
$sql = "create table Users(
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
phone VARCHAR(13))";

if ($conn->query($sql) === TRUE) {
    echo "Table lab created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

//Edit permissions of user in database

$sql = "CREATE USER ".DBUSER;

if($sql->query($sql)==TRUE){
    echo "Permissions set";
}else{
    echo"Permissions not set";
}


if ($dbc = mysql_connect (DBHOST, DBUSER, DBPW)) {

if (!mysql_select_db (DBNAME)) { // If it can’t select the database.
    trigger_error("Could not select the database!<br />");
    exit();
}

} else {
    trigger_error("Could not connect to MySQL!<br /> ");
    exit();
}

function escape_data ($data) {

    if (function_exists("mysql_real_escape_string")) {
        global $dbc; // Need the connection.
        $data = mysql_real_escape_string (trim($data), $dbc);
        $data = strip_tags($data);
    } else {
        $data = mysql_escape_string (trim($data));
        $data = strip_tags($data);
    }
    return $data;
}

?>