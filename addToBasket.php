<?php
	session_start();
	require('dbConnect.php');
	$productID = $_POST['hidden_id'];
	$quantity = $_POST['quantity'];
	$price = $_POST['hidden_price'];
	$userID = $_POST['hidden_userid'];
	$productName = "";

	$checkStock2 = "SELECT P_STOCK, P_NAME FROM PRODUCTS WHERE PRODUCTID = '$productID'";
	$result_checkStock2 = mysqli_query($conn, $checkStock2);

	if(mysqli_num_rows($result_checkStock2) >= 0) {
		while($row2 = mysqli_fetch_array($result_checkStock2)) {
			if($row2['P_STOCK'] >= $quantity) {
				$stock = True;
				$productName = $row2['P_NAME'] ;
			} else {
				$stock = False;
				$productName = $row2['P_NAME'] ;
			}
		}
	}

	if($stock == True) {
		$addToBasket = "INSERT INTO BASKET VALUES ('$userID', '$productID', '$price', '$quantity')";
		$result_addToBasket = mysqli_query($conn, $addToBasket);

		if($result_addToBasket) {
			echo "<script>alert('Product added to cart!');window.history.go(-1);</script>";
		} else {
			echo "<script>alert('Product already in cart!');window.history.go(-1);</script>";
			exit();
		}
	} else {
		$result_checkStock2 = mysqli_query($conn, $checkStock2);
		$row = mysqli_fetch_array($result_checkStock2);
		echo "<script>alert('Available stock of ".$productName." is ".$row['P_STOCK']."!');window.history.go(-1);</script>";
	}

?>

