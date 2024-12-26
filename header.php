<?php
include_once('Admin/dbcon.php');
$sub = "SELECT * FROM subjects";
$subrs = mysqli_query($conn, $sub) or die(mysqli_error($conn));
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segment = explode("/", $uri_path);
$c_page = end($uri_segment);
if ($c_page == "subject.php") {
    require 'sessionchecker.php';
} else {
    require 'sessionstart.php';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>eLEARNING - eLearning HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php
    if (isset($_SESSION['users'])) {
        $uemail_id = $_SESSION['users'];
        $src2 = "SELECT * FROM users WHERE  email='$uemail_id'";
        $rs2 = mysqli_query($conn, $src2) or die(mysqli_error($conn));
        if (mysqli_num_rows($rs2) > 0) {
            $rec2 = mysqli_fetch_assoc($rs2);
        }
    }
    ?>
    <!-- Spinner Start --
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    !-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="home.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>eLEARNING</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="home.php" class="nav-item nav-link <?php if ($c_page == "home.php") {
                                                                echo "active";
                                                            } ?>">Home</a>
                <a href="about.php" class="nav-item nav-link <?php if ($c_page == "about.php") {
                                                                    echo "active";
                                                                } ?>">About</a>
                <div class="nav-item dropdown">
                    <a href="subject.php" class="nav-link dropdown-toggle <?php if ($c_page == "subject.php") {
                                                                                echo "active";
                                                                            } ?>" data-bs-toggle="dropdown">Subject</a>
                    <div class="dropdown-menu fade-down m-0">
                        <?php
                        if (mysqli_num_rows($subrs) > 0) {
                            $i = 1;
                            while ($subrec = mysqli_fetch_assoc($subrs)) {
                        ?>
                                <form name="booking<?php echo $i ?>" action="subject.php" method="post">
                                    <input type="hidden" name="subid" value="<?php echo $subrec['id']; ?>">
                                    <button type="submit" class="btn" name="ok" style="width: 100%;height:100%;background-color:white"><?php echo $subrec['subject_name']; ?></button>
                                </form>
                                <!-- <a href="#?sub=<? //php echo $subrec['subject_name'] 
                                                    ?><?php //echo $subrec['subject_name'] 
                                                        ?>" class="dropdown-item"><//?php echo $subrec['subject_name'] ?></a> -->
                        <?php
                                $i++;
                            }
                        }
                        ?>
                        <!-- <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>  -->
                    </div>
                </div>
                <!-- <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div> -->
                <a href="contact.php" class="nav-item nav-link <?php if ($c_page == "contact.php") {
                                                                    echo "active";
                                                                } ?>">Contact</a>

                <?php
                if (isset($_SESSION['users'])) {
                ?>
                    <div class="nav-item dropdown">
                        <a href="subject.php" class="nav-link dropdown-toggle <?php if ($c_page == "profile.php") {
                                                                                    echo "active";
                                                                                } ?>" data-bs-toggle="dropdown">Hi,<?php echo " ".$rec2['first_name'] ?> </a>
                        <div class="dropdown-menu fade-down m-0" style="right: 4px; width:70px;">
                            <a class="dropdown-item" style="margin-top:5px; font-size:17px;" href="profile.php"><i class="fa-regular fa-user"></i> Profile</a>
                            <a class="dropdown-item" style="margin-top:5px; font-size:17px;" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
        <?php
        if (!isset($_SESSION['users'])) {
        ?>
            <a href="ulogin.php" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Join Now<i class="fa fa-arrow-right ms-3"></i></a>
        <?php
        }
        ?>
        </div>
    </nav>