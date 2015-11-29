<?php // Do not put any HTML above this line

// session_start() and header() fail if any (even one
// character) of output has been sent.
require_once("pdo.php");
session_start();
unset($_SESSION['name']);


$salt = 'XyZzy12*_';



// Check to see if we have some POST data, if we do process it
if ( isset($_POST['email']) && isset($_POST['pass']) ) {
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
        $_SESSION['error']="User name and password are required";
        header("Location: login.php");
        exit();
    } else {
      $check = hash('md5', $salt.$_POST['pass']);
      $stmt = $pdo->prepare('SELECT email, password, user_id FROM users
        WHERE email = :em AND password = :pw');
      $stmt->execute(array( ':em' => $_POST['email'], ':pw' => $check));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if ( $row !== false ) {
        $_SESSION['pass'] = $row['password'];
        $_SESSION['id'] = $row['user_id'];
        $_SESSION['email'] = $row['email'];
        //Redirect the browser to autos.php
        header("Location: explore.php");
        exit();
      } else{
        $_SESSION['error']="Incorrect Password";

      }

    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>


  <meta charset="utf-8">
  <title>Opis</title>


	<link rel="stylesheet" href="css/index.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $("#login").fadeIn(500);

    });

  </script>


</head>

<body>
  <div class="background">

  </div>

  <div id = "login">
    <h2>Log in</h2>
    <form method="POST">
      <label>Email<br></label>
      <input type="text" name="email" id="nam"><br/>
      <label>Password<br></label>
      <input type="text" name="pass" id="id_1723"><br/>
      <?php
      // Note triple not equals and think how badly double
      // not equals would work here...
      if ( isset($_SESSION['error'])) {
          // Look closely at the use of single and double quotes
          echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
          unset($_SESSION['error']);

      }
      ?>
      <input type="submit" value="Log In">
      <a href="index.php">Cancel<a>



      </form>


    </div>

<footer>
  <p>Copyright &nbsp; &copy; &nbsp; Colin Chen &nbsp; &amp; &nbsp; Jessamine Bartley-Matthews
</footer>

</body>

</html>
