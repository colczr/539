<?php
session_start();
require_once("pdo.php");

if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
  $fileName = $_FILES['userfile']['name'];
  $tmpName  = $_FILES['userfile']['tmp_name'];
  $fileSize = $_FILES['userfile']['size'];
  $fileType = $_FILES['userfile']['type'];

  $fp      = fopen($tmpName, 'r');
  $content = fread($fp, filesize($tmpName));
  //$content = addslashes($content);
  fclose($fp);

  if(!get_magic_quotes_gpc())
  {
      $fileName = addslashes($fileName);
  }


  $sql = "INSERT INTO images (user_id, fileName, image)
            VALUES (:user_id, :fileName, :image)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute(array(

      ':image' => $content,
      ':fileName' => $fileName,
      ':user_id' => $_SESSION['id']));


  $_SESSION['success'] = "File ".$fileName." uploaded.";
  header("Location: profile.php");
  return;
}
?>





<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Profile</title>
	<link rel="stylesheet" href="css/Style.css">
</head>

<body>
  <h1>Your Profile</h1>
  <nav></nav>
  <form method="post" enctype="multipart/form-data">
    <table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
    <tr>
    <td width="246">
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
    <input name="userfile" type="file" id="userfile">
    </td>
    <td width="80"><input name="upload" type="submit" class="box" id="upload" value=" Upload "></td>
    </tr>
    </table>
  </form>

<?php
  if (isset($_SESSION['success'])){
    echo "<br>".$_SESSION['success'];
    unset($_SESSION['success']);
  }
 ?>
</body>
</html>
