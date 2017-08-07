<?php
	if (isset($_POST["submit"])) {
		$username = $_POST['username'];
		$email = $_POST['email'];
		$message = $_POST['message'];
		$human = intval($_POST['human']);
		$from = 'Auntie Contact Form'; 
		$to = 'mpasini810@gmail.com'; 
		$subject = 'Message to the Auntie';
		
		$body = "From: $username\n E-Mail: $email\n Message:\n $message";
 
		// Check if name has been entered
		if (!$_POST['username']) {
			$errUserName = 'What is your username?';
		}
		
		// Check if email has been entered and is valid
		if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$errEmail = 'What is your Email??';
		}
		
		//Check if message has been entered
		if (!$_POST['message']) {
			$errMessage = 'What do you wish to ask Auntie?';
		}
		//Check if simple anti-bot test is correct
		if ($human !== 5) {
			$errHuman = 'Your anti-spam is incorrect';
		}
 
// If there are no errors, send the email
if (!$errUserName && !$errEmail && !$errMessage && !$errHuman) {
	if (mail ($to, $subject, $body, $from)) {
		$result='<div class="alert alert-success">Thank you for your email! Auntie will reply as soon as her mud mask is fully dried. </div>';
	} else {
		$result='<div class="alert alert-danger">Oops an error! Auntie will be back soon. </div>';
	}
}
	}
?>

<?php require_once 'header.php'; ?>
    <form class="form-horizontal" role="form" method="post" action="contact.php">
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
		<label for="message" class="col-sm-2 control-label">Message</label>
		<div class="col-sm-10">
			<textarea class="form-control" rows="4" name="message"><?php echo htmlspecialchars($_POST['message']);?></textarea>
			<?php echo "<p class='text-danger'>$errMessage</p>";?>
		</div>
	</div>
	<div class="form-group">
		<label for="human" class="col-sm-2 control-label">2 + 3 = ?</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="human" name="human" placeholder="Your Answer">
			<?php echo "<p class='text-danger'>$errHuman</p>";?>
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

</div>

         
<?php require 'footer.php' ?>
