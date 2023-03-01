<?php
require_once '../config/dbconnect.php';

if (isset($_POST['submit'])) {
    $surname = strip_tags($_POST['surname']);
    $name = strip_tags($_POST['name']);
    $middlename = strip_tags($_POST['middlename']);
    $passport = strip_tags($_POST['passport']);
    $phone_number = strip_tags($_POST['phone_number']);
    $sex = filter_input(INPUT_POST, "sex", FILTER_VALIDATE_BOOLEAN);

    $addRes = "INSERT INTO `resident` (`surname`, `name`, `middlename`, `passport`, `phone_number`, `sex`)
               VALUES ('$surname', '$name', '$middlename', '$passport', '$phone_number', '$sex');";

    if(!$surname) die("Поле фамилия не должно быть пустым");
    if(!$passport) die("Поле паспорт не должно быть пустым");

    if (mysqli_query($mysqli, $addRes)) {
        echo "<h3>Гость добавлен</h3>";
        header ('refresh: 2, url=../index.php');
        exit();
    }
    else die (mysqli_error($mysqli));
}