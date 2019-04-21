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
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Account</title>
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
					<a id="basket" href="basket">
                		<img src="images/basket.png" alt="basket" style="width:40px;height:30px;">
            		</a> 
			</div>
		</div>
		<div class="mainContent">
			    <div id="linksSidebar">
                	<h1 id="userAccount"><?php echo"$fName" ?>'s Account</h1><br>
                	<a href="user-details.php" class="linkD">Account details</a>
                	<br>
                	<a href="user-orders.php" class="linkO">View orders</a>
            	</div>
            	<div class="clear"></div>
			<div id="RegisterBox" class="userBoxes">
   				<br>
				<br>
					<?php	
					echo "<form method='post' id='register_form' action=''>";
					
   					        $sql = "SELECT FIRST_NAME, LAST_NAME, DOB, ADDRESS,CITY,POSTCODE,PHONENO,EMAIL,PASSWORD FROM USERS WHERE USERID ='$id'";
  				       		$result = $conn->query($sql);
          					 
							 if($result->num_rows > 0){
      					          while($row = mysqli_fetch_array($result)){

					echo "<label for='firstName'><b>First Name:</b></label>";
					echo "<input class='register_field' type='text' value=" . $row['FIRST_NAME'] . " name='firstName' required>";
					
					echo "<label for='lastName'><b>Last Name:</b></label>";
					echo "<input class='register-login_field' type='text' value=" . $row['LAST_NAME'] . " name='lastName' required>";

					echo "<label for='dob'><b>Date of Birth:</b></label>";
					echo "<input class='register-login_field' type='date' value=" . $row['DOB'] . " name='dob' required>";
	
					echo "<label for='address'><b>Address:</b></label>";
					echo "<input class='register-login_field' type='text' value=" . $row['ADDRESS'] . " name='address' required>";

					echo "<label for='city'><b>City:</b></label>";
					echo "<input class='register-login_field' type='text' value=" . $row['CITY'] . " name='city' required>";

					echo "<label for='postCode'><b>Post Code:</b></label>";
					echo "<input class='register-login_field' type='text' value=" . $row['POSTCODE'] . " name='postCode' required>";

					echo "<label for='phoneNo'><b>Phone Number:</b></label>";
					echo "<input class='register-login_field' type='number' value=" . $row['PHONENO'] . " name='phoneNo' required>";

					echo "<label for='email'><b>Email:</b></label>";
					echo "<input class='register-login_field' type='email' value=" . $row['EMAIL'] . " name='email' required>";

					echo "<label for='psw'><b>Password:</b></label>";
					echo "<input class='register-login_field' type='password' value=" . $row['PASSWORD'] . " name='psw' required>";
        			}
						} else {
          		    		  echo "0 results";
      						    }

							if(isset($_POST['user_update_dets'])){

   				 				 $f_name = $_POST['firstName']; 
   								 $l_name = $_POST['lastName']; 
   								 $dob = $_POST['dob']; 
   								 $add = $_POST['address']; 
   								 $cit = $_POST['city']; 
   								 $pcode = $_POST['postCode']; 
   								 $pno = $_POST['phoneNo']; 
   								 $email = $_POST['email']; 
   								 $pword = $_POST['psw']; 
				
								$sql3 = "UPDATE USERS SET FIRST_NAME='$f_name',LAST_NAME='$l_name', DOB='$dob', ADDRESS='$add',
									CITY='$cit',POSTCODE='$pcode',PHONENO='$pno',EMAIL='$email',PASSWORD='$pword' WHERE USERID = '$id'";
								$conn->query($sql3);

							}
			  ?>

             	      <br>
                     <br>
					<button type="submit" id="userDet_button" name='user_update_dets'>Update</button>
				</form>
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