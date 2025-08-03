<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (isset($_POST['submit2'])) {
	$pid = intval($_GET['pkgid']);
	$useremail = $_SESSION['login'];
	$fromdate = $_POST['fromdate'];
	$todate = $_POST['todate'];
	$comment = $_POST['comment'];
	$selected_guide_id = $_POST['guide_id']; // Selected guide ID
	$status = 0;

	try {
		// Start a transaction
		$dbh->beginTransaction();

		// Insert booking details into tblbooking
		$sql = "INSERT INTO tblbooking (PackageId, UserEmail, FromDate, ToDate, Comment, status) 
                VALUES (:pid, :useremail, :fromdate, :todate, :comment, :status)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':pid', $pid, PDO::PARAM_STR);
		$query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
		$query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
		$query->bindParam(':todate', $todate, PDO::PARAM_STR);
		$query->bindParam(':comment', $comment, PDO::PARAM_STR);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();

		// If a guide is selected, insert guide booking details
		if ($selected_guide_id) {
			$sqlGuide = "INSERT INTO tblguidebooking (BookingId, GuideId) VALUES (:bookingid, :guideid)";
			$queryGuide = $dbh->prepare($sqlGuide);
			$queryGuide->bindParam(':bookingid', $lastInsertId, PDO::PARAM_INT);
			$queryGuide->bindParam(':guideid', $selected_guide_id, PDO::PARAM_INT);
			$queryGuide->execute();
		}

		// Commit the transaction
		$dbh->commit();
		$msg = "Booked Successfully";
	} catch (Exception $e) {
		// Rollback the transaction in case of an error
		$dbh->rollBack();
		$error = "Something went wrong. Please try again: " . $e->getMessage();
	}
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>TravelEase | Package Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/font-awesome.css" rel="stylesheet">
	<script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<style>
		.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
		}

		.succWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
		}
	</style>
</head>

<body>
	<?php include('includes/header.php'); ?>
	<div class="banner-3">
		<div class="container">
			<h1>TravelEase - Package Details</h1>
		</div>
	</div>
	<div class="selectroom">
		<div class="container">
			<?php if ($error) { ?>
				<div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div>
			<?php } else if ($msg) { ?>
				<div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div>
			<?php } ?>

			<?php
			$pid = intval($_GET['pkgid']);
			$sql = "SELECT * FROM tbltourpackages WHERE PackageId = :pid";
			$query = $dbh->prepare($sql);
			$query->bindParam(':pid', $pid, PDO::PARAM_STR);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);

			if ($query->rowCount() > 0) {
				foreach ($results as $result) { ?>
					<form name="book" method="post">
						<div class="selectroom_top">
							<div class="col-md-4 selectroom_left">
								<img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage); ?>" class="img-responsive" alt="">
							</div>
							<div class="col-md-8 selectroom_right">
								<h2><?php echo htmlentities($result->PackageName); ?></h2>
								<p><b>Package Type:</b> <?php echo htmlentities($result->PackageType); ?></p>
								<p><b>Package Location:</b> <?php echo htmlentities($result->PackageLocation); ?></p>
								<p><b>Features:</b> <?php echo htmlentities($result->PackageFetures); ?></p>
								<div class="ban-bottom">
									<div class="bnr-right">
										<label class="inputLabel">From</label>
										<input type="date" name="fromdate" id="fromdate" min="<?php echo date('Y-m-d'); ?>" required>
									</div>
									<div class="bnr-right">
										<label class="inputLabel">To</label>
										<input type="date" name="todate" id="todate" min="<?php echo date('Y-m-d'); ?>" required>
									</div>
								</div>

								<script>
									// Get the From and To date input fields
									const fromDateInput = document.getElementById('fromdate');
									const toDateInput = document.getElementById('todate');

									// Listen for changes on the From Date input
									fromDateInput.addEventListener('change', function() {
										// Set the min attribute of the To Date to the selected From Date
										const fromDateValue = this.value;
										toDateInput.min = fromDateValue;
									});

									// Optionally, ensure that To Date is not earlier than From Date if already filled
									toDateInput.addEventListener('change', function() {
										if (this.value < fromDateInput.value) {
											alert("To Date cannot be earlier than From Date.");
											this.value = fromDateInput.value; // Reset to match From Date
										}
									});
								</script>


								<div class="grand">
									<p>Total</p>
									<h3>BDT <?php echo htmlentities($result->PackagePrice); ?></h3>
								</div>
							</div>
							<h3>Package Details</h3>
							<p><?php echo htmlentities($result->PackageDetails); ?></p>
							<div class="clearfix"></div>
						</div>

						<!-- Fetch and display available guides -->
						<div class="selectroom_top">
							<h3>Select a Tour Guide</h3>
							<div>
								<label for="guide_id">Choose a Guide:</label>
								<select name="guide_id" id="guide_id" class="form-control">
									<option value="">None</option>
									<?php
									// Replace `$result->PackageLocation` with the actual variable containing location information.
									$location = htmlentities($result->PackageLocation);

									// SQL query to fetch available tour guides filtered by location.
									$sqlGuides = "SELECT NationalID, Name, Phone, PricePerDay FROM tbltourguides 
                          WHERE Available = 1 AND Location = :location";

									$queryGuides = $dbh->prepare($sqlGuides);
									$queryGuides->bindParam(':location', $location, PDO::PARAM_STR);
									$queryGuides->execute();
									$guides = $queryGuides->fetchAll(PDO::FETCH_OBJ);

									// Check if any guide is available
									if ($queryGuides->rowCount() > 0) {
										foreach ($guides as $guide) { ?>
											<option value="<?php echo htmlentities($guide->NationalID); ?>">
												<?php echo htmlentities($guide->Name) . " - " . htmlentities($guide->Phone) .
													" - tk" . htmlentities($guide->PricePerDay) . "/day"; ?>
											</option>
									<?php }
									} else {
										echo '<option value="">No guides available</option>';
									} ?>
								</select>
							</div>
						</div>


						<div class="selectroom-info">
							<ul>
								<li class="spe">
									<label class="inputLabel">Comment</label>
									<input type="text" name="comment">
								</li>
								<?php if ($_SESSION['login']) { ?>
									<li class="spe" align="center">
										<button type="submit" name="submit2" class="btn-primary btn">Book</button>
									</li>
								<?php } else { ?>
									<li class="sigi" align="center" style="margin-top: 1%">
										<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-primary btn">Book</a>
									</li>
								<?php } ?>
							</ul>
						</div>
					</form>
			<?php }
			} ?>
		</div>
	</div>
	<?php include('includes/footer.php'); ?>
	<?php include('includes/signup.php'); ?>
	<?php include('includes/signin.php'); ?>
	<?php include('includes/write-us.php'); ?>
</body>

</html>