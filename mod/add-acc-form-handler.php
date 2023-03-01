<?php
require_once '../config/dbconnect.php';

$room_number = $_GET['id'];
$addAcc = "INSERT INTO `accommodation` (`id`,`room_number`)
           VALUES (null, '$room_number');";
$addAcc = mysqli_query($mysqli, $addAcc);
if (!$addAcc) die (mysqli_error($mysqli));

if (isset($_POST['submit'])) {
    $accId = "SELECT id FROM `accommodation` order by id desc LIMIT 1;";
    $accId = mysqli_query($mysqli, $accId);
    $accId = $accId->fetch_array()['id'];

    $check_in_date = strip_tags($_POST['check_in_date']);
    $check_out_date = strip_tags($_POST['check_out_date']);
    $bill = (int)strip_tags($_POST['bill']);

    $resId = strip_tags($_POST['resId']);

    $updAcc = "UPDATE `accommodation` 
               SET `check_in_date` = '$check_in_date', 
                    `check_out_date` = '$check_out_date', 
                    `bill` = '$bill' 
               WHERE `accommodation`.`id` = $accId;";

    $resInAcc = "INSERT INTO `residents_in_accommodation` (`id_accommodation`, `id_resident`)
                 VALUES ('$accId', '$resId');";
    $resInAcc = mysqli_query($mysqli, $resInAcc);
    if (!$resInAcc) die (mysqli_error($mysqli));

    $changeIsBusy = "UPDATE room SET isBusy = 1
                    WHERE room_number = '$room_number'";
    if (!mysqli_query($mysqli, $changeIsBusy)) die (mysqli_error($mysqli));

    if (mysqli_query($mysqli, $updAcc)) {
        echo "<h3>Заселение добавлено</h3>";
        header ('refresh: 2, url=../index.php');
        exit();
    }
    else die (mysqli_error($mysqli));
}