<?php 
	include('dbConnect.php');
	session_start();
	$fName = '';
	if(isset($_SESSION['USERID'])) {
		$fName = $_SESSION['FIRST_NAME'];
	}
	$productID = '';
	if(isset($_GET['product_id'])) {
		$productID = $_GET['product_id'];
	}
	$query = "SELECT * FROM PRODUCTS WHERE PRODUCTID = '$productID'";
	$result = mysqli_query($conn, $query);

	if(mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $row['P_NAME']?></title>
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
			<div class="product_container">

				<h1 class="productName"><?php echo $row["P_NAME"] ?></h1>
				<div class="productImage">
					<img src="images/<?php echo $row["P_IMAGE"] ?>" alt="">
				</div>
				<div class="productInfo">
						<h3>Type:</h3>
						<p><?php echo $row["P_TYPE"] ?></p><br>
						<h3>Description:</h3>
						<p><?php echo $row["P_DESCRIPTION"] ?></p><br>
						<h3>Expiration Date:</h3>
						<p><?php echo $row["P_EXPIRATION_DATE"] ?></p><br>
						<h3>Price:</h3>
						<p>£<?php echo $row["P_PRICE"] ?></p>
				</div>
				<div class="clear"></div>
			</div>
			<?php if(isset($_SESSION['USERID'])) {
					
			echo    "<form method='post' action='addToBasket.php'>";
			echo    "<input id='product_qty' type='number' name='quantity' value='1'/>";
			echo	"<input type='hidden' name='hidden_id' value='$productID'/>";

			echo	"<input type='hidden' name='hidden_price' value='".$row['P_PRICE']."'/>";

			echo	"<input type='hidden' name='hidden_userid' value='".$_SESSION['USERID']."'/>";
					
			echo	"<input id='add_button'  class='addtoBasket_button' type ='submit' name='add-to-cart' value='Add to Cart'/>";
			echo    "</form>";

			echo	"<input class='addtoBasket_button' type ='submit' onclick='history.back();'' value='Back'/>";
			} else {?> 

			<input class="addtoBasket_button" type ="submit" onclick="history.back();" value="Back" style="margin-left: 50%; width: 10%;"/>
	<?php
		}
		}
	}
	?>
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
