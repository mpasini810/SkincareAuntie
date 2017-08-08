<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	session_start(); 
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
	</head>
	<body>
		<div>
			<h1>Login</h1>
			<hr />
		</div>
	<?php if(isset($_SESSION['errMsg'])){ ?> 
		<div class="error-message"><?=$_SESSION['errMsg']?></div>
	<?php } ?>
<form name="loginForm" action="doLogin.php" method="post">
		<?php if(isset($_GET['destination'])){ ?>
			<input name="destination" type="hidden" value="<?=$_GET['destination']?>" />
		<?php }?>
	<table width="80%">
		<tr>
			<td><label for="email">Email</label></td>
			<td><input type="text" id="email" name="email" value="<?=$_SESSION['email']?>" /></td>
		</tr>
		<tr>
			<td><label for="password">Password</label></td>
			<td><input type="password" id="password" name="password"> </td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				<input type="submit" value="Log In">
			</td>
		</tr>
	</table>
</form>
		
<?php 
// unset the variables because we just finished using them
unset($_SESSION['email']);
unset($_SESSION['password']);
unset($_SESSION['errMsg']); ?>
