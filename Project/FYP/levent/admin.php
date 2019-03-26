<?php
session_start();

if (isset($_GET['logout'])){
  unset($_SESSION['user']);
  unset($_SESSION['caid']);
}

if (isset($_SESSION['user'])) {
    if($_SESSION['caid']!='admin'){
      echo "<script>alert('You do not have permission to browse this page!');</script>";
      echo "<script>window.location.assign('index.php');</script>";
    }
}
else{
  echo "<script>alert('You do not have permission to browse this page!');</script>";
  echo "<script>window.location.assign('index.php');</script>";
}

include('config.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Levent - Administrator</title>
	<link rel="icon" href="img/icon.png">
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
        <li><a href="userprofile.php" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>"><?php echo $_SESSION['user'] ?></a></li>
        <li><a href="?logout" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>"><b>Sign out</b></a></li>
      </ul>
    </div>
  </nav>

<p style="font-size: 200%;font-weight: 450;text-align: center;">Request</p>
<hr>

<table>
  <tr>
    <th>Activity ID</th>
    <th>Username</th>
    <th>Activity Name</th>
    <th>Activity Date</th>
    <th>Activity Venue</th>
    <th>Activity Category</th>
    <th>Activity Create Time</th>
    <th colspan='2'>Approve/Reject</th>
  </tr>

<?php
if(isset($_GET['approved'])){
  $rid=$_GET['approved'];
  $aestatus = 'true';
  $arstatus = '1';
  $sql1="update event set status='$aestatus' where caid='$rid'";
  $sql2="update request set rstatus='$arstatus' where rid='$rid'";
  $result1 = $conn->query($sql1);
  $result2 = $conn->query($sql2);
}

if(isset($_GET['rejected'])){
  $rid=$_GET['rejected'];
  $rid2='A'.$rid;
  $did='caimg/'.$rid.'.jpg';
  $rrstatus = '2';
  $sql1="delete from event where caid='$rid'";
  $sql2="update request set rid='$rid2',rstatus='$rrstatus' where rid='$rid'";
  $result1 = $conn->query($sql1);
  $result2 = $conn->query($sql2);
  unlink($did);
}


$rstatus='0';
$sql = "SELECT rid,ruser,rname,rdate,rvenue,rcategory,rtime,rstatus FROM request WHERE rstatus='$rstatus'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["rid"]. "</td><td>". $row["ruser"]."</td><td>". $row["rname"]."</td><td>". $row["rdate"]."</td><td>". $row["rvenue"]."</td><td>".$row["rcategory"]."</td><td>". $row["rtime"]."</td><td><a href='admin.php?approved=".$row["rid"]."'>Approved</a>"."</td><td><a href='admin.php?rejected=".$row["rid"]."'>Rejected</a>"."</td></tr>";
    }
}
else{
  echo "<tr><td colspan='9' style='text-align: center;'>No request.</td></tr>";
}

?>

</table>


<p style="font-size: 200%;font-weight: 450;text-align: center;">Feedback</p>
<hr>

<table>
  <tr>
    <th>Username</th>
    <th>Submitted time</th>
    <th>Comment</th>
    <th>&nbsp</th>
  </tr>

<?php
if(isset($_GET['solved'])){
  $fbid=$_GET['solved'];
  $sql="DELETE FROM fb where fbid='$fbid'";
  $result = $conn->query($sql);
}


$rstatus='0';
$sql = "SELECT fbid,fbuser,fbcomment,fbtime FROM fb";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row['fbuser']."</td><td>".$row['fbtime']."</td><td>".$row['fbcomment']."</td><td><a href='admin.php?solved=".$row["fbid"]."'>Solved</a>"."</td></tr>";
    }
}
else{
  echo "<tr><td colspan='9' style='text-align: center;'>No request.</td></tr>";
}

?>

</table>

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