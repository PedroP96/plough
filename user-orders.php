<?php 
	include('dbConnect.php');
	session_start();
	$fName = '';

	if(!isset($_SESSION['USERID'])) {
		echo "<script>alert('You need to be logged in!');window.history.go(-1);</script>";		
	exit();
	} else {
		$id = $_SESSION['USERID'];
		$fName = $_SESSION['FIRST_NAME'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
	<title>My Orders</title>
	<link rel="stylesheet" type="text/css" href="plough.css">
    </head>
    <body>
        <div class="mainContainer">
		<div class="header">
			<div class="firstRow">
				<img id="logo" src="images/Plough.png" alt="Plough Logo">
				<?php if(isset($_SESSION['USERID'])) {
					echo "<div id='accountButton'>";
						echo "<div class='dropdown'>";
	  					echo "<button onclick='dropdownButton_js2()' class='dropbtn'>Hello, ".$fName."</button>";
	  						echo "<div id='myDropdown2' class='dropdown-content'>";
								echo "<a href='user-details.php'>My Profile</a>";
	                			echo "<a href='user-orders.php'>My Orders</a>";
	                			echo "<a href='logoutSession.php'>Logout</a>";
	                		echo "</div>";
						echo "</div>";
						echo "</div>";
						echo "<div class='clear'></div>";
				} else {
					echo "<a id='loginLink' href='login.php'>Login/Register</a>";
				}?> 			
			</div>
			<div class="secondRow">
					<a class="menuLinks" href="index.php">Home</a>
            		<a class="menuLinks" href="fruits-and-veg.php">Fruit &amp; Veg</a>
            		<a class="menuLinks" href="boxes.php">Boxes</a>
            		<a class="menuLinks" href="deals.php">Deals</a>
            		<a class="menuLinks" href="contact-us.php">Contact</a>
					<input id="searchInput" type="text" placeholder="Search..">
					<a id="basket" href="Checkout.php">
                		<img src="images/basket.png" alt="basket" style="width:40px;height:30px;">
            		</a> 
			</div>
		</div>
		<div id="usersOrders_container">
            <div id="linksSidebar">
                	<h1 id="userAccount"><?php echo"$fName" ?>'s Account</h1><br>
                	<a href="user-details.php" class="linkD">Account details</a>
                	<br>
                	<a href="user-orders.php" class="linkO">View orders</a>
            	</div>
            	<div class="clear"></div>
            <div id="usersOrders_table">
            <table id="usersTable">
                <thead>
                    <tr class="colour">
                    	<th>Order ID</th>
                    	<th>User ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Discounted</th>
                        <th>Price</th>
                        <th>Cancel</th>
                    </tr>
                </thead>
                <tr>
                	<?php
           
   					        $sql = "SELECT *
									FROM ORDERS
									WHERE USERID = '$id'";

  				       		$result = $conn->query($sql);
                        
          					  if($result->num_rows > 0){
      					          while($row = mysqli_fetch_array($result)){
                    					echo "<form method='post' action='cancel_order.php'";
       					         		echo "<tr><td>" . $row['ORDERID'] . "</td>";
       					         		echo "<td>" . $row['USERID'] . "</td>";
               							echo "<td>" . $row['O_DATE'] . "</td>";
               							echo "<td>" . $row['O_STATUS'] . "</td>";
               							echo "<td>" . $row['DISCOUNTED'] . "</td>";
                    					echo "<td>" . $row['TOTAL_PRICE'] . "</td>";
                    					echo "<td><input type='submit' value='Cancel' class='cancelbtn'></td>";
                    					echo "<input type='hidden' name='orderid' value='" . $row['ORDERID'] . "'";
       					                echo "</tr>";
       					                echo "</form>";
         						       }
        				 	   } else {
                  					 echo "<tr><td> 0 results </td></tr>";
								}
       				     ?>
            </table>
            </div>
            <div id="user-order-buttons">
				<form id="admin_editUsers" action="" method="post">
				<label for="id"><b>ORDER ID:</b></label>
				<input id="adminorderid_control" type="text" name="orderid" placeholder="ORDER_ID" required>			
				<button name="admin_view_order" type="submit" >View Order</button>	
				</form>
			</div>
            <div id="adminReport_overallSales_container">
				<br>
				<h2 id="adminReport_overallSales_h2">Order Details</h2>
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
   							 $orderid = $_POST['orderid']; 

								$sql2 = "SELECT ORDERDETAILS.ORDERID, ORDERDETAILS.PRODUCTID, PRODUCTS.P_NAME, ORDERDETAILS.QUANTITY, (QUANTITY*PRICE), ORDERS.USERID
											 FROM ORDERDETAILS
											 INNER JOIN PRODUCTS ON PRODUCTS.PRODUCTID = ORDERDETAILS.PRODUCTID
											 INNER JOIN ORDERS ON ORDERS.ORDERID = ORDERDETAILS.ORDERID
											 WHERE ORDERDETAILS.ORDERID = '$orderid' AND ORDERS.USERID = '$id'";

									$result2 = $conn->query($sql2);

								if($result2->num_rows > 0){
  					 			 while($row = mysqli_fetch_array($result2)){
	
									echo "<tr><td>" . $row['ORDERID'] . "</td>";
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
		<div class="clear"></div>
		</div>
				<footer class="footer">
		<div class="footerContent">
			<a class="footerlink" href="terms-and-conditions.php">T&amp;C</a> 
			<span class="footerlink">| </span>
			<a class="footerlink" href="privacy-policy.php">Privacy Policy</a>
		</div>
	</footer>
				<script>
		function dropdownButton_js2() {
		  document.getElementById("myDropdown2").classList.toggle("show");
		}

		// Close the dropdown menu if the user clicks outside of it
		window.onclick = function(event) {
		  if (!event.target.matches('.dropbtn')) {
			var dropdowns = document.getElementsByClassName("dropdown-content");
			var i;
			for (i = 0; i < dropdowns.length; i++) {
			  var openDropdown = dropdowns[i];
			  if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
			  }
			}
		  }
		}
	</script>
    </body>
</html>
<?php } ?>