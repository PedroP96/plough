<?php
	session_start();

	 require_once("dbConnect.php");

	 $email = $_POST['login_email'];
	 $password = $_POST['login_pass'];

	 $checkLogin = "SELECT * FROM USERS WHERE EMAIL = '$email'";
	 $result_checkLogin = mysqli_query($conn, $checkLogin);
	 $row = $result_checkLogin -> fetch_assoc();


	 if(mysqli_num_rows($result_checkLogin) <= 0) {

	 	echo "<script>alert('That email is not registered in our database!');window.location.href='login.php';</script>";

	 } else {

	 	if($password == $row['PASSWORD']){

	 		if($row['USER_TYPE'] == 'User') {

	 			$_SESSION['USERID'] = $row['USERID'];
	 			$_SESSION['FIRST_NAME'] = $row['FIRST_NAME'];
	 			echo "<script>alert('Successful Login!');window.location.href='fruits-and-veg.php';</script>";

	 		} else if ($row['USER_TYPE'] == 'Admin') {

	 			$_SESSION['USER_TYPE'] = $row['USER_TYPE'];
	 			echo "<script>alert('Welcome!');window.location.href='admin-home.php'</script>";
	 		}
	 	} else {
	 		echo "<script>alert('Wrong Password!');window.location.href='login.php'</script>";
	 	}
	 }
?>
