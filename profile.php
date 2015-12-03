<?php
session_start();
require_once("pdo.php");
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
  <script type="text/javascript">

  // All images need to be loaded for this plugin to work so
  // we end up waiting for the whole window to load in this example
  $(window).load(function () {
      $(document).ready(function(){
          collage();
          $('.Collage').collageCaption();
      });
  });

  // Here we apply the actual CollagePlus plugin
  function collage() {
      $('.Collage').removeWhitespace().collagePlus(
          {
              'fadeSpeed'     : 2000,
              'targetHeight'  : 200,
              'effect'        : 'effect-1',
              'direction'     : 'vertical'
          }
      );
  };

  // This is just for the case that the browser window is resized
  var resizeTimer = null;
  $(window).bind('resize', function() {
      // hide all the images until we resize them
      $('.Collage .Image_Wrapper').css("opacity", 0);
      // set a timer to re-apply the plugin
      if (resizeTimer) clearTimeout(resizeTimer);
      resizeTimer = setTimeout(collage, 200);
  });




  </script>

</head>
<body>


<!-- WHY DOESNT IT WORK!? -->



  <?php
    if (isset($_SESSION['success'])){
      echo "<br>".$_SESSION['success'];
      unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])){
      echo "<br>".$_SESSION['error'];
      unset($_SESSION['error']);
    }
   ?>
   <p class="uploadClick">Upload a File</p>
<form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit"> </br>
    <p>Select Access Privilege</p>
    <input type="radio" name="access" value="public">Public
    <input type="radio" name="access" value="private">Private
</form>

<div class="Collage">
<?php
  $dirName = "img/uploads/";
  // $images = glob($dirname."*.*");
  // foreach($images as $image) {
  //   echo '<img src="'.$image.'"/> <br />';
  // }

  $stmt = $pdo->query("SELECT user_id, fileName FROM images WHERE access = 1 AND user_id = ".$_SESSION['id'] );
  while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      echo '<img src="'.$dirName.$row['fileName'].'"/>';

  }


?>

</div>
<script type=text/javascript>
$(".uploadClick").click(function(){
  $(".upload").fadeIn(500);
  console.log("aaa");
});

</script>
</body>
</html>

<!-- USE ONLOAD TO MAKE SURE JAVASCRIPT WORKS AFTER WHOLE FILE IS LOADED -->
