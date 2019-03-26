<?php
session_start();

if (isset($_GET['logout'])){
  unset($_SESSION['user']);
  unset($_SESSION['caid']);
  echo "<script>alert('Logout success!');</script>";
  echo "<script>window.location.assign('index.php');</script>";
}

$sameuser=0;

if (isset($_GET['id'])) {
  $wid=$_GET['id'];
  //echo $acid;
  if (isset($_SESSION['user'])) {
    $fn=$_SESSION['user'];
    $uid=$_SESSION['caid'];

    if($_SESSION['caid']==$wid){
      $sameuser=1;
      if($wid=='admin'){
        $sameuser=0;
      }
    }
  }
}

if($sameuser==0){ 
  echo "<script>window.location.assign('index.php');</script>";
}


include('config.php');
include('checkpresident.php');

$sql1 = "SELECT userID,fullname,society,president,website,blog,phone FROM ams WHERE userID='$wid'";
$res1 = $conn->query($sql1);
if ($res1->num_rows > 0) {
  while ($row = $res1->fetch_assoc()) {
    $fullname=$row['fullname'];
    $society=$row['society'];
    $president=$row['president'];
    $website=$row['website'];
    $blog=$row['blog'];
    $phone=$row['phone'];
  }
}
else{
  echo "<script>window.location.assign('index.php');</script>";
}

$filename = "userimg/".$wid.".jpg";
    if (file_exists($filename)) {
        $img = $filename;
    } else {
        $img = "img/user.jpg";
    }

if ($president==2||$president==4) {
  $socie = "visible";
}
else{
  $socie = "hidden";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Levent - <?php echo $fn; ?></title>
	<link rel="icon" href="img/icon.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="leon.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>

<nav>
    <div class="nav-wrapper #ffc107 amber">
      <a href="cr8activity.php" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible2<?php } else  { ?>lloginvi<?php } ?>"><i class="fa fa-plus"></i></a>
      <a href="index.php" class="brand-logo "><img src="img/icon.png" style="height: 10vh;"></a>
      <a href="index.php" class="brand-logo center">LEVENT</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="aboutus.php">About us</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li><a href="login.php" id="<?php if (isset($_SESSION['user'])) { ?>lloginvi<?php } else  { ?>llogvisible<?php } ?>"><b>Sign in</b></a></li>
        <li><a href="userprofile.php?id=<?php echo $_SESSION['caid']; ?>" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>"><?php echo $navname; ?></a></li>
        <li><a href="?logout" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>"><b>Sign out</b></a></li>
      </ul>
    </div>
  </nav>

<p style="font-size: 200%;font-weight: 450;text-align: center;">Edit Information</p>
<div style="border-style: solid; border-style: solid; background-color:white;">
  <form method="post" action="edituserserver.php" enctype="multipart/form-data">
    <div >
    <h4><img id="preview_img" src="<?php echo $img; ?>" style="max-height: 170px;object-fit: cover;margin-left: 37%;"></h4>
    <h5 style="text-align: center;">Contact Information</h5>
      <label style="color: black;">Username</label>
      <a style="text-decoration: none;color: black;"><?php echo $wid; ?></a>
       </div>
    <div >
      <label style="color: black;">Current Password</label>
      <input type="password" name="password1" style="border-color: black;width: 600px;" >
      <label style="color: black;">New Password</label>
      <input type="password" name="password2" style="border-color: black;width: 600px;" >
    </div>
    <div >
      <label style="color: black;">Full name</label>
      <input type="text" name="fullname" style="border-color: black;" value="<?php echo $fullname ?>" required>
    </div>
    <div >
      <label style="color: black;">Website</label>
      <input type="text" name="website" style="border-color: black;width: 600px;" value="<?php echo $website ?>">
      <label style="color: black;">Blog</label>
      <input type="text" name="blog" style="border-color: black;width: 600px;" value="<?php echo $blog ?>">
    </div>
    <div >
      <label style="color: black;">Phone Number</label>
      <input type="text" name="phone" style="border-color: black;width: 600px;" value="<?php echo $phone ?>">
      <label style="color: black;visibility: <?php echo $socie; ?>;">Society/Club</label>
      <input type="text" name="society" style="border-color: black;width: 600px; visibility: <?php echo $socie; ?>;" value="<?php echo $society ?>">
    </div>
    <div>
      <label style="color: black;">Image upload</label>
      <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
    <div style="margin-left: 640px;">
      <button type="submit" class="btn" name="edit" style="background-color:#ffb300;">Edit</button>
      <a href="userprofile.php?id=<?php echo $wid; ?>"><input type="button" value="Cancel" class="btn" style="margin-top: 0.5%;background-color:#ffb300 "></a>
    </div>
  </form>
</div>


</body>


<footer class="page-footer #ffc107 amber">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="black-text">LEVENT</h5>
                <p class="black-text text-lighten-4">
                <a href="https://www.google.com/maps/dir/''/roispoon/@1.4826521,103.5897804,12z/data=!3m1!4b1!4m8!4m7!1m0!1m5!1m1!1s0x31da73360736fbf5:0x78455ff10e5b520c!2m2!1d103.659821!2d1.4826532" style="color: #424242;">
                Southern University College
                PTD 64888, Jalan Selatan Utama KM15, Off, Jalan Bertingkat Skudai, 81300 Skudai, Johor
                </a></p>
                <h5 class="black-text">Contact</h5>
                <p class="black-text text-lighten-4">To make a reservation, please call our system manager<br>018-9553792 Carl</p>
                <h5 class="black-text">Email</h5>
                <p class="black-text text-lighten-4">levent@gmail.com</p>              
            </div>
        <div class="col l4 offset-l2 s12">
                <h5 class="black-text">You can also follow us in this way</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Wechat</a></li>
                </ul>
        </div>
        </div>
    </div>
        <div class="footer-copyright">
            <div class="container">
            © 2018 Copyright LEVENT.All rights reserved.Website  design by <span style="color: black;">LEVENT TEAM</span>
            </div>
        </div>
</footer>

<script type="text/javascript">
$(document).ready(function(){
    //Image file input change event
    $("#fileToUpload").change(function(){
        readImageData(this);//Call image read and render function
    });
});
 
function readImageData(imgData){
  if (imgData.files && imgData.files[0]) {
        var readerObj = new FileReader();
        
        readerObj.onload = function (element) {
            $('#preview_img').attr('src', element.target.result);
        }
        
        readerObj.readAsDataURL(imgData.files[0]);
    }
}
</script>

</html>