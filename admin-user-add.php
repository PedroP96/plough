<?php
session_start();
include('dbConnect.php');

$userid = $_SESSION['USERID'];
		

		if(isset($_POST['admin_save_new_user'])){
			 $f_name = $_POST['admin_userAdd_fName']; 
			 $l_name = $_POST['admin_userAdd_lName']; 
			 $dob = $_POST['admin_userAdd_dob']; 
			 $add = $_POST['admin_userAdd_address']; 
				 $cit = $_POST['admin_userAdd_city']; 
				 $pcode = $_POST['admin_userAdd_postCode']; 
			 $pno = $_POST['admin_userAdd_phoneNo']; 
			 $email = $_POST['admin_userAdd_email']; 
			 $pword = $_POST['admin_userAdd_password']; 
			 $u_type = $_POST['admin_userAdd_userType']; 


		$sql4 = "INSERT INTO USERS VALUES(DEFAULT,'$f_name','$l_name','$dob','$add','$cit'
					,'$pcode','$pno','$email','$pword','$u_type')";
		$conn->query($sql4);

		if(mysqli_num_rows($conn)>=0){
			echo "<script>alert('New User Added');location.href='admin-home.php';</script>";
		}else{
			echo "<script>alert('Error Adding New User');location.href='admin-home.php';</script>";
		}
	}

?>