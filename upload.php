<?php

session_start();
require_once("pdo.php");

function echoError($reason){
  $_SESSION['error'] = $reason;
  header("Location: profile.php");
  exit();
}


$path_parts = pathinfo($_FILES["fileToUpload"]["name"]);

if ($_POST['access'] == "public"){
  $target_dir = "img/uploads/";
  $access = 1;
}
else{
  $target_dir = "img/uploads/private/";
  $access = 0;
}
$fileName = $path_parts['filename'].'_'.time().'_'.$_SESSION['id'].".".$path_parts['extension'];
$fileDir = $target_dir.$fileName;


// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check == false) {
        echoError("File is not an image.");
    }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echoError("Your file should be under 5 MB.");
}

if (strlen($_FILES["fileToUpload"]["name"]) > 30) {
    echoError("The maximum length of your file is 30 characters.");
}

// Allow certain file formats
if($path_parts['extension'] != "jpg" && $path_parts['extension'] != "png" && $path_parts['extension'] != "jpeg"
&& $path_parts['extension'] != "gif" ) {
    echoError("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");

}
// Check if $uploadOk is set to 0 by an error
else {
  $sql = "INSERT INTO images (fileName, access, user_id)
            VALUES (:fileName, :access, :user_id)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(
      ':fileName' => $fileName,
      ':access' => $access,
      ':user_id' => $_SESSION['id']));
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $fileDir)) {
      $_SESSION['success'] = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      header("Location: profile.php");
      exit();
  } else {
      echoError("An error occured while uploading your file. Please try again.");
  }
}

?>
