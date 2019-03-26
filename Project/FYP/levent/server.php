<?php 
session_start();

$userID="";
$password="";
$fullname="";
$errors = array(); 

if (isset($_POST['userID'])){
	$userID=mysqli_real_escape_string($conn, $_POST['userID']);
	$fullname=mysqli_real_escape_string($conn, $_POST['fullname']);
	$password_1=mysqli_real_escape_string($conn, $_POST['password_1']);
	$password_2=mysqli_real_escape_string($conn, $_POST['password_2']);

$sql_u = "SELECT * FROM ams WHERE userID='$userID'";
$res_u = mysqli_query($conn, $sql_u);

if (empty($userID)) { 
		array_push($errors, "Username is required"); }
if (empty($fullname)) { 
		array_push($errors, "Full name is required"); }
if (empty($password_1)) { 
		array_push($errors, "Password is required"); }
if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
}
else if(mysqli_num_rows($res_u) > 0){
			echo "<script>alert('Username already exist!');</script>";
}
else if($password_1 == $password_2){
	if (count($errors) > 0){
		array_push($errors, "Register failed! Please try again with correct information.");
}
     else{
     	$password =md5($password_1);
		$sql="INSERT into ams(userID,password,fullname) VALUES ('$userID','$password','$fullname')";
		$result = $conn->query($sql);
		echo "<script>alert('$fullname register had successfull.');</script>";
	    echo "<script>window.location.assign('login.php');</script>";
     }
}
}
?>