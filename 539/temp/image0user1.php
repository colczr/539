<?php
      session_start();
      if (!isset($_SESSION['id']) or $_SESSION['id'] != 1){
        die('You cannot view other user\'s private files.');
      } else {
        $file = '../../private539/ske1_1449208883_1.jpg';
        header('Content-Type: image/jpeg');
        header('Content-Length: '.filesize($file));
        readfile($file);
      }
      ?>