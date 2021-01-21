<?php

require_once 'dbcon.php';
//require_once 'index.php';
$no_of_hr_report = mysqli_query($link, "SELECT * FROM `complain` WHERE `department` = 'hr';");
$hr = mysqli_num_rows($no_of_hr_report);

$no_of_it_report = mysqli_query($link, "SELECT * FROM `complain` WHERE `department` = 'it';");
$it = mysqli_num_rows($no_of_it_report);

$no_of_logistic_report = mysqli_query($link, "SELECT * FROM `complain` WHERE `department` = 'logistic';");
$logistic = mysqli_num_rows($no_of_logistic_report);

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/dashboard.css">
    <script src="https://kit.fontawesome.com/f80d50a93c.js" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>
<body>
<div class="grid-container">
    <header class="header">
        <div><i class="fa fa-dashboard" style="padding-right: 10px"></i>Admin Dashboard</div>
    </header>

    <aside class="sidenav">
        <h1 class="dashboard-title"><a href="index.php" style="color: white; text-decoration:none">Home</a></h1>
        <ul class="sidenav-list">
            <li class="sidenav-list-item"><a href="department_view.php?p=hr" class="dept_name"
                                             style="color: white">HR</a></li>
            <li class="sidenav-list-item"><a href="department_view.php?p=it" class="dept_name"
                                             style="color: white">IT</a></li>
            <li class="sidenav-list-item"><a href="department_view.php?p=logistic" class="dept_name"
                                             style="color: white">Logistic</a></li>
        </ul>
    </aside>

    <main class="main">
        <div class="main-overview">
            <div class="overviewcard">
                <div><a href="department_view.php?p=hr" class="dept_name">HR</a></div>
                <div><a href="department_view.php?p=hr" class="dept_name"><?= $hr ?></a></div>
            </div>
            <div class="overviewcard">
                <div><a href="department_view.php?p=it" class="dept_name">IT</a></div>
                <div><a href="department_view.php?p=it" class="dept_name"><?= $it ?></a></div>
            </div>
            <div class="overviewcard">
                <div><a href="department_view.php?p=logistic" class="dept_name">Logistic</a></div>
                <div><a href="department_view.php?p=logistic" class="dept_name"><?= $logistic ?></a></div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div>&copy 2021</div>
        <div>SOFTBD Ltd</div>
    </footer>
</div>
</body>
</html>