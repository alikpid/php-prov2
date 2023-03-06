<?php
include '../config/dbconnect.php';

$errors = [];
function storeError($errorName){
    global $errors;
    $errors[] = $errorName;
}
function isValidCount($resIdArray, $room_number)
{
    global $mysqli;

    $resCount = count($resIdArray);
    $bedCount = "SELECT `number_of_beds` FROM `room`
                 WHERE `room_number` = '$room_number'
                 LIMIT 1;";
    $bedCount = mysqli_query($mysqli, $bedCount);
    $bedCount = $bedCount->fetch_array()['number_of_beds'];
    if(!$bedCount) die (mysqli_error($mysqli));
    return $resCount <= $bedCount;
}
function createAccommodation($room_number)
{
    global $mysqli;
    $addAcc = "INSERT INTO `accommodation` (`id`,`room_number`)
           VALUES (null, '$room_number');";
    $addAcc = mysqli_query($mysqli, $addAcc);
    if (!$addAcc) die (mysqli_error($mysqli));
    $accId = "SELECT `id` FROM `accommodation` order by id desc LIMIT 1;";
    $accId = mysqli_query($mysqli, $accId);
    $accId = $accId->fetch_array()['id'];
    return $accId;
}
function addResidentToAccommodation($resId, $accId){
    global $mysqli;
    $resInAcc = "INSERT INTO `residents_in_accommodation` (`id_accommodation`, `id_resident`)
                 VALUES ('$accId', '$resId');";
    $resInAcc = mysqli_query($mysqli, $resInAcc);
    if (!$resInAcc) die (mysqli_error($mysqli));
}

function submitAccommodation(){
    global $mysqli;
    $resIdArray = $_POST['resId'];
    $room_number = $_GET['id'];
    if (!isValidCount($resIdArray, $room_number)) {
        storeError("Много гостей на комнату");
        return 1;
    }
    $accId = createAccommodation($room_number);
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    $bill = $_POST['bill'];
    foreach($resIdArray as $id)
        addResidentToAccommodation($id, $accId);
    $updAcc = "UPDATE `accommodation` 
               SET `check_in_date` = '$check_in_date', 
                    `check_out_date` = '$check_out_date', 
                    `bill` = '$bill' 
               WHERE `accommodation`.`id` = $accId;";
    $changeIsBusy = "UPDATE `room` SET `isBusy` = 1
                    WHERE `room_number` = '$room_number';";
    if (!mysqli_query($mysqli, $changeIsBusy)) die (mysqli_error($mysqli));
    if (!mysqli_query($mysqli, $updAcc)) die (mysqli_error($mysqli));
    return 0;
}

if (isset($_POST['submit'])) {
    if (submitAccommodation() == 0)
    {
        echo "<h3>Заселение добавлено</h3>";
        header ('refresh: 2, url=../index.php');
        exit();
    }
}
if (!empty($errors))
    foreach ($errors as $error)
        echo $error . '<br>';


