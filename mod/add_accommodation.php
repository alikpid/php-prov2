<?php
require_once '../config/dbconnect.php';
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add accommodation</title>
</head>
<body>
<?php





$room_number = $_GET['id'];
$addAcc = "INSERT INTO `accommodation` (`id`,`room_number`)
           VALUES (null, '$room_number');
           ";
$addAcc = mysqli_query($mysqli, $addAcc);
if (!$addAcc) die (mysqli_error($mysqli));
$errors = [];
// Обработчик HTML-формы
if (!empty($_POST)) {
    // Если поле first не заполнено, выводим сообщение об ошибке
    if (empty($_POST['bill'])) {
        $errors[] = 'Введите счёт';
    }

    // Если нет ошибок, начинаем обработку данных
    if (empty($errors)) {
        $accId = "SELECT id FROM `accommodation` order by id desc LIMIT 1;";
        $accId = mysqli_query($mysqli, $accId);
        $accId = $accId->fetch_array()['id'];
        $check_in_date = strip_tags($_POST['check_in_date']);
        $check_out_date = strip_tags($_POST['check_out_date']);
        $bill = strip_tags($_POST['bill']);
        $resId = strip_tags($_POST['resId']);

        $updAcc = "UPDATE `accommodation` 
           SET `check_in_date` = '$check_in_date', 
               `check_out_date` = '$check_out_date', 
               `bill` = '$bill' 
           WHERE `accommodation`.`id` = $accId;";
        $updAcc = mysqli_query($mysqli, $updAcc);
        if (!$updAcc) die (mysqli_error($mysqli));
        $resInAcc = "INSERT INTO `residents_in_accomodation` (`id_accomodation`, `id_resident`) VALUES ('$accId', '$resId');";
        $resInAcc = mysqli_query($mysqli, $resInAcc);
        if (!$resInAcc) die (mysqli_error($mysqli));

        if (!mysqli_query($mysqli, "
        UPDATE room
        SET isBusy = 1
        WHERE room_number = '$room_number';
        ")) die (mysqli_error($mysqli));


        echo "Заселение добавлено <br>";
        echo "<a href='../index.php'>Главная</a>";

        exit();
    }
}
// Выводим сообщения об ошибках, если они имеются
if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<span class='error'>$error</span>";
    }
}

?>

<form action="" method="post">
    <p>Дата заселения</p>
        <input type="datetime-local" name="check_in_date">
    <p>Дата выселения</p>
        <input type="datetime-local" name="check_out_date">
    <p>Счёт</p>
        <input type="number" name="bill">
    <p>Гость</p>
    <select name="resId">
        <?php
            $query = "SELECT `surname`, `id` FROM `hotel`.`resident`";
            $res = mysqli_query($mysqli, $query);
            if(!$res) die (mysqli_error($mysqli));

            while ($row = mysqli_fetch_assoc($res)){

                ?>
                    <option value=<?=$row['id'];?>><?=$row['surname'];?></option>
                <?php
            }

        ?>
    </select>
    <button type="submit">Отправить</button>
</form>

</body>
</html>