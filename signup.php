<?php
require 'Admin/dbcon.php';
?>
<?php
require 'sessionstart.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>User Log-In</title>
    <style>
        * {
            scroll-behavior: smooth;
        }

        body {
            background-image: url(img/logbg.jpg);
            background-attachment: fixed;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            display: flex;
            min-height: 100vh;
            justify-content: center;
        }

        .divfrm {
            background-color: hsla(0, 0%, 16.9%, 0.68);
            box-shadow: 8px 20px 25px rgba(124, 124, 147, 0.3);
        }

        .form-control::placeholder {
            color: white;
            font-size: 15px;
        }

        .form-control {
            height: 60px;
            border-radius: 30px;
            padding: 25px;
            color: #fff;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: #565656;
            box-shadow: 0 4px 6px rgba(176, 176, 176, 0.18), 0 -4px 6px rgba(176, 176, 176, 0.18), 4px 0 6px rgba(176, 176, 176, 0.18), -4px 0 6px rgba(176, 176, 176, 0.18);
        }

        #logo {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 25%;
        }
    </style>
</head>

<body>
    <!-- <img src="img\logbg.jpg" alt="image_bg" class="bgphoto"> -->
    <div class="col-6 pt-5 pb-0 pl-5 pr-5 mx-auto div1 mb-5 divfrm" style="min-width: 350px;max-width:420px ;border-radius:25px; margin-top:6vh;">
        <img src="img/profile.png" id="logo" alt="user">
        <h2 style="color:#fff;text-align:center;">Log In</h2>

        <form class="frm" method="post">
            <br>
            <div class="form-group">
                <label for="first_name" style="color:white;font-size:18px;">Enter First Name</label>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter Your First Name" style=" background-color:transparent ;border: 2px solid rgb(255, 255, 255, 0.2);color:#fff" required>
                <br>
                <label for="last_name" style="color:white;font-size:18px;">Enter Last Name</label>
                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Your Last Name" style=" background-color:transparent ;border: 2px solid rgb(255, 255, 255, 0.2);color:#fff" required>
                <br>
                <label for="email" style="color:white;font-size:18px;">Enter Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your email" style=" background-color:transparent ;border: 2px solid rgb(255, 255, 255, 0.2);color:#fff" required>
                <br>
                <label for="password" style="color:white;font-size:18px;">Enter Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password" style=" background-color:transparent ;border: 2px solid rgb(255, 255, 255, 0.2);color:#fff" required>
                <br>
                <label for="confirm_password" style="color:white;font-size:18px;">Enter Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Enter Your Confirm Password" style=" background-color:transparent ;border: 2px solid rgb(255, 255, 255, 0.2);color:#fff" required>
                <label for="mobile_no" style="color:white;font-size:18px;">Enter Mobile Number</label>
                <input maxlength="10" name="mobile_no" id="mobile_no" class="form-control" placeholder="Enter Your Mobile Number" style=" background-color:transparent ;border: 2px solid rgb(255, 255, 255, 0.2);color:#fff" required>
            </div>
            <br>
            <div class="text-center mb-5">
                <button type="submit" name="ok" class="btn shadow-2 mb-4 text-light" style="background-color: #00909D;width:100%;height:50px;border-radius:10px;">Signup</button>
                <p class="mb-0 text-light">Allready have an account? <a href="ulogin.php" class="text-light">Login</a></p>
            </div>
            <br>
            <!-- <div><a href="register.php"></a></div> -->
        </form>
    </div>
    <?php
    if (isset($_POST['ok'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $mobile_no = $_POST['mobile_no'];
        if (isset($first_name, $last_name, $email, $password, $confirm_password, $mobile_no))
            try {
                $src = "INSERT INTO users SET first_name='$first_name' , last_name='$last_name' , email='$email' , password='$password' , confirm_password='$confirm_password' , mobile_no='$mobile_no' ";
                $rs = mysqli_query($conn, $src) or die(mysqli_error($conn));
                //$rs=mysqli_query($conn,"INSERT INTO users (first_name,last_name,email,password,confirm_password,mobile_no)VALUES('".mysqli_real_escape_string($conn,$first_name)."','".mysqli_real_escape_string($conn,$last_name)."','".mysqli_real_escape_string($conn,$email)."','".mysqli_real_escape_string($conn,$password)."','".mysqli_real_escape_string($conn,$confirm_password)."','".mysqli_real_escape_string($conn,$mobile_no)."')")or die(mysqli_error_list($conn));
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        if ($rs == 1) {
    ?>
            <script>
                window.location.href = "ulogin.php";
            </script>
    <?php
        }
    }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>