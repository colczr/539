<?php $file = '../../private539/imp2_1449203991_1.jpg';
          header('Content-Type: image/jpeg');
          header('Content-Length: '.filesize($file));
          readfile($file); ?>