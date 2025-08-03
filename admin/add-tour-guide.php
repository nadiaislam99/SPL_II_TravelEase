<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header("location:../index.php");
} else {
    if (isset($_POST['submit'])) {
        // Fetching data from the form
        $nationalID = $_POST['nationalid'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $experience = $_POST['experience'];
        $location = $_POST['location'];
        $details = $_POST['details'];
        $image = $_FILES["image"]["name"];
        $pricePerDay = $_POST['priceperday'];

        // Image upload handling
        move_uploaded_file($_FILES["image"]["tmp_name"], "guideimages/" . $_FILES["image"]["name"]);

        // SQL Insert Query
        $sql = "INSERT INTO tblTourGuides (NationalID, Name, Email, Phone, Experience, Location, Details, Image, PricePerDay, Available) 
                VALUES (:nationalID, :name, :email, :phone, :experience, :location, :details, :image, :pricePerDay, 1)";

        $query = $dbh->prepare($sql);
        $query->bindParam(':nationalID', $nationalID, PDO::PARAM_STR);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':experience', $experience, PDO::PARAM_INT);
        $query->bindParam(':location', $location, PDO::PARAM_STR);
        $query->bindParam(':details', $details, PDO::PARAM_STR);
        $query->bindParam(':image', $image, PDO::PARAM_STR);
        $query->bindParam(':pricePerDay', $pricePerDay, PDO::PARAM_STR);

        // Try to execute query and handle errors
        try {
            $query->execute();
            $msg = "Tour Guide Added Successfully";
        } catch (Exception $e) {
            if ($e->getCode() == 23000) { // Unique constraint violation
                $error = "Error: National ID already exists.";
            } else {
                $error = "Error: " . $e->getMessage();
            }
        }
    }
?>

    <!DOCTYPE HTML>
    <html>

    <head>
        <title>TravelEase | Admin Add Tour Guide</title>
        <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
        <link href="css/style.css" rel='stylesheet' type='text/css' />
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
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Add Tour Guide</li>
                </ol>
                <div class="grid-form">
                    <div class="grid-form1">
                        <h3>Add Tour Guide</h3>
                        <?php if ($error) { ?>
                            <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?></div>
                        <?php } else if ($msg) { ?>
                            <div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?></div>
                        <?php } ?>

                        <form class="form-horizontal" name="guide" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">National ID</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nationalid" placeholder="Enter National ID" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Guide Name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Experience (Years)</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="experience" placeholder="Enter Experience" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Location</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="location" required>
                                        <option value="">Select Location</option>
                                        <?php
                                        // Fetch unique locations from tbltourpackages
                                        $sqlLocations = "SELECT DISTINCT PackageLocation FROM tbltourpackages";
                                        $queryLocations = $dbh->prepare($sqlLocations);
                                        $queryLocations->execute();
                                        $locations = $queryLocations->fetchAll(PDO::FETCH_OBJ);

                                        // Populate dropdown
                                        if ($queryLocations->rowCount() > 0) {
                                            foreach ($locations as $location) { ?>
                                                <option value="<?php echo htmlentities($location->PackageLocation); ?>">
                                                    <?php echo htmlentities($location->PackageLocation); ?>
                                                </option>
                                            <?php }
                                        } else { ?>
                                            <option value="">No Locations Available</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">Details</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="5" name="details" placeholder="Enter Details" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-8">
                                    <input type="file" name="image" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Price per Day</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="priceperday" placeholder="Enter Price per Day" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button type="submit" name="submit" class="btn-primary btn">Add</button>
                                    <button type="reset" class="btn-inverse btn">Reset</button>
                                </div>
                            </div>
                        </form>
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