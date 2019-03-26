<?php 
session_start();

include('config.php');

date_default_timezone_set("Asia/Kuala_Lumpur");

$caid="";

$sql_a = "SELECT caid FROM event ORDER BY caid DESC LIMIT 1";
$res_a = $conn->query($sql_a);

if ($res_a->num_rows > 0) {
while($row = $res_a->fetch_assoc()){
	$caid = str_pad($row['caid']+1, 3, "0", STR_PAD_LEFT);
}
}
else{
	$caid = "001";
}

$causer = $_SESSION['caid'];
$caname = mysqli_real_escape_string($conn, $_POST['a-name']);
$cadate = mysqli_real_escape_string($conn, $_POST['a-date']);
$cavenue = mysqli_real_escape_string($conn, $_POST['a-venue']);
$cadescription = mysqli_real_escape_string($conn, $_POST['a-description']);
$cacommittee = mysqli_real_escape_string($conn, $_POST['a-committee']);
$catime = date("Y.m.d "."h:i:sa");
$status = "false";
$rs = "0";
$st = "true";

if(isset($_POST['a-category'])){
    $cacategory = $_POST['a-category'];
}
else{
    echo "<script>alert('Please select one type of category.');</script>";
    echo "<script>window.location.assign('cr8activity.php');</script>";
    $st = "false";
}

if(isset($_POST['create'])){

$target_dir = "caimg/";
$target_file = $target_dir . $caid.".jpg";
$imagefile = basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($imagefile,PATHINFO_EXTENSION));

if ($_FILES["fileToUpload"]["size"]==0) {
	$uploadOk = 2;
}
else if($_FILES["fileToUpload"]["size"] > 0){
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed. Please try again with JPG, JPEG & PNG files.');</script>";
        echo "<script>window.location.assign('cr8activity.php');</script>";
        $uploadOk = 0;
    }
    else if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "<script>alert('Image files is too large! Please try again with maximum 50MB files.');</script>";
        echo "<script>window.location.assign('cr8activity.php');</script>";
        $uploadOk = 0;
    }
    else{
    	$uploadOk = 1;
    }
}

if ($uploadOk == 1 && $st == "true") {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $uploadOk = 2;
    } 
}
else if($uploadOk == 0){
	
}

}

if ($uploadOk == 2 && $st == "true") {
	$sql = "INSERT into event(caid,causer,caname,cadate,cavenue,cacategory,cadescription,cacommittee,catime,status) VALUES ('$caid','$causer','$caname','$cadate','$cavenue','$cacategory','$cadescription','$cacommittee','$catime','$status')";
    $sql_b = "INSERT into request(rid,ruser,rname,rdate,rvenue,rcategory,rtime,rstatus) VALUES ('$caid','$causer','$caname','$cadate','$cavenue','$cacategory','$catime','$rs')";
    $result = $conn->query($sql);
    $res_b = $conn->query($sql_b);

    echo "<script>alert('$caname had successfull created! Please wait for admin to prove this activity.');</script>";
    echo "<script>window.location.assign('index.php');</script>";
}

?>