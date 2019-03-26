<?php
session_start();

if (isset($_GET['logout'])){
  unset($_SESSION['user']);
  unset($_SESSION['caid']);
}

include('config.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Levent</title>
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

<div>
<div class="row">

<?php
$astatus='true';
$sql = "SELECT caid,causer,caname,cadate,cavenue,cacategory,cadescription,cacommittee,catime,status FROM event WHERE status='$astatus' LIMIT 8";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()){
    $filename = "caimg/".$row["caid"].".jpg";
    if (file_exists($filename)) {
        $banana = $filename;
    } else {
        $banana = "img/sport.jpg";
    }
    echo '<div class="col s12 m3"><div class="card medium"><div class="card-image"><img src="'.$banana.'" style="max-height: 170px;width: 100%;object-fit: cover;"><span class="card-title">'.$row["caname"].'</span></div><div class="card-content"><p><b>Category:</b> '.$row["cacategory"].'</p><p><b>Venue:</b> '.$row["cavenue"].'</p><p><b>Date:</b> '.$row["cadate"].'</p><p><b>Desciption:</b></p><p>'.substr($row["cadescription"],0,30).'</p><p>'.substr($row["cadescription"],31,28).'...</p></div><div class="card-action"><a href="activity.php">View more</a></div></div></div>';
  }
}
else if(!$result->num_rows > 0){
  echo '<div class="col s12 m3"><div class="card medium"><div class="card-image"><img src="img/sport.jpg" style="max-height: 170px;width: 100%;object-fit: cover;"><span class="card-title">Levent</span></div><div class="card-content"><p><b>Category:</b> -</p><p><b>Venue:</b> -</p><p><b>Date:</b> -</p><p><b>Desciption:</b></p><p>...</p></div><div class="card-action"><a href="activity.php">View more</a></div></div></div>';
  echo '<div class="col s12 m3"><div class="card medium"><div class="card-image"><img src="img/sport.jpg" style="max-height: 170px;width: 100%;object-fit: cover;"><span class="card-title">Levent</span></div><div class="card-content"><p><b>Category:</b> -</p><p><b>Venue:</b> -</p><p><b>Date:</b> -</p><p><b>Desciption:</b></p><p>...</p></div><div class="card-action"><a href="activity.php">View more</a></div></div></div>';
  echo '<div class="col s12 m3"><div class="card medium"><div class="card-image"><img src="img/sport.jpg" style="max-height: 170px;width: 100%;object-fit: cover;"><span class="card-title">Levent</span></div><div class="card-content"><p><b>Category:</b> -</p><p><b>Venue:</b> -</p><p><b>Date:</b> -</p><p><b>Desciption:</b></p><p>...</p></div><div class="card-action"><a href="activity.php">View more</a></div></div></div>';
  echo '<div class="col s12 m3"><div class="card medium"><div class="card-image"><img src="img/sport.jpg" style="max-height: 170px;width: 100%;object-fit: cover;"><span class="card-title">Levent</span></div><div class="card-content"><p><b>Category:</b> -</p><p><b>Venue:</b> -</p><p><b>Date:</b> -</p><p><b>Desciption:</b></p><p>...</p></div><div class="card-action"><a href="activity.php">View more</a></div></div></div>';
  echo '<div class="col s12 m3"><div class="card medium"><div class="card-image"><img src="img/sport.jpg" style="max-height: 170px;width: 100%;object-fit: cover;"><span class="card-title">Levent</span></div><div class="card-content"><p><b>Category:</b> -</p><p><b>Venue:</b> -</p><p><b>Date:</b> -</p><p><b>Desciption:</b></p><p>...</p></div><div class="card-action"><a href="activity.php">View more</a></div></div></div>';
  echo '<div class="col s12 m3"><div class="card medium"><div class="card-image"><img src="img/sport.jpg" style="max-height: 170px;width: 100%;object-fit: cover;"><span class="card-title">Levent</span></div><div class="card-content"><p><b>Category:</b> -</p><p><b>Venue:</b> -</p><p><b>Date:</b> -</p><p><b>Desciption:</b></p><p>...</p></div><div class="card-action"><a href="activity.php">View more</a></div></div></div>';
  echo '<div class="col s12 m3"><div class="card medium"><div class="card-image"><img src="img/sport.jpg" style="max-height: 170px;width: 100%;object-fit: cover;"><span class="card-title">Levent</span></div><div class="card-content"><p><b>Category:</b> -</p><p><b>Venue:</b> -</p><p><b>Date:</b> -</p><p><b>Desciption:</b></p><p>...</p></div><div class="card-action"><a href="activity.php">View more</a></div></div></div>';
  echo '<div class="col s12 m3"><div class="card medium"><div class="card-image"><img src="img/sport.jpg" style="max-height: 170px;width: 100%;object-fit: cover;"><span class="card-title">Levent</span></div><div class="card-content"><p><b>Category:</b> -</p><p><b>Venue:</b> -</p><p><b>Date:</b> -</p><p><b>Desciption:</b></p><p>...</p></div><div class="card-action"><a href="activity.php">View more</a></div></div></div>';
}
?>

</div>
</div>



</body>

<div style="background-color: #fff9c4;">
<div class="bg1">
<a href="sport.php">
<div class="img1" href="login.php">
	<img src="img/sport.jpg">
	<h2>Sport</h2>
</div>
</a>

<a href="concert.php">
<div class="img2">
	<img src="img/concert.jpg">
	<h2>Concert</h2>
</div>
</a>

<a href="volunteers.php">
<div class="img3">
	<img src="img/volunteers.jpg">
	<h2>Voluntteers</h2>
</div>
</a>

<a href="food.php">
<div class="img4">
	<img src="img/food.jpg">
	<h2>Food</h2>
</div>
</a>

<a href="classes.php">
<div class="img4">
	<img src="img/class.jpg">
	<h2>Classes</h2>
</div>
</a>
</div>
</div>



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