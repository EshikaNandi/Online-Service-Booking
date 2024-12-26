<?php
require 'Admin/dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/pstyle.css">
    <style>
        #logo {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 25%;
        }
    </style>

</head>

<body>
    <?php require 'header.php' ?>
    <div class="pcontainer">
        <img src="img/logo.png" id="logo" alt="user">
        <h2 style="text-align: center;">User Profile</h2>
        <form id="profileForm" method="post" action="update.php">
            <div class="form-group">
                <label for="name">First Name:</label><br>
                <div class="input">
                    <input type="text" id="fname" value="<?php echo $rec2['first_name'] ?>" name="fname" readonly>
                    <button type="button" class="edit-button" data-field="name"><i class="fa-regular fa-pen-to-square"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label for="area">Last Name:</label><br>
                <div class="input">
                    <input type="text" id="lname" value="<?php echo $rec2['last_name']; ?>" placeholder="<?php if ($rec2['last_name'] != null) {
                                                                                                                echo $rec2['last_name'];
                                                                                                            } else {
                                                                                                                echo "Empty";
                                                                                                            } ?>" name="lname" readonly>
                    <button type="button" class="edit-button" data-field="area"><i class="fa-regular fa-pen-to-square"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email:</label><br>
                <div class="input">
                    <input type="email" id="email" value="<?php echo $rec2['email'] ?>" name="email" readonly>
                </div>
            </div>
            <div class="form-group">
                <label for="contact">Contact:</label><br>
                <div class="input">
                    <input type="text" id="contact" value="<?php echo $rec2['mobile_no'] ?>" name="contact" readonly>
                    <button type="button" class="edit-button" data-field="contact"><i class="fa-regular fa-pen-to-square"></i></button>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label><br>
                <div class="input">
                    <input type="password" id="password" value="<?php echo $rec2['password'] ?>" name="password" readonly>
                    <button type="button" class="edit-button" data-field="password"><i class="fa-regular fa-pen-to-square"></i></button>
                </div>
            </div>
            <div id="cpassSection" style="display: none;">
                <label for="cpassword">Enter Password:</label><span style="font-size: 12px; color :red;"> *Enter Your password to change details</span><br>
                <input type="password" id="cpassword" name="cpassword">
            </div>
            <button type="submit" class="btn text-white" id="saveButton" style="display: none; margin-top:10px;background-color: #00909D;width:100%;height:50px;border-radius:10px;">Save Changes</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-button');
            const saveButton = document.getElementById('saveButton');
            const cpassword = document.getElementById('cpassSection');
            const form = document.getElementById('profileForm');
            const inputs = document.querySelectorAll('input[readonly]');

            function hasChanges(inputField) {
                return inputField.value.trim() !== inputField.defaultValue.trim();
            }

            function handleBlur(event) {
                const inputField = event.target;
                const fieldName = inputField.getAttribute('id');
                const editButton = document.querySelector(`button.edit-button[data-field="${fieldName}"]`);
                if (hasChanges(inputField)) {
                    editButton.style.display = 'none';
                } else {
                    editButton.style.display = 'inline-block';
                    saveButton.style.display = 'none';
                    cpassword.style.display = 'none';
                    inputField.setAttribute('readonly', 'true');
                }
            }
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const fieldName = this.getAttribute('data-field');
                    const inputField = document.getElementById(fieldName);
                    inputField.removeAttribute('readonly');
                    inputField.focus();
                    this.style.display = 'none';
                    cpassword.style.display = 'block'
                    saveButton.style.display = 'inline-block';
                });
            });
            form.addEventListener('submit', function(event) {
                let changesMade = false;
                inputs.forEach(input => {
                    if (hasChanges(input)) {
                        changesMade = true;
                        return;
                    }
                });

                if (!changesMade) {
                    event.preventDefault();
                    alert('No changes were made.');
                    inputs.forEach(input => {
                        input.setAttribute('readonly', 'true');
                        input.value = input.defaultValue;
                    });
                    editButtons.forEach(button => {
                        button.style.display = 'inline-block';
                    });
                    saveButton.style.display = 'none';
                    cpassword.style.display = 'none';
                } else {
                    inputs.forEach(input => {
                        input.setAttribute('readonly', 'true');
                    });
                    editButtons.forEach(button => {
                        button.style.display = 'inline-block';
                    });
                    saveButton.style.display = 'none';
                    cpassword.style.display = 'none';
                }
            });
            inputs.forEach(input => {
                input.addEventListener('blur', handleBlur);
            });
        });
    </script>
</body>

</html>