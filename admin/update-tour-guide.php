<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header("location:../index.php");
} else {
    $nid = $_GET['nid']; // Fetching National ID to identify the guide

    if (isset($_POST['submit'])) {
        // Fetch and sanitize input values
        $nationalID = $_POST['nationalid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $experience = $_POST['experience'];
        $location = $_POST['location'];
        $details = $_POST['details'];
        $image = $_FILES["image"]["name"];
        $pricePerDay = $_POST['priceperday'];
        $available = isset($_POST['available']) ? 1 : 0;

        // Handle image upload
        if ($image) {
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_path = "guideimages/" . $image;
            move_uploaded_file($image_tmp, $image_path);
        } else {
            $image_path = $result->Image; // Use the old image if no new image is uploaded
        }

        // Update query with the Available column
        $sql = "UPDATE tblTourGuides 
                SET Name = :name, Email = :email, Phone = :phone, 
                    Experience = :experience, Location = :location, Details = :details, 
                    Image = :image, PricePerDay = :priceperday, Available = :available 
                WHERE NationalID = :nationalID";

        $query = $dbh->prepare($sql);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':experience', $experience, PDO::PARAM_INT);
        $query->bindParam(':location', $location, PDO::PARAM_STR);
        $query->bindParam(':details', $details, PDO::PARAM_STR);
        $query->bindParam(':image', $image_path, PDO::PARAM_STR);
        $query->bindParam(':priceperday', $pricePerDay, PDO::PARAM_STR);
        $query->bindParam(':available', $available, PDO::PARAM_INT);
        $query->bindParam(':nationalID', $nid, PDO::PARAM_STR);

        if ($query->execute()) {
            $msg = "Tour Guide updated successfully!";
        } else {
            $error = "Something went wrong. Please try again!";
        }
    }

    // Fetch existing data for the selected guide
    $sql = "SELECT * FROM tblTourGuides WHERE NationalID = :nid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':nid', $nid, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if (!$result) {
        $error = "No guide found with the given National ID.";
    }
?>
    <!DOCTYPE HTML>
    <html lang="en">

    <head>
        <title>TravelEase | Update Tour Guide</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link href="css/font-awesome.css" rel="stylesheet">
        <script src="js/jquery-2.1.4.min.js"></script>
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
        <div class="page-container">
            <div class="left-content">
                <div class="mother-grid-inner">
                    <?php include('includes/header.php'); ?>
                    <div class="clearfix"></div>
                </div>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Home</a>
                        <i class="fa fa-angle-right"></i> Update Tour Guide
                    </li>
                </ol>

                <div class="grid-form">
                    <div class="grid-form1">
                        <h3>Update Tour Guide</h3>
                        <?php if (isset($error)) { ?>
                            <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?></div>
                        <?php } else if (isset($msg)) { ?>
                            <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?></div>
                        <?php } ?>

                        <?php if ($result) { ?>
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Guide Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="name" value="<?php echo htmlentities($result->Name); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" name="email" value="<?php echo htmlentities($result->Email); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="phone" value="<?php echo htmlentities($result->Phone); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Experience (Years)</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="experience" value="<?php echo htmlentities($result->Experience); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Location</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="location" value="<?php echo htmlentities($result->Location); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Details</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="5" name="details" required><?php echo htmlentities($result->Details); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Guide Image</label>
                                    <div class="col-sm-8">
                                        <img src="guideimages/<?php echo htmlentities($result->Image); ?>" width="200">&nbsp;&nbsp;&nbsp;<a href="change-guide-image.php?imgid=<?php echo htmlentities($result->NationalID); ?>">Change Image</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Price Per Day</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="priceperday" value="<?php echo htmlentities($result->PricePerDay); ?>" required>
                                    </div>
                                </div>

                                <!-- Available checkbox -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Available</label>
                                    <div class="col-sm-8">
                                        <input type="checkbox" name="available" <?php echo ($result->Available == 1) ? 'checked' : ''; ?>>
                                        <label>Guide is available</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Last Updation Date</label>
                                    <div class="col-sm-8">
                                        <?php echo htmlentities($result->UpdationDate); ?>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <button type="submit" name="submit" class="btn-primary btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        <?php } ?>
                    </div>
                </div>

                <?php include('includes/footer.php'); ?>
            </div>
        </div>

        <?php include('includes/sidebarmenu.php'); ?>

        <script src="js/scripts.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>

    </html>
<?php } ?>