<?php 
	session_start();
	if(isset($_SESSION['USERID'])) {
		echo "<script>alert('You are already logged in!');window.location.href='fruits-and-veg.php';</script>";
		exit();
	}
?> 
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Forgotten Password</title>
	<link rel="stylesheet" type="text/css" href="plough.css">
</head>
<body>
	<div class="mainContainer">
		<div class="header">
			<div class="firstRow">
				<img id="logo" src="images/Plough.png" alt="Plough Logo">
				<a id="loginLink" href="login.php">Login/Register</a> 
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
			<div id="forgottenPass_container">
				<form action="passwordReset_code.php" method="post">
					<h2>Forgotten your password?</h2>
					<br>
					<p>Enter your email address bellow and we will reset it.</p>
					<br>
    				<label for="email"><b>Email:</b></label>
   					<input type="email" placeholder="Enter Email:" name="email" required>
					<button type="submit">Submit</button>
				</form>
				<button onclick="window.location.href = 'login.php';">Cancel</button>
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
</body>
</html>
