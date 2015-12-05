<?php
session_start();
require_once("pdo.php");
if ( !isset($_SESSION['id'])) {
  header("Location: login.php");
  exit();
}

if (isset($_POST['deleteMode'])){
  $_SESSION['delete'] = 1;
  header("Location: profile.php");
}

if (isset($_POST['exitDeleteMode'])){
  unset($_SESSION['delete']);
  header("Location: profile.php");
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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

    <input type="text" class="search" name="findUser" placeholder="Find A User">

   <a href=# class="uploadClick">Upload a File</a>

   <form method="post">
     <?php
     if ( !isset($_SESSION['delete']) ){
       echo '<input type="submit" name="deleteMode" value="Delete Mode">';

     } else {
        echo '<input type="submit" name="exitDeleteMode" value="Exit Delete Mode">';

     }

      ?>
   </form>

  <form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
      Select image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload Image" name="submit"> </br>
      <p>Select Access Privilege</p>
      <input type="radio" name="access" value="public">Public
      <input type="radio" name="access" value="private" CHECKED/>Private
  </form>

<div class="blocks">
<?php
  $dirName = "img/uploads/";
  // $images = glob($dirname."*.*");
  // foreach($images as $image) {
  //   echo '<img src="'.$image.'"/> <br />';
  // }

  $stmt = $pdo->query("SELECT img_id, user_id, fileName FROM images WHERE access = 1 AND user_id = ".$_SESSION['id'] );
  while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      if (isset($_SESSION['delete'])){
        echo '<div>
                <a class="delete" href="delete.php?img_id='.$row['img_id'].'">
                  <img src="img/delete.png"/>
                </a>
                <a class="pic" href= "display.php?img_id='.$row['img_id'].'">
                  <div class="thumbnail" style="background-image: url(img/uploads/'.$row['fileName'].');"/>
                  </div>
                </a>
              </div>';
      } else {
        echo '<div>
                <a class="pic" href= "display.php?img_id='.$row['img_id'].'">
                  <div class="thumbnail" style="background-image: url(img/uploads/'.$row['fileName'].');"/>
                  </div>
                </a>
              </div>';
      }


  }
?>
</div>
<p>These are your private images, they won't show in the public gallery.</p>
<div class="blocks">
<?php
  $stmt = $pdo->query("SELECT img_id, user_id, fileName FROM images WHERE access = 0 AND user_id = ".$_SESSION['id'] );
  $i = 0;
  while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      $userId = $row['user_id'];
      $myfile = fopen("temp/image".$i."user".$_SESSION['id'].".php", "w");
      $txt = "<?php
      session_start();
      if (!isset(\$_SESSION['id']) or \$_SESSION['id'] != ".$row['user_id']."){
        die('You cannot view other user\'s private files.');
      } else {
        \$file = '../../private539/".$row['fileName']."';
        header('Content-Type: image/jpeg');
        header('Content-Length: '.filesize(\$file));
        readfile(\$file);
      }
      ?>";

      fwrite($myfile, $txt);
      fclose($myfile);
      if (isset($_SESSION['delete'])){

        echo '<div>
                <a class="delete" href="delete.php?img_id='.$row['img_id'].'">
                  <img src="img/delete.png"/>
                </a>
                <a class="pic" href= "display.php?img_id='.$row['img_id'].'&temp_id='.$i.'">
                  <div class="thumbnail" style="background-image: url(temp/image'.$i.'user'.$_SESSION['id'].'.php);"/>
                  </div>
                </a>

              </div>';
      } else {
        echo '<div>
                <a class="pic" href= "display.php?img_id='.$row['img_id'].'&temp_id='.$i.'">
                  <div class="thumbnail" style="background-image: url(temp/image'.$i.'user'.$_SESSION['id'].'.php);"/>
                  </div>
                </a>
              </div>';
      }

      $i++;
  }
  $_SESSION['imageIndex'] = $i;
  $i = 0;


?>

</div>

<a href="logout.php">Log out</a>
<script type=text/javascript>
$(".uploadClick").click(function(){
  $(".upload").toggle(500);
});

$(".search").autocomplete({
  source: 'complete.php'
});


</script>
</body>
</html>


<!-- USE ONLOAD TO MAKE SURE JAVASCRIPT WORKS AFTER WHOLE FILE IS LOADED -->
