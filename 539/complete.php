<?php
session_start();
require_once("pdo.php");

$a_json = array();


$stmt = $pdo->query("SELECT * FROM users");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    $email = htmlentities($row['email']);
		array_push($a_json, $email);
}

echo json_encode($a_json);
flush();



?>
