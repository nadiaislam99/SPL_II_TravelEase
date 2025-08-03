<?php
session_start();
error_reporting(0);
include('includes/config.php');

if (strlen($_SESSION['alogin']) == 0) {
    header("location:../index.php");
} else {
    // Code for deletion
    if ($_GET['action'] == 'delete') {
        $nid = $_GET['id'];
        $sql = "DELETE FROM tblTourGuides WHERE NationalID =:nid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':nid', $nid, PDO::PARAM_STR);
        $query->execute();
        echo "<script>alert('Guide deleted successfully.');</script>";
        echo "<script>window.location.href='manage-tour-guides.php'</script>";
    }
?>
    <!DOCTYPE HTML>
    <html>

    <head>
        <title>TravelEase | Manage Tour Guides</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="application/x-javascript">
            addEventListener("load", function() {
                setTimeout(hideURLbar, 0);
            }, false);

            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Custom CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="css/morris.css" type="text/css" />
        <!-- Graph CSS -->
        <link href="css/font-awesome.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="js/jquery-2.1.4.min.js"></script>
        <!-- Tables -->
        <link rel="stylesheet" type="text/css" href="css/table-style.css" />
        <link rel="stylesheet" type="text/css" href="css/basictable.css" />
        <script type="text/javascript" src="js/jquery.basictable.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#table').basictable();
            });
        </script>
        <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
        <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
    </head>

    <body>
        <div class="page-container">
            <div class="left-content">
                <div class="mother-grid-inner">
                    <?php include('includes/header.php'); ?>
                    <div class="clearfix"></div>
                </div>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Manage Tour Guides</li>
                </ol>

                <div class="agile-grids">
                    <div class="agile-tables">
                        <div class="w3l-table-info">
                            <h2>Manage Tour Guides</h2>
                            <table id="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>National ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Experience (Years)</th>
                                        <th>Location</th>
                                        <th>Price per Day</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM tblTourGuides";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt = 1;

                                    if ($query->rowCount() > 0) {
                                        foreach ($results as $result) { ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($result->NationalID); ?></td>
                                                <td><?php echo htmlentities($result->Name); ?></td>
                                                <td><?php echo htmlentities($result->Email); ?></td>
                                                <td><?php echo htmlentities($result->Phone); ?></td>
                                                <td><?php echo htmlentities($result->Experience); ?></td>
                                                <td><?php echo htmlentities($result->Location); ?></td>
                                                <td><?php echo htmlentities($result->PricePerDay); ?></td>
                                                <td>
                                                    <a href="update-tour-guide.php?nid=<?php echo htmlentities($result->NationalID); ?>">
                                                        <button type="button" class="btn btn-primary">Edit</button>
                                                    </a>
                                                    <a href="manage-tour-guides.php?action=delete&id=<?php echo htmlentities($result->NationalID); ?>"
                                                        onclick="return confirm('Are you sure you want to delete this guide?')">
                                                        <button type="button" class="btn btn-danger">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                            $cnt++;
                                        }
                                    } else { ?>
                                        <tr>
                                            <td colspan="9">No records found</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

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

                    <div class="inner-block"></div>
                    <?php include('includes/footer.php'); ?>
                </div>
            </div>
            <?php include('includes/sidebarmenu.php'); ?>
            <div class="clearfix"></div>
        </div>
        <script>
            var toggle = true;
            $(".sidebar-icon").click(function() {
                if (toggle) {
                    $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
                    $("#menu span").css({
                        "position": "absolute"
                    });
                } else {
                    $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
                    setTimeout(function() {
                        $("#menu span").css({
                            "position": "relative"
                        });
                    }, 400);
                }
                toggle = !toggle;
            });
        </script>
        <script src="js/jquery.nicescroll.js"></script>
        <script src="js/scripts.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>

    </html>
<?php } ?>