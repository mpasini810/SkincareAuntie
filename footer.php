<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
  <div class="sidebar-module sidebar-module-inset">
    <a href="contact.php"><h3 class="row text-center" style="color:white;">Contact</h3></a> 
  </div>
  <div class="sidebar-module">
    <h4>Archives</h4>
<?php 
require_once 'database.php';
$mysql = getDB();

$result = $mysql->query("
		Select id, MONTHNAME(CreatedAt) as month, YEAR(CreatedAt) as year, COUNT(*) as count from Posts
		GROUP BY YEAR(CreatedAt), MONTH(CreatedAt)
		ORDER BY YEAR(CreatedAt) desc, MONTH(CreatedAt) desc
		");

for($i = 0; $i < $result->num_rows; $i++){
		$result->data_seek($i);
		$aRow = $result->fetch_assoc();
?>
		<ol class="list-unstyled">
			<li>
				<a href="post.php?post=<?=$aRow['id']?>"><?echo $aRow['month'] . " " . $aRow['year'] . " (" . $aRow['count'] . ")"?></a>
			</li>
		</ol>
<?php } ?>
  </div>
  <div class="sidebar-module">
    <h4>Elsewhere</h4>
    <ol class="list-unstyled">
      <li><a href="linksoon">Twitter</a></li>
      <li><a href="linksoon">Facebook</a></li>
      <li><a href="linksoon">Instagram</a></li>
    </ol>
  </div>
</div><!-- /.blog-sidebar -->
</div><!-- /.row -->
</div><!-- /.container -->
<footer class="blog-footer">
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
