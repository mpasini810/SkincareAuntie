<!DOCTYPE html>
<!-- saved from url=(0038)http://getbootstrap.com/examples/blog/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Skincare Auntie</title>

    <!-- Bootstrap core CSS -->
    <link href="./Blog Template for Bootstrap_files/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./Blog Template for Bootstrap_files/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./Blog Template for Bootstrap_files/blog.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./Blog Template for Bootstrap_files/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style type="text/css">
:root #carbonads-container,
:root #content > #right > .dose > .dosesingle,
:root #content > #center > .dose > .dosesingle,
:root .carbonad
{ display: none !important; }</style></head>

<?php
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
                  <li><a href="blog.php?page=<?php echo $page_number-1; ?>">Previous</a></li>
              <?php
                }
              ?>
              <li><a href="blog.php?page=<?php echo $page_number+1; ?>">Next</a></li>
            </ul>
          </nav>

        </div><!-- /.blog-main -->

        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>By Cristy Yeung. Feel free to share this around but don’t plagiarize or istg I’ll come after you and scrub your face with St. Ives Apricot Scrub and put lemon juice and essential oils on it for all eternity. </p>
          </div>
          <div class="sidebar-module">
            <h4>Archives</h4>
            <ol class="list-unstyled">
              <li><a href="http://getbootstrap.com/examples/blog/#">June 2017</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="http://getbootstrap.com/examples/blog/#">GitHub</a></li>
              <li><a href="http://getbootstrap.com/examples/blog/#">Twitter</a></li>
              <li><a href="http://getbootstrap.com/examples/blog/#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->

    <footer class="blog-footer">

      <a href="blog.php?page=2">Next page</a>

    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./Blog Template for Bootstrap_files/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="./Blog Template for Bootstrap_files/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./Blog Template for Bootstrap_files/ie10-viewport-bug-workaround.js"></script>

</body>
</html>
