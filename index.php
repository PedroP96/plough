<?php 
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
	<title>Home</title>
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
		<div class="mainContent" id="homepageMain">
			<div id="aboutUs_container">
				<h2 id="homepage_heading1">About Us</h2>
				<div id="aboutUs_firstRow">
					<img src="images/Farmer.jpg" alt="farmer"/>
					<p>Our company was founded when Thomas Green began to do research about how people in his local area can achieve a healthier lifestyle. 
					He started to grow own crops and realised that organic farming can have an immense impact on the human body. We are not only aiming for people who want to feel more energized and healthier, also those who want to make sure that they know where the products are coming from.</p>
				</div>
				<div id="aboutUs_secondRow">
					<img src="images/farming.jpg" alt="apples">
					<p>We believe in organic farming and that it will change your lifestyle. 
						That’s why we go without pesticides and other chemicals that is widely used to remove pests such as weed and bugs. 
						These include toxic compounds which do not only harm the environment also animals and even human being suffer from it.</p>
				</div>
			</div>
			<div class="clear">
			</div>
			<div id="howItWorks_container">
				<h2 class="homepage_heading">How it works</h2>
				<div id="howItWorks_images_container">
					<div class="howItWorks_column">
						<img src="images/bag.png" alt="bag"/>
						<h3>Choose your products.</h3>
					</div>
					<div class="howItWorks_column">
						<img src="images/card.png" alt="card"/>
						<h3>Pay easily via card.</h3>
					</div>
					<div class="howItWorks_column">
						<img id="deliveryImage" src="images/delivery.png" alt="delivery"/>
						<h3 id="deliveryHeading">Get your products delivered <br> straight to your door and enjoy.</h3>
					</div>
				</div>
			</div>
			<div class="clear">
			</div>
			<div id="offers_Container">
				<h2 class="homepage_heading">Our Offers</h2>
				<div id="offers_images_container">
					<div class="offers_column">
						<a href="fruits-and-veg.php">
							<img src="images/fruit.jpg" alt="fruits"/>
						<div class="offers_column_text">
							<p>Fruits</p>
						</div>
						</a>
					</div>
					<div class="offers_column">
						<a href="fruits-and-veg.php">
							<img src="images/veg.jpg" alt="vegetables"/>
						<div class="offers_column_text">
							<p>Vegetables</p>
						</div>
						</a>
					</div>
					<div class="offers_column">
						<a href="boxes.php">
							<img src="images/boxes.jpg" alt="boxes"/>
						<div class="offers_column_text">
							<p>Boxes</p>
						</div>
						</a>
					</div>
				</div>
				<div class="clear">
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
