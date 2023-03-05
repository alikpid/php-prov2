<?php
require_once '../config/dbconnect.php';

$errors = [];
if (isset($_POST['submit'])) {
    $surname = $_POST['surname'];
    $name = $_POST['name'];
    $middlename = $_POST['middlename'];
    $passport = $_POST['passport'];
    $phone_number = $_POST['phone_number'];
    $sex = filter_input(INPUT_POST, "sex", FILTER_VALIDATE_BOOLEAN);

    $addRes = "INSERT INTO `resident` (`surname`, `name`, `middlename`, `passport`, `phone_number`, `sex`)
               VALUES ('$surname', '$name', '$middlename', '$passport', '$phone_number', '$sex');";

    if (!$surname) $errors[] = 'Поле фамилия должно быть заполнено';
    if (!$passport) $errors[] = 'Поле пасспорт должно быть заполнено';

    if (!empty($errors))
        foreach ($errors as $error)
            echo '<p>' . $error . '</p>';
    else
    {
        if (mysqli_query($mysqli, $addRes)){
            echo "<h3>Гость добавлен</h3>";
            header('refresh: 2, url=../index.php');
            exit();
        } else die (mysqli_error($mysqli));
    }
}