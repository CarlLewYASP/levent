<?php
session_start();

if (isset($_GET['logout'])){
  unset($_SESSION['user']);
  unset($_SESSION['caid']);
  echo "<script>alert('Logout success!');</script>";
  echo "<script>window.location.assign('index.php');</script>";
}

include('config.php');
if (isset($_GET['id'])) {
  $acid=$_GET['id'];
  //echo $acid;
}
else{
  echo "<script>window.location.assign('index.php');</script>";
}

$sql = "SELECT caid,causer,caname,cadate,cavenue,cacategory,cadescription,cacommittee,catime,status FROM event WHERE caid=$acid";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){
  $caid=$row['caid'];
  $causer=$row['causer'];
  $caname=$row['caname'];
  $cadate=$row['cadate'];
  $cavenue=$row['cavenue'];
  $cacategory=$row['cacategory'];
  $cadescription=$row['cadescription'];
  $cacommittee=$row['cacommittee'];
  $catime=$row['catime'];
}
}

$aafn="";
$sql_a = "SELECT fullname FROM ams WHERE userID='$causer'";
$res_a = $conn->query($sql_a);
if ($res_a->num_rows > 0) {
while($row = $res_a->fetch_assoc()){
  $aafn=$row['fullname'];
}
}

$filename = "caimg/".$caid.".jpg";
    if (file_exists($filename)) {
        $caimg = $filename;
    } else {
        $caimg = "img/sport.jpg";
    }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Levent - <?php echo $caname; ?></title>
  <link rel="icon" href="img/icon.png">
  <link rel="stylesheet" type="text/css" href="aa.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="leon.css">
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
        <li><a href="userprofile.php?id=<?php echo $_SESSION['caid']; ?>" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>"><?php echo $_SESSION['user'] ?></a></li>
        <li><a href="?logout" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>"><b>Sign out</b></a></li>
      </ul>
    </div>
</nav>

<div style="margin-bottom: 2%;">
  <div class="header1">
    <a href="index.php"><input type="button" value="Home" class="btn" style="margin-top: 0.5%;margin-left: -85%;background-color:#ffb300 "></a>
    <h2><?php echo $caname; ?></h2>
  </div>
  <form class="form1">
    <div style="display: inline-flex;width:100%;">
    <div>
    <h4>Organizer by : <a href="userprofile.php?id=<?php echo $causer;?>"><?php echo $aafn; ?></a></h4>
    <h4><?php echo "Date : ".$cadate; ?></h4>
    <h4><?php echo "Venue : ".$cavenue; ?></h4>
    <h4><?php echo "Category : ".$cacategory; ?></h4>
    <h4><?php echo "Committee : ".$cacommittee; ?></h4>
    </div>
  <div>
    <h4><img src="<?php echo $caimg; ?>" style="height: 70vh;margin-left: 80%;width: 55vh;"></h4>
    </div>
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
                49, Jalan Indah 15/2, Taman Bukit Indah, 81200 Johor Bahru, Johor
                </a></p>
                <h5 class="black-text">Contact</h5>
                <p class="black-text text-lighten-4">To make a reservation, please call our system manager<br>+6010-2267102 Agnes</p>
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
            © 2017 Copyright LEVENT.All rights reserved.Website  design by <span style="color: black;">LEVENT TEAM</span>
            </div>
        </div>
</footer>
</html>