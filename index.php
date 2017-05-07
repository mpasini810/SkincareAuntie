<?php

    require 'header.php';
    require_once 'database.php';
    $mysql = getDB();

    if ($_GET["page"] == null){
      $_GET["page"] = 1;
    }

    $page_number = intval($_GET["page"]);
    $OFFSET = $page_number * 5 - 5;

    $result = $mysql->query("
        SELECT Posts.Title, Posts.Body, Posts.CreatedAt, Posts.Views
        FROM Posts
        LIMIT 5 OFFSET {$OFFSET}");
?>

  <body>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="http://getbootstrap.com/examples/blog/#">Introduction and Start Here</a>
          <a class="blog-nav-item" href="http://getbootstrap.com/examples/blog/#">My Routine</a>
          <a class="blog-nav-item" href="http://getbootstrap.com/examples/blog/#">Dos and Don'ts</a>
          <a class="blog-nav-item" href="http://getbootstrap.com/examples/blog/#">Auntie's Mission</a>
        </nav>
      </div>
    </div>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">Skincare Auntie</h1>
        <p class="lead blog-description">The tentative skincare blog for my dear friend Cristy Yeung</p>
      </div>

      <div class="row">

        <div class="col-sm-8 blog-main">

          <?php
              for($i = 0; $i < $result->num_rows; $i++){
                  $result->data_seek($i);
                  $aRow = $result->fetch_assoc();
          ?>

          <div class="blog-post">
            <h2 class="blog-post-title"><?=$aRow['Title']?></h2>
            <p class="blog-post-meta">January 1, 2014 by <a href="http://getbootstrap.com/examples/blog/#">Mark</a></p>

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
<?php
require footer.php
?>
