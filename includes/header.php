<?php if ($_SESSION['login']) { ?>
	<div class="top-header">
		<div class="container">
			<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s" style="position: relative; z-index: 10;">
				<li class="tol">Welcome:</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<?php echo htmlentities($_SESSION['login']); ?> <i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu drp-mnu" style="position: absolute; top: 100%; left: 0; z-index: 1000; background: #fff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
						<li class="prnt"><a href="profile.php" style="color: black;"> My Profile</a></li>
						<li class="prnt"><a href="change-password.php" style="color: black;"> Change Password</a></li>
						<li class="prnt"><a href="tour-history.php" style="color: black;"> My Tour History</a></li>
						<li class="prnt"><a href="issuetickets.php" style="color: black;"> Tickets</a></li>
					</ul>
				</li>
				<li class="sigi"><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
<?php } else { ?>
	<div class="top-header">
		<div class="container">
			<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
				<li class="hm"><a href="index.php"><i class="fa fa-home"></i></a></li>
			</ul>
			<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s">
				<li class="sig"><a href="#" data-toggle="modal" data-target="#myModal">Sign Up</a></li>
				<li class="sigi"><a href="#" data-toggle="modal" data-target="#myModal4">/ Sign In</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
<?php } ?>
<!--- /top-header ---->
<!--- header ---->
<div class="header">
	<div class="container">
		<div class="logo wow fadeInDown animated" data-wow-delay=".5s">
			<a href="index.php">TravelEase</a>
		</div>
		<div class="lock fadeInDown animated" data-wow-delay=".5s">
			<li><i class="fa fa-lock"></i></li>
			<li>
				<div class="securetxt">SAFE &amp; SECURE </div>
			</li>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--- /header ---->
<!--- footer-btm ---->
<div class="footer-btm wow fadeInLeft animated" data-wow-delay=".5s">
	<div class="container">
		<div class="navigation">
			<nav class="navbar navbar-default">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<nav class="cl-effect-1">
						<ul class="nav navbar-nav">
							<li><a href="index.php">Home</a></li>
							<li><a href="page.php?type=aboutus">About</a></li>
							<li><a href="package-list.php">Tour Packages</a></li>
							<li><a href="page.php?type=privacy">Privacy Policy</a></li>
							<li><a href="page.php?type=terms">Terms of Use</a></li>
							<li><a href="page.php?type=contact">Contact Us</a></li>
							<?php if ($_SESSION['login']) { ?>
								<li>Need Help? <a href="#" data-toggle="modal" data-target="#myModal3"> / Write Us</a></li>
							<?php } else { ?>
								<li><a href="enquiry.php">Enquiry</a></li>
							<?php } ?>
						</ul>
					</nav>
				</div>
			</nav>
		</div>
		<div class="clearfix"></div>
	</div>
</div>