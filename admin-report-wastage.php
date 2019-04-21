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
	<title>Admin Wastage Report</title>
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
			<div id="adminReport_Wastage_container">
				<table id ="adminReport_Wastage_table">
					<thead>
						<tr>
							<th>PRODUCT ID</th>
							<th>NAME</th>
							<th>TYPE</th>
							<th>EXPIRATION DATE</th>
							<th>PRICE</th>
							<th>QUANTITY</th>
							<th>TOTAL WASTE COST</th>
						</tr>
					</thead>
					<tbody>
						<?php 
            
   					        $sql = "SELECT WASTAGEID, PRODUCTID, W_NAME, W_EXP_DATE, W_PRICE,W_QUANTITY, (W_PRICE*W_QUANTITY) FROM WASTAGE";
  				       		$result = $conn->query($sql);
                        
          					  if($result->num_rows > 0){
      					          while($row = mysqli_fetch_array($result)){
       					         		echo "<tr><td>" . $row['WASTAGEID'] . "</td>";
       					         		echo "<td>" . $row['PRODUCTID'] . "</td>";
     								    echo "<td>" . $row['W_NAME'] . "</td>";
                    					echo "<td>" . $row['W_EXP_DATE'] . "</td>";
     								    echo "<td>" . $row['W_PRICE'] . "</td>";
               							echo "<td>" . $row['W_QUANTITY'] . "</td>";
                    					echo "<td>" . $row['(W_PRICE*W_QUANTITY)'] . "</td>";
       					                echo "</tr>";
         						       }
        				 	   } else {
                 					  echo "<tr><td> 0 results </td></tr>";
								}
       				     ?>
					</tbody>
				</table>
			</div>
			<div id="adminReport_overallWastage_container">
				<br>
				<h2>Overall Wastage Figures</h2>
				<br>
				<table id="adminReport_overallWastage_table">
					<tr>
						<th>Total Waste Cost</th>
						<th>Total Waste Quantity</th>
						<th>Most Wasted Product</th>
					</tr>
					<tr>
						<?php 
					   $sql2 = "SELECT (SUM(W_PRICE)*SUM(W_QUANTITY)), SUM(W_QUANTITY) FROM WASTAGE";
  				       		$result2 = $conn->query($sql2);
 								if($result2->num_rows > 0){
 								while($row = mysqli_fetch_array($result2)){  				 	  
								echo "<td>£" . $row['(SUM(W_PRICE)*SUM(W_QUANTITY))'] . "</td>";
								echo "<td>" . $row['SUM(W_QUANTITY)'] . "</td>";
								}
								} else {
                 					  echo "<td> 0 results </td>";
                 					  echo "<td> 0 results </td>";
								}
							
						$sql4 = "SELECT W_NAME FROM WASTAGE GROUP BY W_NAME ORDER BY SUM(W_QUANTITY) DESC LIMIT 1 ";
  				       			$result4 = $conn->query($sql4);

 								if($result4->num_rows > 0){
 								while($row = mysqli_fetch_array($result4)){  				 	  
								echo "<td>" . $row['W_NAME'] . "</td>";
								}
							} else {
                 			echo "<td> 0 results </td>";
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