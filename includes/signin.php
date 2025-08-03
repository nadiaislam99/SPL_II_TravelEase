<?php
session_start();
if (isset($_POST['signin'])) {
$email = $_POST['email'];
$password = md5($_POST['password']);

// Check in admin table
$sqlAdmin = "SELECT EmailId, Password FROM admin WHERE EmailId=:email AND Password=:password";
$queryAdmin = $dbh->prepare($sqlAdmin);
$queryAdmin->bindParam(':email', $email, PDO::PARAM_STR);
$queryAdmin->bindParam(':password', $password, PDO::PARAM_STR);
$queryAdmin->execute();
$adminResult = $queryAdmin->fetch(PDO::FETCH_OBJ);

if ($adminResult) {
// Admin login success
$_SESSION['alogin'] = $adminResult->EmailId;
$_SESSION['role'] = 'admin';
echo "<script type='text/javascript'>
	document.location = 'admin/dashboard.php';
</script>";
exit(); // Stop further execution
}
 else {
// Check in tblusers table only if admin login fails
$sqlUser = "SELECT EmailId, Password FROM tblusers WHERE EmailId=:email AND Password=:password";
$queryUser = $dbh->prepare($sqlUser);
$queryUser->bindParam(':email', $email, PDO::PARAM_STR);
$queryUser->bindParam(':password', $password, PDO::PARAM_STR);
$queryUser->execute();
$userResult = $queryUser->fetch(PDO::FETCH_OBJ);

if ($userResult) {
// User login success
$_SESSION['login'] = $userResult->EmailId;
$_SESSION['role'] = 'user';
echo "<script type='text/javascript'>
	document.location = 'package-list.php';
</script>";
exit(); // Stop further execution
} else {
// If credentials do not match either table
echo "<script>
	alert('Invalid email or password');
</script>";
}
}
}
?>

<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content modal-info">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body modal-spa">
				<div class="login-grids">
					<div class="login">
						<div class="login-right">
							<form method="post">
								<h3>Sign in with your account</h3>
								<input type="text" name="email" id="email" placeholder="Enter your Email" required="">
								<input type="password" name="password" id="password" placeholder="Password" required="">
								<h4><a href="forgot-password.php">Forgot password</a></h4>
								<input type="submit" name="signin" value="SIGN IN">
							</form>
						</div>
						<div class="clearfix"></div>
					</div>
					<p>
						By logging in, you agree to our
						<a href="page.php?type=terms">Terms and Conditions</a> and
						<a href="page.php?type=privacy">Privacy Policy</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>