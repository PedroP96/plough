<?php
session_start();
include('dbConnect.php');

$orderid = $_POST['orderid'];
$userid = $_SESSION['USERID'];

$cancelorder = "UPDATE ORDERS SET O_STATUS = 'CANCELLED' WHERE ORDERID ='$orderid';";
$result_check =mysqli_query($conn, $result_check);

if(mysqli_num_rows($result_check)>=0){
	echo "<script>alert('Order Cancelled');window.history.go(-1);</script>";
}else{
	echo "<script>alert('Error Cancelling Order');window.history.go(-1);</script>";
}
?>