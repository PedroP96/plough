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
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Basket</title>
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
			<h1 class="pageTitle">Basket</h1>
			<div id="basketContainer">
				<div id="basketTable_container">
					<table id="basketTable" style="margin: 0 auto; border-collapse:collapse;" border="1 px black" cellpadding="10">
						<tr>
							<th>Image</th>
							<th>Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Remove</th>
						</tr>
						<?php
							$query = "SELECT BASKET.* , PRODUCTS.P_IMAGE , PRODUCTS.P_NAME FROM BASKET JOIN PRODUCTS ON (PRODUCTS.PRODUCTID=BASKET.PRODUCTID) WHERE BASKET.USERID = '$userID';";
							$result = mysqli_query($conn, $query);

							if(mysqli_num_rows($result) >= 0) {
								while($row = mysqli_fetch_array($result)) {
									echo "<tr>";
									echo "<form method='post' action='remove_products.php'>";
									echo "<td><img src='images/".$row['P_IMAGE']."' style='width:100px; height:100px;'>";
									echo "<td>".$row['P_NAME']."</td>";
									echo "<td>".$row['B_ITEM_QTY']."</td>";
									echo "<td>".'£'.$row['B_ITEM_PRICE']."</td>";
									echo "<input type='hidden' name='hidden_userID' value='".$row['USERID']."' />";
									echo "<input type='hidden' name='hidden_productID' value='".$row['PRODUCTID']."' />";
									echo "<td><input type='submit' value='Remove'/></td>";
									echo "</form>";
									echo "</tr>";
								}
							}
						?>
					</table>
					<table style="margin: 0 auto; border-collapse:collapse; margin-top: 10px; text-align: center;" border="1 px black" cellpadding="10">
						<?php
								$totalPrice = "SELECT SUM(B_ITEM_PRICE * B_ITEM_QTY) as TotalPrice FROM BASKET WHERE USERID = '$userID' limit 1";
								$result = mysqli_query($conn, $totalPrice);

								if(mysqli_num_rows($result) >= 0) {
									$row = mysqli_fetch_array($result);
								}
							?>
						<tr>
							<td>Delivery</td>
							<td><?php 
								$delivery = "";
								if($row['TotalPrice'] < 35) {
									$delivery = "£3.99";
									echo $delivery;
								} else {
									$delivery = "Free";
									echo $delivery;
								}
								?>
							</td>
						</tr>
						<?php
							$_SESSION['discounted'] = $discounted = "No";
							$checkOrder = "SELECT * FROM ORDERS WHERE USERID = '$userID';";
							$result_checkOrder = mysqli_query($conn, $checkOrder);

							if(mysqli_num_rows($result_checkOrder) <= 0) {
								echo "<tr>";
								echo "<td>Discount</td>";
								echo "<td>10%</td>";
								echo "</tr>";
								$discounted = True;
								$_SESSION['discounted'] = 'Yes';
							}
						?>
						<tr>
							<td>
								Total Price
							</td>
							<td>
							<?php
								if($discounted == True && $delivery == '£3.99') {
									$_SESSION['finalPrice'] = (($row['TotalPrice'] - ($row['TotalPrice'] * 0.1)) + 3.99);
									echo '£'.$_SESSION['finalPrice'];
								} elseif($discounted == True && $delivery != '£3.99') {
									$_SESSION['finalPrice'] = ($row['TotalPrice'] - ($row['TotalPrice'] * 0.1));
									echo '£'.$_SESSION['finalPrice'];
								} elseif($discounted != True && $delivery == '£3.99') {
									$_SESSION['finalPrice'] = ($row['TotalPrice'] + 3.99);
									echo '£'.$_SESSION['finalPrice'];
								} else {
									$_SESSION['finalPrice'] = $row['TotalPrice'];
									echo '£'.$_SESSION['finalPrice'];
								}
							?>
							</td>
						</tr>
					</table>
					<div id="basketButtons_container">
						<form method="post" action="basket_code.php">
							<input type="hidden" name="hidden_userID" value="<?php echo $_SESSION['USERID'] ?>">
							<input class="basketButtons" type="submit" name="reset_cart" value="Reset Cart">
							<input type="submit" name="checkout" value="Checkout">
						</form>
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
	<?php if(isset($_SESSION['USERID'])) {
	echo "<script>";
		echo "function dropdownButton_js2() {";
		echo  "document.getElementById('myDropdown2').classList.toggle('show');";
		echo "}";

		// Close the dropdown menu if the user clicks outside of it
		echo "window.onclick = function(event) {";
		echo "if (!event.target.matches('.dropbtn')) {";
		echo	"var dropdowns = document.getElementsByClassName('dropdown-content');";
		echo	"var i;";
		echo	"for (i = 0; i < dropdowns.length; i++) {";
		echo	  "var openDropdown = dropdowns[i];";
		echo	  "if (openDropdown.classList.contains('show')) {";
		echo		"openDropdown.classList.remove('show');";
		echo	  "}";
		echo	"}";
		echo  "}";
		echo "}";
	echo "</script>";
	}?>
</body>
</html>
<?php }?>