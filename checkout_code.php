<?php
	session_start();

	require_once("dbConnect.php");

	$userID = $_SESSION['USERID'];
	$finalPrice = $_SESSION['finalPrice'];
	$discounted = $_SESSION['discounted'];
		

	$checkStock = "SELECT BASKET.* , PRODUCTS.P_IMAGE , PRODUCTS.P_NAME FROM BASKET JOIN PRODUCTS ON (PRODUCTS.PRODUCTID=BASKET.PRODUCTID) WHERE BASKET.USERID = '$userID';";
	$result_checkStock = mysqli_query($conn, $checkStock);
			
	if(mysqli_num_rows($result_checkStock) >= 0)  {

		while($row = mysqli_fetch_array($result_checkStock)) {
			$checkStock2 = "SELECT P_STOCK FROM PRODUCTS WHERE PRODUCTID = '".$row['PRODUCTID']."'";
			$result_checkStock2 = mysqli_query($conn, $checkStock2);

			if(mysqli_num_rows($result_checkStock2) >= 0) {
				while($row2 = mysqli_fetch_array($result_checkStock2)) {
					if($row2['P_STOCK'] >= $row['B_ITEM_QTY']) {
						$stock = True;
					} else {
						$stock = False;
						$productName = $row['P_NAME'] ;
					}
				}
			}
		}

	if($stock == TRUE) {
			$insertOrder = "INSERT INTO ORDERS VALUES (DEFAULT, '$userID', SYSDATE(), 'Processing', '$discounted', '$finalPrice')";
			$result_insertOrder = mysqli_query($conn, $insertOrder);
			$orderID = mysqli_insert_id($conn);

		$result_checkStock = mysqli_query($conn, $checkStock);
		if(mysqli_num_rows($result_checkStock) >= 0)  {

			while($row = mysqli_fetch_array($result_checkStock)) {
				$updateStock = "UPDATE PRODUCTS SET P_STOCK = '".($row2['P_STOCK'] - $row['B_ITEM_QTY'])."' WHERE PRODUCTID = '".$row['PRODUCTID']."'";
				$result_updateStock = mysqli_query($conn, $updateStock);
			}

		}

			if(($result_insertOrder)) {

				$query = "SELECT BASKET.* , PRODUCTS.P_IMAGE , PRODUCTS.P_NAME FROM BASKET JOIN PRODUCTS ON (PRODUCTS.PRODUCTID=BASKET.PRODUCTID) WHERE BASKET.USERID = '$userID';";
				$result = mysqli_query($conn, $query);
				
				if(mysqli_num_rows($result) >= 0) {

					while($row = mysqli_fetch_array($result)) {

					$insertOrderDet = "INSERT INTO ORDERDETAILS VALUES ('$orderID', '".$row['PRODUCTID']."', '".$row['B_ITEM_QTY']."', '".$row['B_ITEM_PRICE']."');";
					$result_insertOrderDet = mysqli_query($conn, $insertOrderDet);
					}

					if($result_insertOrderDet) {
						$deteleBasket = "DELETE FROM BASKET WHERE USERID = '$userID';";
						$result_deleteBasket = mysqli_query($conn, $deteleBasket);

						if($result_deleteBasket) {
							echo "<script>alert('Payment Successful!');window.location.href='payment-successful.php?orderNo=".$orderID."';</script>";
						} else {
							echo "<script>alert('Error deleting basket!');window.location.href='checkout.php';</script>";
						}
					} else {
						echo "<script>alert('Error inserting details!');window.location.href='checkout.php';</script>";
					}
				}
			} else {
				echo "<script>alert('Error!');window.location.href='checkout.php';</script>";
			}
		}	else {
			echo "<script>alert('".$productName." is out of stock!');window.location.href='checkout.php';</script>";
		}
	}
?>