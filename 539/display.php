<?php
session_start();
require_once("pdo.php");

$stmt = $pdo->query("SELECT user_id, fileName, access FROM images WHERE img_id = ".$_GET['img_id'] );
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row['access'] == 1){
  $dirName = "img/uploads/";

} else {
  if(!isset($_SESSION['id']) or $_SESSION['id'] != $row['user_id']){
    die('You do not have access to view this image');
  } else {

  $dirName = "temp/";

  }
}


 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Opis</title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" type="text/css" href="js/collage/css/transitions.css"/>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
  <script src="js/collage/jquery.collagePlus.js"></script>
  <script src="js/collage/extras/jquery.removeWhitespace.js"></script>
  <script src="js/collage/extras/jquery.collageCaption.js"></script>
</head>

<body>
  <?php
    if(isset($_GET['temp_id'])){
    echo '<img src="'.$dirName.'image'.$_GET['temp_id'].'user'.$_SESSION['id'].'.php"/>';
  } else {
    echo '<img src="'.$dirName.$row['fileName'].'"/>';
  }
    echo ('<a href="delete.php?img_id='.$_GET['img_id'].'">Delete</a>');
  ?>

</body>
</html>
