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
$result = $mysql->query("
	SELECT Posts.Title, Posts.Body, Posts.CreatedAt,
	Comments.UserName, Comments.Body as CommentsBody, Comments.CreatedAt
	FROM Posts
	left join Comments on Comments.PostId = Posts.id;
");

for ($i = 0; $i < $result->num_rows; $i++){
	$result->data_seek($i);
	$aRow = $result->fetch_assoc();
?>
	<h1><?php echo $aRow['Title'] ?></h1>
	<p><?php echo $aRow['Body'] ?></p>
	<p><?php echo $aRow['CreatedAt'] ?></p>
	<p>Comments:<?php echo $aRow['CommentsBody'] ?> </p>
<?php } ?>
</html>
