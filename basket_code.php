<?php
	session_start();
	require('dbConnect.php');

	$userID = $_POST['hidden_userID'];

	if(isset($_POST['reset_cart'])) {

		$resetBasket = "DELETE FROM BASKET WHERE USERID = '$userID';";
		$result_resetBasket = mysqli_query($conn, $resetBasket);

		if($result_resetBasket) {
				echo "<script>alert('Basket deleted');window.history.go(-1);</script>";
			} else {
				echo "<script>alert('Error!');window.history.go(-1);</script>";
				exit();
			}
	} elseif($_POST['checkout']) {

		$checkBasket = "SELECT * FROM BASKET WHERE USERID = '$userID';";
		$result_checkBasket = mysqli_query($conn, $checkBasket);

		if(mysqli_num_rows($result_checkBasket) <= 0) {
			echo "<script>alert('The basket is empty!');window.location.href='basket.php';</script>";
		}

		echo "<script>window.location.href='checkout.php';</script>";
	}
?>