<?php
  session_start();
  if ($_SESSION['loggedIn'] != true){
    header("Location: login.php");
  }

if (array_key_exists('title',$_POST)) {
  require_once 'database.php';
  createPost($_POST['title'], $_POST['body']);

}

 ?>

 <html>
  <head></head>
  <body>
    <form action="create.php" method="post">
      Title:<br>
      <input type="text" name="title"><br>
      Body:<br>
      <input type="text" name="body">
      <br />
      <input type="submit" value="Submit">
    </form>
  </body>
 </html>
