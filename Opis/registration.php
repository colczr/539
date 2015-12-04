<?php
// define variables and set to empty values
$nameErr = $email_addrErr = $email_addr_repeatErr = $passwordErr = $password_repeatErr = "";
$name = $email_addr = $email_addr_repeat = $password = $password_repeat = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST ["name"])) {
    $nameErr = "Username is required";
  } else {
    $name = test_input($_POST["name"]);
    // this will check that name is valid (letters and whitespace only)
  if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email_addr"])){
    $email_addrErr = "Email is required";
  } else {
    $email_addr = test_input($_POST["email_addr"]);
  if (!filter_var($email_addr, FILTER_VALIDATE_EMAIL)) {
      $email_addrErr = "Invalid email format";
    }
  }

  if (empty($_POST["email_addr_repeat"])){
    $email_addr_repeatErr = "Please confirm email";
  } else {
    $email_addr_repeat = test_input($_POST["email_addr_repeat"]);
  if (!filter_var($email_addr_repeat, FILTER_VALIDATE_EMAIL)) {
      $email_addr_repeatErr = "Invalid email format";
    }
  }

  if (empty($_POST["password"])){
    $passwordErr = "Please enter a password";
  } else {
    $password = test_input($_POST["password"]);
  }

  if (empty($_POST["password_repeat"])){
    $password_repeatErr = "Please confirm your password";
  } else {
    $password_repeat = test_input($_POST["password_repeat"]);
  if (!filter_var($password_repeat, FILTER_VALIDATE_PASSWORD)) {
      $passwordErr = "Passwords must match";
    }
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
