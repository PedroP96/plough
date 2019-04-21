<?php 
	include('dbConnect.php');
	session_start();
	if(isset($_SESSION['USER_TYPE'])!='Admin') {
		echo "<script>alert('You are not an Admin!');window.history.go(-1);</script>";
		exit();
	}else{

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Stock</title>
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
			<div id="adminStock_container">
				<table id ="adminStock_table">
					<thead>
						<tr>
							<th>PRODUCT ID</th>
							<th>NAME</th>
							<th>TYPE</th>
							<th>EXPIRATION DATE</th>
							<th>DESCRIPTION</th>
							<th>PRICE</th>
							<th>STOCK</th>
							<th>PHOTO</th>
						</tr>
					</thead>
					<tbody>
					<?php 

            $sql = "SELECT * FROM PRODUCTS";
            $result = $conn->query($sql);
                        
            if($result->num_rows > 0){
                while($row = mysqli_fetch_array($result)){
                    echo "<tr><td>" . $row['PRODUCTID'] . "</td>";
                    echo "<td>" . $row['P_NAME'] . "</td>";
                    echo "<td>" . $row['P_TYPE'] . "</td>";
                    echo "<td>" . $row['P_EXPIRATION_DATE'] . "</td>";
                    echo "<td>" . $row['P_DESCRIPTION'] . "</td>";
                    echo "<td>" . $row['P_PRICE'] . "</td>";
                    echo "<td>" . $row['P_STOCK'] . "</td>";
                    echo "<td>" . $row['P_IMAGE'] . "</td>";
                    echo "</tr>";
                }
            } else {
                   echo "<tr><td> 0 results </td></tr>";

            }
            echo "</tbody></table>  ";
            ?>
			</div>
			<div id="adminStock_buttons">
				<form id="admin_stock_control" action='admin-stock-changes.php' method="post">
				<label for="prodid"><b>Product ID:</b></label>				
				<input type="number" placeholder="Enter Product ID" name="prodid" required>
				<input type="submit" name="admin_stock_delete"value="Delete Stock">
				<input type="submit" name="admin_stock_replenish" value="Replenish Stock">
				</form>
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