<?php

require_once 'dbcon.php';

//catching the data posted in the complain form

if (isset($_POST['add-complain'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $complain = $_POST['complain'];
    $department = $_POST['department'];

//    renaming the user photo to save in the database with a unique name
    $photo_check = $_FILES['photo']['name'];
    $photo = explode('.', $_FILES['photo']['name']);
    $photo_ext = end($photo);
    $photo_name = $username . '.' . $photo_ext;

    $input_error = array();
    if (empty($username)) {
        $input_error['username'] = "Name Required";
    }
    if (empty($email)) {
        $input_error['email'] = "Email Required";
    }
    if (empty($mobile)) {
        $input_error['mobile'] = "Mobile Number Required";
    }
    if (empty($complain)) {
        $input_error['complain'] = "Complain Required";
    }
    if (empty($photo_name)) {
        $input_error['photo'] = "Photo Required";
    }

    if (count($input_error) == 0) {
        $query = "INSERT INTO `complain`(`username`, `email`, `mobile`, `complain`, `department`, `photo`) VALUES ('$username', '$email', '$mobile', '$complain', '$department', '$photo_name')";
        $result = mysqli_query($link, $query);

        if ($result) {
            $success = "Thank you for your concern, We'll review your feedback.....";
            move_uploaded_file($_FILES['photo']['tmp_name'], 'img/' . $photo_name);
        } else {
            $error = "Sorry....... Data Insert Failed, because of missing";
        }
    }
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMMS</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/f80d50a93c.js" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">

    <!--*********************************************************     Navigation Area Starts     ********************************************************-->
    <nav>
        <label class="logo">
            <a href="index.php"><i class="fas fa-tasks"></i> Complain Box</a>
        </label>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <i class="fas fa-align-right"></i>
        </label>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="registration.php">Register</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
        </ul>
    </nav>


    <!--*********************************************************     Main Section Starts      ********************************************************-->
    <div class="forms-container">
        <!--    ***************************************             Showing success or error message            ************************************-->
        <div>
            <?php if (isset($success)) {
                echo '<h1 style="color: green; text-align: center; padding: 20px">' . $success . '</h1>';
            } ?>
            <?php if (isset($error)) {
                echo '<h1 style="color: red; text-align: center; padding: 20px">' . $error . '</h1>';
            } ?>
        </div>
        <form action="" name="complain_form" method="post" enctype="multipart/form-data"
              onsubmit="return validateForm();">
            <h1 class="welcome">Welcome to the complain management system</h1>
            <h3 class="title">Drop Your Complain</h3>

            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" name="username" id="username" placeholder="Name">
            </div>
            <div id="username_error" style="color: red;"></div>

            <div class="input-field">
                <i class="fas fa-envelope"></i>
                <input type="" name="email" id="email" placeholder="Your Email">
            </div>
            <div id="email_error" style="color: red;"></div>

            <div class="input-field">
                <i class="fas fa-mobile"></i>
                <input type="text" name="mobile" id="mobile" placeholder="Mobile Number">
            </div>
            <div id="mobile_error" style="color: red;"></div>

            <div class="div-complain">
                <textarea name="complain" id="complain" cols="30" rows="10"
                          placeholder="Write Your Complain Here............"></textarea>
            </div>
            <div id="complain_error" style="color: red;"></div>

            <div>
                <select name="department" id="department" class="btn department">
                    <option value="">Select the department</option>
                    <option value="hr">HR</option>
                    <option value="it">IT</option>
                    <option value="logistic">Logistic</option>
                </select>
            </div>
            <div id="department_error" style="color: red;"></div>

            <input type="file" value="Your Photo" name="photo" class="photo" id="photo">
            <div id="photo_error" style="color: red;"></div>

            <input type="submit" value="Complain" name="add-complain" class="btn solid" id="submit">
        </form>
    </div>
</div>

<script>
    function validateForm() {
        let isValid = true;
        var username = (document.getElementById("username").value).trim();
        if (username == '') {
            document.getElementById("username_error").innerHTML = "Please Enter Your Name";
            isValid = false;
        } else {
            document.getElementById("username_error").innerHTML = "";
        }
        var email = (document.getElementById("email").value).trim();
        if (email == "") {
            document.getElementById("email_error").innerHTML = "* Email Required";
            isValid = false;
        } else {
            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9]/.test(email)) {
                document.getElementById("email_error").innerHTML = "";
            } else {
                document.getElementById("email_error").innerHTML = "Invalid Email";
                isValid = false;
            }
        }

        var mobile = (document.getElementById("mobile").value).trim();
        if (mobile == "") {
            document.getElementById("mobile_error").innerHTML = "* Enter Your Mobile Number";
            isValid = false;
        } else {
            var mobile_len = mobile.length;
            if (mobile_len == 11) {
                var first_three = mobile.substring(0, 3);
                if (first_three == '013' || first_three == '014' || first_three == '015' || first_three == '016' || first_three == '017' || first_three == '018' || first_three == '019') {
                    document.getElementById("mobile_error").innerHTML = "";
                } else {
                    document.getElementById("mobile_error").innerHTML = "* Enter Your Bangladeshi Mobile Number";
                    isValid = false;
                }
            } else {
                document.getElementById("mobile_error").innerHTML = "* Enter Your Bangladeshi 11 digit Mobile Number";
                isValid = false;
            }
        }

        var complain = (document.getElementById("complain").value).trim();
        if (complain == "") {
            document.getElementById("complain_error").innerHTML = "Write Your Complain";
            isValid = false;
        } else {
            document.getElementById("complain_error").innerHTML = "";
        }
        var department = (document.getElementById("department").value).trim();
        if (department == "" || department === "Select the department") {
            document.getElementById("department_error").innerHTML = "Select A Department";
            isValid = false;
        } else {
            document.getElementById("department_error").innerHTML = "";
        }

        document.getElementById("complain").value.replace(/\n/g, '<br />');

        var fileData = document.getElementById('photo');
        var fileUploadPath = fileData.value;
        if (fileUploadPath == '') {
            document.getElementById("photo_error").innerHTML = "Upload A Photo";
            isValid = false;
        } else {
            var extension = fileUploadPath.substring(
                fileUploadPath.lastIndexOf('.') + 1).toLowerCase();
            var fileError = 0;
            if (extension == "png" || extension == "jpg") {
                document.getElementById("photo_error").innerHTML = "";
            } else {
                document.getElementById("photo_error").innerHTML = "Only png and jpg formats are supported";
                isValid = false;
            }
        }
        return isValid;
    };

</script>

</body>

