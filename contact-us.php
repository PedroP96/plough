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
	<title>Contact Us</title>
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
			<div id="contactUs_container">
				<form action="" method="post">
					<div id="contactUs_firstColumn">
						<label for="fName"><b>First Name:</b></label>
						<input type="text" placeholder="Enter First Name:" name="fName" required>
					
						<label for="lastName"><b>Last Name:</b></label>
						<input type="text" placeholder="Enter Last Name" name="lName" required>

						<label for="email"><b>Email:</b></label>
						<input type="email" placeholder="Enter Email:" name="email" required>
			  		</div>
					<div id="contactUs_secondColumn">
						<label for="subject"><b>Message:</b></label>
						<textarea id="TextArea" name="message" placeholder="Place your message here...."></textarea>
						<button type="submit">Submit</button>
					</div>
				</form>
			</div>
			<div class="clear"></div>
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
