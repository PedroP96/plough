<?php
session_start();
include('dbConnect.php');

$prodid = $_POST['prodid'];
$userid = $_SESSION['USERID'];

if($_POST['admin_stock_delete']=='Delete Stock') {

		$sql2 = "DELETE FROM PRODUCTS WHERE PRODUCTID = '$prodid'";
		$conn->query($sql2);

		if(mysqli_num_rows($conn)>=0){
			echo "<script>alert('$prodid Deleted');location.href='adminStock.php';</script>";
		}else{
			echo "<script>alert('Error Updating');location.href='adminStock.php';</script>";
		}
} else {

		$towaste = "INSERT INTO WASTAGE(PRODUCTID,W_NAME,W_EXP_DATE,W_QUANTITY,W_PRICE)
						SELECT PRODUCTID, P_NAME, P_EXPIRATION_DATE, P_STOCK, P_PRICE
						FROM PRODUCTS
						WHERE PRODUCTID = '$prodid'";
				$conn->query($towaste);



		$sql3 = "UPDATE PRODUCTS SET P_STOCK='20' WHERE PRODUCTID= '$prodid'";

		$conn->query($sql3);

		if(mysqli_num_rows($conn)>=0){
			echo "<script>alert('Stock Updated');location.href='adminStock.php';</script>";
		}else{
			echo "<script>alert('Error Updating');location.href='adminStock.php';</script>";
			}
}
?>