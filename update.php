<?php
require 'Admin/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if ($password == $cpassword) {
        $updateQuery = "UPDATE users SET first_name='$fname', last_name='$lname', mobile_no='$contact', confirm_password='$password' WHERE email = '$email';";
        if (mysqli_query($conn, $updateQuery)) {
            $res = 1;
?>
            <script>
                window.location.href = "profile.php";
            </script>
        <?php
        } else {
            // $res = 0;
            // $message = "Error updating profile";
            // echo $message;
        ?>
            <script>
                window.location.href = "profile.php";
            </script>
        <?php
        }
    } else {
        // $res = 0;
        // $message = "Password do not match";
        // echo $message;
        ?>
        <script>
            window.location.href = "profile.php";
        </script>
<?php
    }
}
?>