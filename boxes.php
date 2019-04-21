<?php 
	include('dbConnect.php');
	session_start();
	$fName = '';
	if(isset($_SESSION['USERID'])) {
		$fName = $_SESSION['FIRST_NAME'];
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Boxes</title>
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
            		<a class="menuLinks" id="active" href="boxes.php">Boxes</a>
            		<a class="menuLinks" href="contact-us.php">Contact</a>
					<input id="searchInput" type="text" placeholder="Search..">
					<a id="basket" href="basket.php">
                		<img src="images/basket.png" alt="basket" style="width:40px;height:30px;">
            		</a> 
			</div>
		</div>
		<div class="mainContent">
			<h1 class="pageTitle">Boxes</h1>
			<div class="columns">
				<div class="filtersColumn">
					<h2 id="filterTitle">Filters:</h2>
						<br>
						<a class="filters" href="boxes.php?filter=fruits">Fruit</a>
						<br>
						<a class="filters" href="boxes.php?filter=vegetables">Vegetables</a>
						<br>
						<a class="filters" href="boxes.php?filter=all">Fruits &amp; Vegetables</a>
				</div>
				<div class="productsColumn">
					<table class="productsTable" cellpadding="10">
					<?php
					if(!empty($_GET['sortBy'])) {
						if($_GET['sortBy'] == "nameAscending") {
							$query = "SELECT * FROM PRODUCTS WHERE P_TYPE='Box' ORDER BY P_NAME DESC;";
						} elseif($_GET['sortBy'] == "nameDescending") {
							$query = "SELECT * FROM PRODUCTS WHERE P_TYPE='Box' ORDER BY P_NAME ASC;";
						} elseif($_GET['sortBy'] == "priceAscending") {
							$query = "SELECT * FROM PRODUCTS WHERE P_TYPE='Box' ORDER BY P_PRICE ASC;";
						} elseif($_GET['sortBy'] == "priceDescending") {
							$query = "SELECT * FROM PRODUCTS WHERE P_TYPE='Box' ORDER BY P_PRICE DESC;";
						}
					}elseif(!empty($_GET['filter'])) {
						if($_GET['filter'] == "fruits") {
							$query = "SELECT * FROM PRODUCTS WHERE P_TYPE='Box' AND P_NAME LIKE '%Fruit%' OR P_NAME LIKE '%Mix%';";
						} elseif($_GET['filter'] == "vegetables") {
							$query = "SELECT * FROM PRODUCTS WHERE P_TYPE='Box' AND P_NAME LIKE '%Veg%' OR P_NAME LIKE '%Mix%';";
						} else {
							$query = "SELECT * FROM PRODUCTS WHERE P_TYPE='Box';";
						}
					} else {
						$query = "SELECT * FROM PRODUCTS WHERE P_TYPE='Box';";
					}
					$result = mysqli_query($conn, $query);
					if(mysqli_num_rows($result) > 0)
					{
						$i = 0;
						while($row = mysqli_fetch_array($result))
						{
							if($i%4 == 0) { ?>
								<tr>
							<?php } ?>

							<td>
							<form method="post" action="addToBasket.php">
							<a href="product-description.php?product_id=<?php echo $row['PRODUCTID']?>"><img src="images/<?php echo $row["P_IMAGE"] ?>" style="width: 182px;height: 154px;"/></a><br/>
							<h4><?php echo $row["P_NAME"] ?></h4>
							<h4>Size: <?php echo $row['P_DESCRIPTION'] ?></h4>
							<h4>£ <?php echo $row["P_PRICE"] ?></h4>
							<input type="number" name="quantity" value='1'/>
							<input type="hidden" name="hidden_id" value="<?php echo $row["PRODUCTID"]?>"/>
							<input type="hidden" name="hidden_name" value="<?php echo $row["P_NAME"]?>"/>
							<input type="hidden" name="hidden_price" value=" <?php echo $row["P_PRICE"] ?>"/>
							<input type="hidden" name="hidden_userid" value=" <?php echo $_SESSION['USERID'] ?>"/>
							<input type="submit" name="add_to_cart" value="Add to Cart">
							</form>
							<?php
							if($i%2 == 2) {
								?>
								</tr>
								<?php
							}
							$i++;
						}
					}
					?>	
				</table>
				</div>
				<div class="sortColumn">
					<div class="dropdown">
  					<button onclick="dropdownButton_js()" class="dropbtn">Sort By:</button>
  						<div id="myDropdown" class="dropdown-content">
							<a href="boxes.php?sortBy=nameDescending">Name: A to Z</a>
                			<a href="boxes.php?sortBy=nameAscending">Name: Z to A</a>
                			<a href="boxes.php?sortBy=priceAscending">Price: Lowest to Highest</a>
                			<a href="boxes.php?sortBy=priceDescending">Price: Hight to Lowest</a>
					  </div>
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
		function dropdownButton_js() {
		  document.getElementById("myDropdown").classList.toggle("show");
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
	<?php if(isset($_SESSION['USERID'])) {
		echo "<script>";
			echo "function dropdownButton_js2() {";
			echo  "document.getElementById('myDropdown2').classList.toggle('show');";
			echo "}";
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
