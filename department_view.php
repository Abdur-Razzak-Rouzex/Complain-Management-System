<?php

require_once 'dbcon.php';

$key = '';
if (isset($_GET['p'])) {
    $key = $_GET['p'];
}

$query = mysqli_query($link, "SELECT * FROM `complain` WHERE `department` = '$key'; ");
//echo '<pre>';
//print_r($data);
$rows = mysqli_num_rows($query);


//exit();
//$data2 = mysqli_fetch_assoc($data);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Departmetn</title>
</head>
<body>
<input onclick="location.href='dashboard.php'" type="button" value="Dashboard" name="add-complain" class="btn solid">

<div class="table">
    <table class="department_table">
        <caption class="caption">Complains: <span style="color: #4481eb"><?php echo strtoupper($key); ?></span> Department</caption>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Complain</th>
            <th>Time</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for($i=$rows; $i > 0 ; $i--){
            $data = mysqli_fetch_assoc($query);
            $date = $data['date'];
            ?>
            <tr>
                <td><?= $data['username'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['mobile'] ?></td>
                <td><a href="single_complain.php?p=<?= $data['id'] ?>" style="text-decoration: none;">View In Detail</a></td>
                <td><?php echo date("l: F jS, Y", strtotime($date) ) ?></td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>