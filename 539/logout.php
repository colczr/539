<?php
session_start();
if (isset($_SESSION['imageIndex'])){
  $i = $_SESSION['imageIndex'] - 1 ;
  while ($i >= 0){
    $file = "temp/image".$i."user".$_SESSION['id'].".php";
    unlink($file);
    $i--;
  }
}

unset($_SESSION['imageIndex']);
header("Location: login.php");
unset($_SESSION['id']);
unset($_SESSION);
 ?>
