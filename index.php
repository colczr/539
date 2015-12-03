<?php // Do not put any HTML above this line

// session_start() and header() fail if any (even one
// character) of output has been sent.
session_start();


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
    var show =  function(){
      $("#navContainer").fadeIn(500);
  }

    var hide = function(){
      $("#navContainer").fadeOut(500);
      document.getElementsByTagName("H1")[0].style.display = "block";
      document.getElementsByTagName("H2")[0].style.display = "block";
    }

    var picOn = function(link){
      document.getElementsByClassName('wrapper')[0].style.backgroundImage = "url(" + link + ")";
   }

    var picOff = function(){
      document.getElementsByClassName('wrapper')[0].style.backgroundImage = "url()";
    }


  </script>


</head>

<body>
  <div class="background">

  </div>

<div class="wrapper">
    <div onmouseover = "show()">
      <h1>Opis</h1>
      <h2>Get your shit out there.</h2>
      <div id="navContainer" onmouseleave= "hide()">
        <nav>
          <a href="about.html" onmouseover = "picOn('img/woman.jpg')" onmouseleave = "picOff()">About</a>
          <a href="login.php" onmouseover = "picOn('img/liberty.jpg')" onmouseleave = "picOff()" >Login</a>
          <a href="#" onmouseover = "picOn('img/starryNight.jpg')" onmouseleave = "picOff()" >Join</a>
        </nav>
      </div>
    </div>


</div>


<footer>
  <p>Copyright &nbsp; &copy; &nbsp; Colin Chen &nbsp; &amp; &nbsp; Jessamine Bartley-Matthews
</footer>

</body>

</html>
