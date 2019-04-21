<?php 
	session_start();
	unset($_SESSION['USERID']);
	session_destroy();
	echo "<script>alert('Successfully logged out!');window.location.href='index.php';</script>";
	exit();
?>
