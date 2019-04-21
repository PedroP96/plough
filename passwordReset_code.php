<?php
	require_once("dbConnect.php");

	$emailAddress = $_POST['email'];

	$checkEmail = "SELECT * FROM USERS WHERE EMAIL = '$emailAddress'";
	$result_checkEmail = mysqli_query($conn, $checkEmail);
	$row = $result_checkEmail -> fetch_assoc();


	if(mysqli_num_rows($result_checkEmail) <= 0) {

		echo "<script>alert('That email is not registered in our database!');window.location.href='forgotten-password.php'</script>";

	} else {

	 	function generateRandomPass($length = 10) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomPass = '';
		    for ($i = 0; $i < $length; $i++) {
		       $randomPass .= $characters[rand(0, $charactersLength - 1)];
		    }
		return $randomPass;
		}

		$newPass = generateRandomPass();
	
		$updatePass = "UPDATE USERS SET PASSWORD = '$newPass' WHERE EMAIL = '$emailAddress'";

		$to = $emailAddress;

		$subject = "New Password";
		$message = "Your new password is: $newPass";
		$headers = 'From: Plough <plough.shop@gmail.com>' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

  		mail( $to, $subject, $message, $headers );

  		echo "<script>alert('Password reset!');window.location.href='login.php'</script>";
	} 
?>

