<?php 
	include('dbConnect.php');
	session_start();
	if(isset($_SESSION['USER_TYPE'])!='Admin') {
		echo "<script>alert('You are not an Admin!');location.href='login.php';</script>";
		exit();
	}else{

?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin Home</title>
	<link rel="stylesheet" type="text/css" href="plough.css">
</head>
<body>
	<div class="mainContainer">
		<div class="header">
			<div class="firstRow">
				<img id="logo" src="images/Plough.png" alt="Plough Logo">
				<a id="logoutLink" href="logoutSession.php">Logout</a> 
			</div>
			<div class="secondRow">
					<span class="adminText">Administrator Page</span>
            		<a class="adminLinks" href="admin-home.php">Account Management</a>
            		<a class="adminLinks" href="adminStock.php">Stock Management</a>
            		<a class="adminLinks" href="admin-reports.php">System Reports</a> 
			</div>
		</div>
		<div class="mainContent">
			<div id="usersTable_container">
						<?php 
         					echo"<table id='usersTable'>";
			                 echo" <thead>";
			                   echo" <tr>";
			                    echo"<th>USER ID</th>";
			                    echo"<th>FIRST NAME</th>";
			                    echo"<th>LAST NAME</th>";
			                    echo"<th>DOB</th>";
			                    echo"<th>ADDRESS</th>";
			                    echo"<th>CITY</th>";
			                    echo"<th>POST CODE</th>";
			                    echo"<th>PHONE NO</th>";
			                    echo"<th>EMAIL</th>";
			                    echo"<th>PASSWORD</th>";
			                    echo"<th>USER TYPE</th>";
			                    echo"</tr>";
			     	           echo"</thead>";
             					   echo"<tr><tbody>";
   					        $sql = "SELECT USERID, FIRST_NAME, LAST_NAME, DOB, ADDRESS,
   						  	     CITY,POSTCODE,PHONENO,EMAIL, PASSWORD, USER_TYPE FROM USERS";
  				       		$result = $conn->query($sql);
                        
          					  if($result->num_rows > 0){
      					          while($row = mysqli_fetch_array($result)){
       					         		echo "<tr><td>" . $row['USERID'] . "</td>";
     								    echo "<td>" . $row['FIRST_NAME'] . "</td>";
               							echo "<td>" . $row['LAST_NAME'] . "</td>";
                    					echo "<td>" . $row['DOB'] . "</td>";
              					        echo "<td>" . $row['ADDRESS'] . "</td>";
          					            echo "<td>" . $row['CITY'] . "</td>";
    				 	  	            echo "<td>" . $row['POSTCODE'] . "</td>";
             					        echo "<td>" . $row['PHONENO'] . "</td>";
        					            echo "<td id='email-body'>" . $row['EMAIL'] . "</td>";
            					        echo "<td>" . $row['PASSWORD'] . "</td>";
         					            echo "<td>" . $row['USER_TYPE'] . "</td>";
       					                echo "</tr>";
         						       }
        				 	   } else {
          					      echo "0 results";
          					  }
       				     ?>
       			     </tbody>
            	</table> 
			</div>
			<div id='admin-user-buttons'>
				<form id="admin_editUsers" action="" method="post">
				<label for="id"><b>User ID:</b></label>
				<input id="admin_userid_control" type="text" name="id" placeholder="USER_ID" required>
				<button name="admin_edit_user" type="submit">Edit</button>	
				<button name="admin_delete_user"  type="submit">Delete</button>
				</form>	
			</div>
			<div id="adminHome_userEdit_container">
				<form id="admin_editUsers" action="" method="post">
						<?php

							if(isset($_POST['admin_edit_user'])){ 
							$id = $_POST['id'];

   					        $sql2 = "SELECT FIRST_NAME, LAST_NAME, DOB, ADDRESS,CITY,POSTCODE,PHONENO,EMAIL,PASSWORD,USER_TYPE FROM USERS WHERE USERID ='$id'";
  				       		$result2 = $conn->query($sql2);

          					  if($result2->num_rows > 0){
          					    echo"<table id='adminHome_userEdit_table'>";
			                    echo" <thead>";
			                    echo" <tr>";
			                    echo"<th>USER ID</th>";
			                    echo"<th>FIRST NAME</th>";
			                    echo"<th>LAST NAME</th>";
			                    echo"<th>DOB</th>";
			                    echo"<th>ADDRESS</th>";
			                    echo"<th>CITY</th>";
			                    echo"<th>POST CODE</th>";
			                    echo"<th>PHONE NO</th>";
			                    echo"<th>EMAIL</th>";
			                    echo"<th>PASSWORD</th>";
			                    echo"<th>USER TYPE</th>";
			                    echo"</tr>";
			     	            echo"</thead>";
             					   echo"<tr><tbody>";
      					          while($row = mysqli_fetch_array($result2)){
									echo "<form action='' method='post'>";	
									echo "<td><input type='text' name='id' value='$id'></td>";
									echo "<td><input type='text' name='f_name' value='" . $row['FIRST_NAME'] . "'></td>";
									echo "<td><input type='text' name='l_name' value='" . $row['LAST_NAME'] . "'></td>";
									echo "<td><input type='text' name='dob' value='" . $row['DOB'] . "'></td>";
									echo "<td><input type='text' name='add' value='" . $row['ADDRESS'] . "'></td>";
									echo "<td><input type='text' name='cit' value='" . $row['CITY'] . "'></td>";
									echo "<td><input type='text' name='pcode' value='" . $row['POSTCODE'] . "'></td>";
									echo "<td><input type='text' name='pno' value='" . $row['PHONENO'] . "'></td>";
									echo "<td><input type='text' name='email' value='" . $row['EMAIL'] . "'></td>";
									echo "<td><input type='text' name='pword' value='" . $row['PASSWORD'] . "'></td>";
									echo "<td><input type='text' name='u_type' value='" . $row['USER_TYPE'] . "'></td>";
									echo "</tr>";
									echo "</table>";
									echo "<button type='submit' id='adminHome_save' name='admin_save_user'>Save</button>";
									echo "</form>";
									}								
							}
							}

							if(isset($_POST['admin_save_user'])){

								 $id = $_POST['id'];
   				 				 $f_name = $_POST['f_name']; 
   								 $l_name = $_POST['l_name']; 
   								 $dob = $_POST['dob']; 
   								 $add = $_POST['add']; 
   								 $cit = $_POST['cit']; 
   								 $pcode = $_POST['pcode']; 
   								 $pno = $_POST['pno']; 
   								 $email = $_POST['email']; 
   								 $pword = $_POST['pword']; 
   								 $u_type = $_POST['u_type']; 
				

								$sql3 = "UPDATE USERS SET FIRST_NAME='$f_name',LAST_NAME='$l_name', DOB='$dob', ADDRESS='$add',
									CITY='$cit',POSTCODE='$pcode',PHONENO='$pno',EMAIL='$email',PASSWORD='$pword', USER_TYPE='$u_type' WHERE USERID = '$id'";
								$conn->query($sql3);

								if(mysqli_num_rows($conn)>=0){
									echo "<script>alert('User Details Saved');location.href='admin-home.php';</script>";
								}else{
									echo "<script>alert('Error Updating User');location.href='admin-home.php';</script>";
								}

							}
    					?>
				</form>
			</div>
			<div id="adminHome_userAdd_container">
					<table id="adminHome_userAdd_table">
						<tr>
							<th>FIRST NAME</th>
							<th>LAST NAME</th>
							<th>DOB</th>
							<th>ADDRESS</th>
							<th>CITY</th>
							<th>POST CODE</th>
							<th>PHONE NO</th>
							<th>EMAIL</th>
							<th>PASSWORD</th>
							<th>USER TYPE</th>
						</tr>
						<form action='admin-user-add.php' method='post'>
							<td><input name="admin_userAdd_fName" type="text" placeholder="First Name"></td>
							<td><input name="admin_userAdd_lName" type="text" placeholder="Last Name"></td>
							<td><input name="admin_userAdd_dob" type="date" class="input"></td>
							<td><input name="admin_userAdd_address" type="text" placeholder="Address"></td>
							<td><input name="admin_userAdd_city" type="text" placeholder="City"></td>
							<td><input name="admin_userAdd_postCode" type="text" placeholder="Post Code"></td>
							<td><input name="admin_userAdd_phoneNo" type="number" placeholder="Phone No"></td>
							<td><input name="admin_userAdd_email" type="email" placeholder="Email"></td>
							<td><input name="admin_userAdd_password" type="password" placeholder="Password"></td>
							<td><input name="admin_userAdd_userType" type="text" placeholder="User"></td>
						<tr>
						</tr>
						</table>
					<button type='submit' id="adminHome_adduser" name='admin_save_new_user'>Add</button>
						</form>
					</div>
			</div>
		</div>
	</div>
		<?php						
				if(isset($_POST['admin_delete_user'])){
					 $id = $_POST['id'];

				$sql5 = "DELETE FROM USERS WHERE USERID= '$id'";
				$conn->query($sql5);


				if(mysqli_num_rows($conn)>=0){
					echo "<script>alert('User Deleted');location.href='admin-home.php';</script>";
				}else{
					echo "<script>alert('Error Deleting User');location.href='admin-home.php';</script>";
				}
			}
						?>
	<footer class="footer">
		<div class="footerContent">
			<a class="footerlink" href="terms-and-conditions.php">T&amp;C</a> 
			<span class="footerlink">| </span>
			<a class="footerlink" href="privacy-policy.php">Privacy Policy</a>
		</div>
	</footer>
</body>
</html>
<?php
}
?>