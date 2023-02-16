<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<?php
$host = 'localhost';
$database = 'hotel';
$user = 'root';
$mysqli = mysqli_connect($host, $user, NULL, $database);

if(mysqli_errno($mysqli)) {
    echo "Пососи:" . mysqli_connect_error();
}

$query = "select a.room_number, r.surname  from residents_in_accomodation ria
inner join accommodation a on a.id = ria.id_accomodation
INNER JOIN resident r on r.id = ria.id_resident
order by a.room_number;
";

$res = mysqli_query($mysqli, $query);

if(!$res) die (mysqli_error($mysqli));


$prev_res_room = null;

while ($row = mysqli_fetch_assoc($res)) {

    if ("$row[room_number]" != $prev_res_room){
        ?>
            <h3>Room <?=$row['room_number'];?></h3>
        <?php
    }
    ?>
        <li><?=$row['surname'];?></li>
    <?php

    $prev_res_room = "$row[room_number]";
}

?>


</body>
</html>