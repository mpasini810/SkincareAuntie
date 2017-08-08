<?php

    require_once 'header.php';
    require_once 'database.php';
    $mysql = getDB();

    if ($_GET["post"] == null){
      $_GET["post"] = 1;
    }

    $post_number = intval($_GET["post"]);

	if (isset($_POST["submit"])) {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$body = $_POST['body'];
		 
		// Check if name has been entered
		if (!$_POST['username']) {
			$errUserName = 'What is your username?';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'What is your Email??';
		}
		
		//Check if message has been entered
		if (!$_POST['body']) {
			$errMessage = 'What do you wish to ask Auntie?';
		}
		
		// If there are no errors, send the email
	if ($username && $email && $body) {
		
		createComment($username, $email, $body, $post_number);
		
		
		$result='<div class="alert alert-success">Thank you for your comment! Auntie loves to hear from you. :) </div>';
	} else {
		$result='<div class="alert alert-danger">Oops! Your comment is missing some information. </div>';
	}
	}
 

    $post_result = $mysql->query("
        SELECT Posts.Title, Posts.Body, CAST(Posts.CreatedAt AS DATE) AS CreatedAt , Posts.Views
        FROM Posts
        WHERE Posts.id = {$post_number}");

    $comment_result = $mysql->query("
        SELECT Comments.UserName, Comments.Body, Comments.CreatedAt
        FROM Comments
        WHERE Comments.PostId = {$post_number}");

    $post_result->data_seek(0);
    $post = $post_result->fetch_assoc();

          ?>

          <div class="blog-post">
            <h2 class="blog-post-title"><?=$post['Title']?></h2>
            <p class="blog-post-meta"><?=$post['CreatedAt']?></p>
            <p><?=$post['Body']?></p>
            <hr />
            <h3>Comments</h3>

            <?php
            for($i = 0; $i < $comment_result->num_rows; $i++){
                $comment_result->data_seek($i);
                $comment = $comment_result->fetch_assoc(); ?>

            <h4><?=$comment['UserName']?>:</h4>
              <p><?=$comment['Body']?></p>


            <?php } ?>
          </div><!-- /.blog-post -->



<form class="form-horizontal" role="form" method="post" action="post.php?post=<?=$post_number?>">
	<div class="form-group">
		<label for="username" class="col-sm-2 control-label">Username</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="username" name="username" placeholder="username" value="<?php echo htmlspecialchars($_POST['username']); ?>">
			<?php echo "<p class='text-danger'>$errUserName</p>";?>
		</div>
	</div>
	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-10">
			<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php echo htmlspecialchars($_POST['email']); ?>">
			<?php echo "<p class='text-danger'>$errEmail</p>";?>
		</div>
	</div>
	<div class="form-group">
		<label for="body" class="col-sm-2 control-label">Comment</label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="4" name="body"><?php echo htmlspecialchars($_POST['body']);?></textarea>
			<?php echo "<p class='text-danger'>$errMessage</p>";?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<?php echo $result; ?>	
		</div>
	</div>
</form> 







        </div><!-- /.blog-main -->
<?php require 'footer.php' ?>
