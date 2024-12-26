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
        *{
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
                <label for="adminid" style="color:white;font-size:18px;">Enter Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter Your email" style=" background-color:transparent ;border: 2px solid rgb(255, 255, 255, 0.2);color:#fff;" required>
                <br>
                <label for="passw" style="color:white;font-size:18px;">Enter Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password" style=" background-color:transparent ;border: 2px solid rgb(255, 255, 255, 0.2);color:#fff" required>
                <div class="fbttn" style="display: flex; justify-content: right;">
                    <a href="forgot.php" style="text-decoration:none;" class="text-white">Forgot Password?</a>
                </div>
            </div>
            <br>
            <div class="text-center">
                <button type="submit" name="ok" class="btn shadow-2 mb-4 text-light" style="background-color: #00909D;width:100%;height:50px;border-radius:10px;">Login</button>
                <p class="mb-0 text-white">Don't have account yet? <a href="signup.php" class="text-white">Signup</a></p>
            </div>
            <br>
            <!-- <div><a href="register.php"></a></div> -->
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['ok'])) {
            $email = $_POST['email'];
            $pwd = $_POST['password'];
            $src = "SELECT email,password FROM users WHERE email='$email'";
            $rs = mysqli_query($conn, $src) or die(mysqli_error($conn));
            $rec = mysqli_fetch_assoc($rs);
            // if (mysqli_num_rows($rs) > 0) {
            //     while ($rec = mysqli_fetch_assoc($rs)) {
            // $hashedpassword = $rec['password'];
            // if ($rec['email'] == $email_id &&  password_verify($pwd, $hashedpassword)) {
            $vpassword = $rec['password'];
            $email = $rec['email'];
            // $vemail = $rec['email'];
            if ($pwd == $vpassword) {
                $res = 1;
                $_SESSION['users'] = $email;
                header("location:home.php");
            } else {
                $res = 0;
            }
            // }
            // echo $_SESSION['users'];
    ?>

    <?php

        }
    }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>