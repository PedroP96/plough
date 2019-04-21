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
	<title>Admin Orders Report</title>
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
							<th>ORDER STATUS</th>
							<th>TOTAL PRICE</th>
						</tr>
					</thead>
					<tbody>
						<?php 

   					        $sql = "SELECT ORDERS.ORDERID, ORDERS.USERID, ORDERS.O_DATE, ORDERS.O_STATUS, SUM(QUANTITY*PRICE)
									FROM ORDERS
									INNER JOIN ORDERDETAILS ON ORDERDETAILS.ORDERID = ORDERS.ORDERID
									GROUP BY ORDERS.ORDERID";

  				       		$result = $conn->query($sql);
                        
          					  if($result->num_rows > 0){
      					          while($row = mysqli_fetch_array($result)){
       					         		echo "<tr><td>" . $row['ORDERID'] . "</td>";
     								    echo "<td>" . $row['USERID'] . "</td>";
               							echo "<td>" . $row['O_DATE'] . "</td>";
               							echo "<td>" . $row['O_STATUS'] . "</td>";
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
			<div id="adminHome_buttons">
				<form id="admin_editUsers" action="" method="post">
				<label for="id"><b>ORDER ID:</b></label>
				<input id="adminid_control" type="text" name="id" placeholder="ORDER_ID" required>			
				<button name="admin_view_order" type="submit" >View Order</button>	
				</form>
			</div>
			<div id="adminReport_overallSales_container">
				<br>
				<h2>Overall Sales Report</h2>
				<br>
				<table id="adminReport_overallSales_table">
					<tr>
						<th>ORDER ID</th>
						<th>PRODUCT ID</th>
						<th>PRODUCT NAME</th>
						<th>QUANTITY</th>
						<th>PRICE</th>
					</tr>
						<?php
							if(isset($_POST['admin_view_order'])){ 
   							 $id = $_POST['id']; 

								$sql2 = "SELECT ORDERDETAILS.ORDERID, ORDERDETAILS.PRODUCTID, PRODUCTS.P_NAME, ORDERDETAILS.QUANTITY, (QUANTITY*PRICE)
											 FROM ORDERDETAILS
											 INNER JOIN PRODUCTS ON PRODUCTS.PRODUCTID = ORDERDETAILS.PRODUCTID
											 WHERE ORDERID = '$id'";

									$result2 = $conn->query($sql2);

								if($result2->num_rows > 0){
  					 			 while($row = mysqli_fetch_array($result2)){
	
									echo "<tr><td>$id</td>";
									echo "<td>" . $row['PRODUCTID'] . "</td>";
									echo "<td>" . $row['P_NAME'] . "</td>";
									echo "<td>" . $row['QUANTITY'] . "</td>";
									echo "<td>" . $row['(QUANTITY*PRICE)'] . "</td>";
									echo "</tr>";
									}
								} else {
									 echo "<tr><td> 0 results </td></tr>";
								}
							}

    					?>
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