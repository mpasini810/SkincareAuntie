<?php

    require_once 'header.php';
    require_once 'database.php';
    $mysql = getDB();

    if ($_GET["post"] == null){
      $_GET["post"] = 1;
    }

    $post_number = intval($_GET["post"]);

    $post_result = $mysql->query("
        SELECT Posts.Title, Posts.Body, Posts.CreatedAt, Posts.Views
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
            <p class="blog-post-meta">January 1, 2014 by <a href="http://getbootstrap.com/examples/blog/#">Mark</a></p>
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
        </div><!-- /.blog-main -->
<?php require 'footer.php' ?>
