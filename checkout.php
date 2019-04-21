<?php 
	include('dbConnect.php');
	session_start();
	$userID = '';
	if(isset($_SESSION['USERID'])) {
		$userID = $_SESSION['USERID'];
	}
	$fName = '';
	if(isset($_SESSION['FIRST_NAME'])) {
		$fName = $_SESSION['FIRST_NAME'];
	}

	if(!isset($_SESSION['USERID'])) {
		echo "<script>alert('You need to be logged in!');window.history.go(-1);</script>";		
		exit();
	} else {
?>
<html>
<head>
	<meta charset="utf-8">
	<title>Checkout</title>
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
            		<a class="menuLinks" href="contact-us.php">Contact</a>
					<input id="searchInput" type="text" placeholder="Search..">
					<a id="basket" href="basket.php">
                		<img src="images/basket.png" alt="basket" style="width:40px;height:30px;">
            		</a> 
			</div>
		</div>
		<div class="mainContent">
			<h1 class="pageTitle">Checkout</h1>
			<div id="checkoutContainer">
				<div id="checkout_fieldsBox">
					<div id="checkout_fields">
						<form method="post" id="checkout_form" action="checkout_code.php">
							<label for="firstName"><b>First Name:</b></label>
							<br>
							<input class="register_field" type="text" placeholder="Enter First Name" name="firstName" required>
							<br>
							<label for="lastName"><b>Last Name:</b></label>
							<br>
							<input type="text" placeholder="Enter Last Name" name="lastName" required>
							<br>
							<label for="email"><b>Email:</b></label>
							<br>
							<input type="email" placeholder="Enter Email" name="email" required>
							<br>
							<label for="address"><b>Address:</b></label>
							<br>
							<input type="text" placeholder="Enter Address" name="address" required>
							<br>
							<label for="postCode"><b>Post Code:</b></label>
							<br>
							<input type="text" placeholder="Enter Post Code" name="postCode" required>
							<br>
							<label for="phoneNo"><b>Phone Number:</b></label>
							<br>
							<input type="number" placeholder="Enter Phone Number" name="phoneNo" required>
							<br>
							<label for="psw"><b>Card Number:</b></label>
							<br>
							<input type="number" placeholder="Enter Card Number" name="cardNo" required>
							<br>	
							<label for="psw"><b>Name On Card:</b></label>
							<br>
							<input type="text" placeholder="Enter Name On Card" name="cardName" required>
							<br>	
							<label for="psw"><b>Expiry Date On Card:</b></label>
							<br>
							<input type="month" name="cardExpDate" required>
							<br>
							<label for="psw"><b>CVV:</b></label>
							<br>
							<input type="number" placeholder="Enter CVV" name="cardCCV" required>
							<br>
							<br>
							<div id="checkout_buttons">
								<input type="submit" value="Pay Now">
								<input type="submit" value="Reset" onclick="reset()">
							</div>
						</form>
					</div>
				</div>
				<div id="checkout_basket">
					<table id="checkout_basketTable" cellpadding="10">
						<tr>
							<th>Name</th>
							<th class="checkout_tableFields">Quantity</th>
							<th class="checkout_tableFields">Price</th>
						</tr>
						<?php
							$query = "SELECT BASKET.*, PRODUCTS.P_NAME FROM BASKET JOIN PRODUCTS ON (PRODUCTS.PRODUCTID=BASKET.PRODUCTID) WHERE BASKET.USERID = '$userID';";
							$result = mysqli_query($conn, $query);

							if(mysqli_num_rows($result) >= 0) {
								while($row = mysqli_fetch_array($result)) {
									echo "<tr style='width:300px;'>";
									echo "<td>".$row['P_NAME']."</td>";
									echo "<td class='checkout_tableFields'>".$row['B_ITEM_QTY']."</td>";
									echo "<td class='checkout_tableFields'>".'£'.$row['B_ITEM_PRICE']."</td>";
									echo "</tr>";
								}
							}
						?>
					</table>
					<div id="checkout_values" style="text-align: center;">
						<?php
							$totalPrice = "SELECT SUM(B_ITEM_PRICE * B_ITEM_QTY) as TotalPrice FROM BASKET WHERE USERID = '$userID' limit 1";
							$result = mysqli_query($conn, $totalPrice);

							if(mysqli_num_rows($result) >= 0) {
								$row = mysqli_fetch_array($result);
								if($row['TotalPrice'] < 35) {
									echo "<p><b>Delivery: £3.99</b></p>";
								} else {
									echo "<p><b>Delivery: Free</b></p>";
								}
							}

							$checkOrder = "SELECT * FROM ORDERS WHERE USERID = '$userID';";
							$result_checkOrder = mysqli_query($conn, $checkOrder);

							if(mysqli_num_rows($result_checkOrder) <= 0) {
								echo "<p>Discount: 10%</p>";
							}

							$finalPrice = $_SESSION['finalPrice'];
							echo "<p id='checkout_finalPrice'>Final Price: ".$finalPrice."</p>"
							?>
					</div>
				</div>
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