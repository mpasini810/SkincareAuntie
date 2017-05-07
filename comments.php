<!DOCTYPE html>
<html>
  <head>
    <title>Skincare Auntie</title>
  </head>
  <body>
    <h1>hello world</h1>
  </body>
  <?php
      require_once 'database.php';
      $mysql = getDB();
      $result = $mysql->query("SELECT Posts.Title, Posts.Body, Posts.CreatedAt, Posts.Views,
        Comments.UserName, Comments.Body as CommentsBody, Comments.CreatedAt
         FROM Posts
         left join Comments on Comments.PostId = Posts.id;" );
  ?>

      <?php
          for($i = 0; $i < $result->num_rows; $i++){
              $result->data_seek($i);
              $aRow = $result->fetch_assoc();
      ?>
                  <h1><?=$aRow['Title']?></h1>
                  <p><?=$aRow['Body']?></p>
                  <p><?=$aRow['CreatedAt']?></p>
                  <p>Views: <?=$aRow['Views']?></p>
                  <p>Comments:<?=$aRow['CommentsBody']?> </p>
      <?php
          }
      ?>
</html>
