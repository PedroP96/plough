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
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="plough.css">
</head>
<body>
	<div class="mainContainer">
		<div class="header">
			<div class="firstRow">
				<img id="logo" src="images/Plough.png" alt="Plough Logo">
				<a id='loginLink' href='login.php'>Login/Register</a>
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
			<div id="loginRegisterBoxes">
				<div id="firstBox">
					<h2>Existing Costumer</h2>
					<br>
					<form action="login_phpCode.php" method="post">
	    				<label for="email"><b>Email:</b></label>
	   				    <input type="email" placeholder="Enter Email:" name="login_email" required>
						
	    				<label for="psw"><b>Password:</b></label>
	    				<input type="password" placeholder="Enter Password" name="login_pass" required>
						
						<span><a href="forgotten-password.php">Forgot password?</a></span>

	    				<button type="submit">Login</button>
    				</form>
			  	</div>
				<div id="secondBox">
		
					<h2>New Customer</h2>
					<br>
    				<p>Register with us to enjoy:</p>
					<br>
					<ul>
					<li>Faster checkout</li>
					<li>Order tracking</li>
					<li>10% Off on your first order</li>
				</ul>
				<button id="pass_btn" onclick="window.location.href = 'register.php';">Register</button>
				</div>
				<div id="clear">
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
</body>
</html>
