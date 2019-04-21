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
	<title>Admin Trending Products Reports</title>
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
			<div id="adminReport_Trending_container">
				<table id ="adminReport_Trending_table">
					<thead>
						<tr>
							<th>PRODUCT ID</th>
							<th>NAME</th>							
							<th>TYPE</th>
							<th>PRICE</th>
							<th>QUANTITY</th>
						</tr>
					</thead>
					<tbody>
						<?php 

   					        $sql = "SELECT ORDERDETAILS.PRODUCTID,PRODUCTS.P_NAME,PRODUCTS.P_TYPE,PRODUCTS.P_PRICE, SUM(QUANTITY)
									 FROM ORDERDETAILS
									 INNER JOIN PRODUCTS ON PRODUCTS.PRODUCTID = ORDERDETAILS.PRODUCTID
									 GROUP BY PRODUCTID
									 ORDER BY SUM(QUANTITY) DESC
									 LIMIT 3 ";
  				       		$result = $conn->query($sql);
                        
          					  if($result->num_rows > 0){
      					          while($row = mysqli_fetch_array($result)){
       					         		echo "<tr><td>" . $row['PRODUCTID'] . "</td>";
     								    echo "<td>" . $row['P_NAME'] . "</td>";
     								    echo "<td>" . $row['P_TYPE'] . "</td>";
               							echo "<td>" . $row['P_PRICE'] . "</td>";
                    					echo "<td>" . $row['SUM(QUANTITY)'] . "</td>";
       					                echo "</tr>";
         						       }
        				 	   } else {          					      
                 				  echo "<tr><td> 0 results </td></tr>";
								}
       				     ?>
					</tbody>
				</table>
			</div>
			<div id="adminReport_bestSeller_container">
				<br>
				<h2>Best Seller</h2>
				<br>
				<table id="adminReport_bestSeller_table">
					<tr>
						<th>Product ID</th>
						<th>Name</th>
						<th>Total Sold</th>
						<th>Total Profit</th>
					</tr>
					<?php					
						 $sql = "SELECT ORDERDETAILS.PRODUCTID,PRODUCTS.P_NAME,SUM(QUANTITY),(P_PRICE*SUM(QUANTITY)), SUM(QUANTITY)
									 FROM ORDERDETAILS
									 INNER JOIN PRODUCTS ON PRODUCTS.PRODUCTID = ORDERDETAILS.PRODUCTID
									 GROUP BY PRODUCTID
									 ORDER BY SUM(QUANTITY) DESC
									 LIMIT 1 ";
  				       		$result = $conn->query($sql);
                        
          					  if($result->num_rows > 0){
      					          while($row = mysqli_fetch_array($result)){
       					         		echo "<tr><td>" . $row['PRODUCTID'] . "</td>";
     								    echo "<td>" . $row['P_NAME'] . "</td>";
                    					echo "<td>" . $row['SUM(QUANTITY)'] . "</td>";
                    					echo "<td>" . $row['(P_PRICE*SUM(QUANTITY))'] . "</td>";
       					                echo "</tr>";
         						       }
        				 	   } else {          					      
                   					echo "<tr><td> 0 results </td></tr>";
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