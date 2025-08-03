<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header("location:../index.php");
} else {
	// Code for changing the password  
	if (isset($_POST['submit'])) {
		// Get the form inputs
		$password = $_POST['password'];  // Current password
		$newpassword = $_POST['newpassword'];  // New password
		$username = $_SESSION['alogin'];  // Username from session

		// Check if current password matches the stored password
		$sql = "SELECT Password FROM admin WHERE UserName=:username";
		$query = $dbh->prepare($sql);
		$query->bindParam(':username', $username, PDO::PARAM_STR);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if ($result && password_verify($password, $result['Password'])) {
			// Current password is correct, proceed to update the password
			$newpasswordHash = password_hash($newpassword, PASSWORD_DEFAULT);  // Hash the new password

			// Update the password in the database
			$updateSQL = "UPDATE admin SET Password=:newpassword WHERE UserName=:username";
			$updateQuery = $dbh->prepare($updateSQL);
			$updateQuery->bindParam(':username', $username, PDO::PARAM_STR);
			$updateQuery->bindParam(':newpassword', $newpasswordHash, PDO::PARAM_STR);
			$updateQuery->execute();

			$msg = "Your password has been successfully changed.";
		} else {
			$error = "Your current password is incorrect.";
		}
	}
?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<title>TravelEase | Admin Change Password</title>

		<script type="application/x-javascript">
			addEventListener("load", function() {
				setTimeout(hideURLbar, 0);
			}, false);

			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>

		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="css/morris.css" type="text/css" />
		<link href="css/font-awesome.css" rel="stylesheet">
		<script src="js/jquery-2.1.4.min.js"></script>
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />

		<script type="text/javascript">
			function valid() {
				if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
					alert("New Password and Confirm Password fields do not match!");
					document.chngpwd.confirmpassword.focus();
					return false;
				}
				return true;
			}
		</script>

		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>

	</head>

	<body>
		<div class="page-container">
			<div class="left-content">
				<div class="mother-grid-inner">
					<!--header start here-->
					<?php include('includes/header.php'); ?>

					<div class="clearfix"> </div>
				</div>
				<!--header end here-->
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Change Password</li>
				</ol>
				<!--grid-->
				<div class="grid-form">
					<div class="grid-form1">

						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

						<div class="panel-body">
							<form name="chngpwd" method="post" class="form-horizontal" onSubmit="return valid();">

								<div class="form-group">
									<label class="col-md-2 control-label">Current Password</label>
									<div class="col-md-8">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-key"></i>
											</span>
											<input type="password" name="password" class="form-control1" id="exampleInputPassword1" placeholder="Current Password" required="">
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label">New Password</label>
									<div class="col-md-8">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-key"></i>
											</span>
											<input type="password" class="form-control1" name="newpassword" id="newpassword" placeholder="New Password" required="">
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label">Confirm Password</label>
									<div class="col-md-8">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-key"></i>
											</span>
											<input type="password" class="form-control1" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" required="">
										</div>
									</div>
								</div>

								<div class="col-sm-8 col-sm-offset-2">
									<button type="submit" name="submit" class="btn-primary btn">Submit</button>
									<button type="reset" class="btn-inverse btn">Reset</button>
								</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!--script-for sticky-nav -->
		<script>
			$(document).ready(function() {
				var navoffeset = $(".header-main").offset().top;
				$(window).scroll(function() {
					var scrollpos = $(window).scrollTop();
					if (scrollpos >= navoffeset) {
						$(".header-main").addClass("fixed");
					} else {
						$(".header-main").removeClass("fixed");
					}
				});
			});
		</script>
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<script src="js/bootstrap.min.js"></script>

	</body>

	</html>
<?php } ?>