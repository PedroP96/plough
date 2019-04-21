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
	<title>Admin Sales Reports</title>
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
			<div id="adminReport_Sales_container">
				<table id ="adminReport_Sales_table">
					<thead>
						<tr>
							<th>ORDER ID</th>
							<th>USER ID</th>
							<th>ORDER DATE</th>
							<th>TOTAL PRICE</th>
						</tr>
					</thead>
					<tbody>
						<?php 
   
   					        $sql = "SELECT ORDERS.ORDERID, ORDERS.USERID, ORDERS.O_DATE, SUM(QUANTITY*PRICE)
									FROM ORDERS
									INNER JOIN ORDERDETAILS ON ORDERDETAILS.ORDERID = ORDERS.ORDERID
									GROUP BY ORDERS.ORDERID";
  				       		$result = $conn->query($sql);
                        
          					  if($result->num_rows > 0){
      					          while($row = mysqli_fetch_array($result)){
       					         		echo "<tr><td>" . $row['ORDERID'] . "</td>";
     								    echo "<td>" . $row['USERID'] . "</td>";
               							echo "<td>" . $row['O_DATE'] . "</td>";
                    					echo "<td>" . $row['SUM(QUANTITY*PRICE)'] . "</td>";
       					                echo "</tr>";
         						       }
        				 	   } else {
                  					 echo "<tr><td> 0 results </td></tr>";
								}
       				     ?>

					</tbody>
				</table>
			</div>
			<div id="adminReport_overallSales_container">
				<br>
				<h2>Overall Sales Report</h2>
				<br>
				<table id="adminReport_overallSales_table">
					<tr>
						<th>Total Orders</th>
						<th>Total Sales</th>
					</tr>
					<tr>
					<?php
					   $sql2 = "SELECT COUNT(*), SUM(TOTAL_PRICE) FROM ORDERS";
  				       		$result2 = $conn->query($sql2);  
 								if($result2->num_rows > 0){
 								while($row = mysqli_fetch_array($result2)){  				 	  
								echo "<td>" . $row['COUNT(*)'] . "</td>";
								echo "<td>" . $row['SUM(TOTAL_PRICE)'] . "</td>";
								}
							}
					?>
					</tr>
				</table>
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