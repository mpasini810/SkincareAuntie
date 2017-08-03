<?php

    require_once 'header.php';
    require_once 'database.php';
    $mysql = getDB();

    if (!array_key_exists("page", $_GET)){
      $_GET["page"] = 1;
    }

    $page_number = intval($_GET["page"]);
    $OFFSET = $page_number * 5 - 5;

    $result = $mysql->query("
        SELECT Posts.Title, Posts.Body, Posts.CreatedAt, Posts.Views,
          count(Comments.id) AS CommentCount
        FROM Posts
        LEFT JOIN Comments ON Comments.PostId = Posts.id
        GROUP BY Posts.id
        ORDER BY Posts.CreatedAt DESC
        LIMIT 5 OFFSET {$OFFSET}
        ");

    for($i = 0; $i < $result->num_rows; $i++){
        $result->data_seek($i);
        $aRow = $result->fetch_assoc();
          ?>

          <div class="blog-post">
            <h2 class="blog-post-title"><?=$aRow['Title']?></h2>
            <h4><?=$aRow['CommentCount']?> comments</h4>
            <p><?=$aRow['Body']?></p>

          </div><!-- /.blog-post -->
          <?php
              }
          ?>

          <nav>
            <ul class="pager">
              <?php
                if ($page_number >= 2) { ?>
                  <li><a href="index.php?page=<?php echo $page_number-1; ?>">Previous</a></li>
              <?php
                }
              ?>
              <li><a href="index.php?page=<?php echo $page_number+1; ?>">Next</a></li>
            </ul>
          </nav>

        </div><!-- /.blog-main -->

<?php require 'footer.php' ?>
