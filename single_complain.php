<?php

require_once 'dbcon.php';

$key = '';
if (isset($_GET['p'])) {
    $key = $_GET['p'];
}

$query = mysqli_query($link, "SELECT * FROM `complain` WHERE `id` = '$key'; ");

$data = mysqli_fetch_assoc($query);
$date = $data['date'];

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
    <title><?= $data['username'] ?></title>
</head>
<body>
<input onclick="location.href='dashboard.php'" type="button" value="Dashboard" name="add-complain" class="btn solid">

<div class="table">
    <h1>Complains of: <span style="color: #4481eb"><?= $data['username'] ?></span></h1>
    <!--photo here-->
    <img src="img/<?= $data['photo']; ?>" style="height: 200px; width: 200px; border-radius: 150px"
         alt="<?= $data['username']; ?>'s Photo">
    <table class="department_table">
        <thead>
        <tr>
            <th>Phone: <?= $data['mobile'] ?></th>
            <th>Complain</th>
            <th>Email: <?= $data['email'] ?></th>
            <th><?php echo date("l: F jS, Y", strtotime($date) ) ?></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="4" style="text-align:center;">
                <pre><?= $data['complain'] ?></pre>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>