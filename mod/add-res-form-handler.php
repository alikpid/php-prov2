<?php
require_once '../config/dbconnect.php';

$name = "";
$surname = "";
$middlename = "";
$passport = "";
$phone_number = "";
$errors = [];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $middlename = $_POST['middlename'];
    $passport = $_POST['passport'];
    $phone_number = $_POST['phone_number'];
    $sex = $_POST['sex'];

    if (empty($name))
        $errors[] = "Поле имя обязательно";
    if (empty($surname))
        $errors[] = "Поле фамилия обязательно";
    if (empty($passport))
        $errors[] = "Поле паспорт обязательно";
    if (empty($phone_number))
        $errors[] = "Поле телефон обязательно";

    if (empty($errors)) {
        $addRes = "INSERT INTO `resident` (`surname`, `name`, `middlename`, `passport`, `phone_number`, `sex`)
                   VALUES ('$surname', '$name', '$middlename', '$passport', '$phone_number', '$sex');";
        $addRes = mysqli_query($mysqli, $addRes);
        if (!$addRes) die(mysqli_error($mysqli));
        echo "<h3>Гость добавлен</h3>";
        header('refresh: 2, url=../index.php');
        exit();
    } else {
        foreach ($errors as $error)
            echo $error . "<br>";
    }
}