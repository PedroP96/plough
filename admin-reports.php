<?php 
	include('dbConnect.php');
	session_start();
	if(isset($_SESSION['USER_TYPE'])!='Admin') {
		echo "<script>alert('You are not an Admin!');location.href='login.php';</script>";
		exit();
	}else{

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Reports</title>
	<link rel="stylesheet" type="text/css" href="plough.css">
</head>
<body>
	<div class="mainContainer">
		<div class="header">
			<div class="firstRow">
				<img id="logo" src="images/Plough.png" alt="Plough Logo">
				<a id="logoutLink" href="logoutSession.php">Logout</a> 
			</div>
			<div class="secondRow">
					<span class="adminText">Administrator Page</span>
            		<a class="adminLinks" href="admin-home.php">Account Management</a>
            		<a class="adminLinks" href="adminStock.php">Stock Management</a>
            		<a class="adminLinks" href="admin-reports.php">System Reports</a> 
			</div>
		</div>
		<div class="mainContent">
			<div id="reportButtons_container">
				<button onclick="window.location.href = 'admin-report-sales.php'">Sales Report</button>
				<button onclick="window.location.href = 'admin-report-wastage.php'">Wastage Report</button>
				<button onclick="window.location.href = 'admin-report-trending-products.php'">Trending Products</button>
				<button onclick="window.location.href = 'admin-report-orders.php'">Orders</button>
			</div>
		</div>
	</div>
	<footer class="footer">
		<div class="footerContent">
			<a class="footerlink" href="terms-and-conditions.php">T&amp;C</a> 
			<span class="footerlink">| </span>
			<a class="footerlink" href="privacy-policy.php">Privacy Policy</a>
		</div>
	</footer>
</body>
</html>
<?php
}
?>