<?php
  session_start();
  if ( ! (isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['pass'])) ){
    header("Location: login.php");
    exit();
  }

?>



<!DOCTYPE html>
<html lang="en">
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

  $(document).ready(function(){
    $(".container").fadeIn(500);
  })

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
  <div class="container">
    <h2>What is Opis?</h2>
      <p>Opis is a collective platform on which artists of all kind can find
      collaborators to work on projects. Lorem ipsum dolor sit amet, consectetur
      adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.
      Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.
      Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.
      Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
      Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor. Pellentesque nibh.
      Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem.
       Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis,
       luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus,
       ullamcorper vel, tincidunt sed, euismod in, nibh. Quisque volutpat condimentum velit.
       Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
       Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus
       ipsum ante quis turpis. </p>
    <h2>Collection</h2>
    <div class="Collage">
      <img src="img/imp1.jpg" alt="#"/>
      <img src="img/woman.jpg" alt="#"/>
      <img src="img/starryNight.jpg" alt="#"/>
      <img src="img/greenlake.jpg" alt="#"/>
      <img src="img/ske1.jpg" alt="#"/>
      <img src="img/fau1.jpg" alt="#"/>
      <img src="img/oil1.jpg" alt="#"/>
      <img src="img/oil2.jpg" alt="#"/>
      <img src="img/wat1.jpg" alt="#"/>
      <img src="img/fau2.jpg" alt="#"/>
      <img src="img/ske2.jpg" alt="#"/>
      <img src="img/liberty.jpg" alt="#"/>
      <img src="img/oil3.jpg" alt="#"/>
      <img src="img/imp2.jpg" alt="#"/>
      <img src="img/spain.jpg" alt="#"/>
      <img src="img/oil4.jpg" alt="#"/>
      <img src="img/wat2.jpg" alt="#"/>


    </div>
  </div>

</body>

</html>
