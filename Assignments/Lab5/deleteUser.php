<?php
	
	require_once('../mysqli_connect.php');
    require_once('User.php');
	
	session_start();
	
	$user=unserialize($_SESSION["user"]);
	$query = "DELETE FROM users WHERE id=?";
        
    $stmt=mysqli_prepare($dbc, $query);
	
    if ( !$stmt ) {
        die('mysqli error: '.mysqli_error($dbc));
    }
        
    mysqli_stmt_bind_param($stmt, "d", $user->id);
        
	if ( !mysqli_execute($stmt) ) {
        die( 'stmt error: '.mysqli_stmt_error($stmt) );
    }
	
	header('Location: logout.php');
?>
