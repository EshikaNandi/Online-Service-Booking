<?php
require 'dbcon.php';
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
    <title>Admin Log-In</title>
</head>

<body>
    <div class="container mt-5">
        <div class="col-6 border pt-5 pb-5 pl-5 pr-5 mx-auto div1 mb-5" style="width: 40%;">
            <div class="p-5 mb-2 mr-n5 ml-n5 mt-n5 bg-dark div2 text-center text-white">
                <h2>Admin Log In</h2>
            </div>

            <form class="frm" method="post">
                <br>
                <div class="form-group">
                    <label for="adminid">Enter Username</label>
                    <input type="text" name="adminid" id="adminid" class="form-control" placeholder="Enter Your Username" required>
                    <br>
                    <label for="passw">Enter Password</label>
                    <input type="password" name="passw" id="passw" class="form-control" placeholder="Enter Your Password" required>
                    <div class="fbttn" style="display: flex; justify-content: right;">
                        <a href="forgot.php" style="text-decoration:none;">Forgot Password?</a>
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <input type="submit" name="ok" class="btn btn-dark btn-lg " value="Sign In">
                </div>
                <br>
                <!-- <div><a href="register.php"></a></div> -->
            </form>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['ok'])) {
                $username = $_POST['adminid'];
                $pwd = $_POST['passw'];
                $src = "SELECT username,password FROM admin WHERE username='$username'";
                $rs = mysqli_query($conn, $src) or die(mysqli_error($conn));
                $rec = mysqli_fetch_assoc($rs);
                // if (mysqli_num_rows($rs) > 0) {
                //     while ($rec = mysqli_fetch_assoc($rs)) {
                // $hashedpassword = $rec['password'];
                // if ($rec['email'] == $email_id &&  password_verify($pwd, $hashedpassword)) {
                $vpassword = $rec['password'];
                $adminid = $rec['username'];
                // $vemail = $rec['email'];
                if ($pwd == $vpassword) {
                    $res = 1;
                    $_SESSION['user'] = $adminid;
                    header("refresh:1;url=dashb.php");
                } else {
                    $res = 0;
                }
                // }
                // echo $_SESSION['user'];
                if ($res == 1) {
        ?>
                    <div class="alert alert-success" role="alert">
                        Succesfully Log In
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-danger" role="alert">
                        Invalid E-mail or Password
                    </div>
        <?php
                }
            }
        }
        ?>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
   
</body>

</html>