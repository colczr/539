<?php
require_once "pdo.php";
session_start();


$stmt = $pdo->query("SELECT * FROM images WHERE img_id = ".$_GET['img_id']);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
unlink($file);

$sql = "DELETE FROM images WHERE img_id = :img_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':img_id' => $_GET['img_id']));
$file = "../../private539/".$row['fileName'];

$_SESSION['success'] = 'Record deleted';
header( 'Location: profile.php' ) ;
return;
?>
