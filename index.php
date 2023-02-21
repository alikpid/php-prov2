<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<?php
require_once 'config/dbconnect.php';

//$query = "select a.room_number, r.surname  from residents_in_accomodation ria
//inner join accommodation a on a.id = ria.id_accomodation
//INNER JOIN resident r on r.id = ria.id_resident
//order by a.room_number;
//";
//
//$res = mysqli_query($mysqli, $query);
//
//if(!$res) die (mysqli_error($mysqli));


//$prev_res_room = null;
//
//while ($row = mysqli_fetch_assoc($res)) {
//
//    if ("$row[room_number]" != $prev_res_room){
//        ?>
<!--            <h3>Room --><?//=$row['room_number'];?><!--</h3>-->
<!--        --><?php
//    }
//    ?>
<!--        <li>--><?//=$row['surname'];?><!--</li>-->
<!--    --><?php
//
//    $prev_res_room = "$row[room_number]";
//
//}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm">
            <caption>Residents in accommodation</caption>
                <table class="table table-dark table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Room</th>
                            <th scope="col">Resident</th>
                        </tr>
                    </thead>
                <?php
                $query = "select a.room_number, r.surname  from residents_in_accomodation ria
                          inner join accommodation a on a.id = ria.id_accomodation
                          inner join resident r on r.id = ria.id_resident
                          order by a.room_number;
                          ";

                $res = mysqli_query($mysqli, $query);
                if(!$res) die (mysqli_error($mysqli));

                $prev_res_room = null;
                while ($row = mysqli_fetch_assoc($res)) {
                    if ("$row[room_number]" != $prev_res_room){
                        echo '
                        <tbody>
                            <tr>
                                <td>'. $row['room_number'] . '</td>  
                            <td>
                        ';
                    }
                    echo "$row[surname] <br>";
                    $prev_res_room = "$row[room_number]";
                }

                ?>
                </table>
        </div>
<?php
$freeRooms = "SELECT `room_number`, `isBusy`, `number_of_beds` FROM `hotel`.`room`";
$freeRooms = mysqli_query($mysqli, $freeRooms);

if (!$freeRooms) die (mysqli_error($mysqli));

?>
        <div class="col-sm">
            <br>
            <h4>Free rooms</h4>
            <?php
            while ($row = mysqli_fetch_assoc($freeRooms)) {
                if("$row[isBusy]" != 1){
                    ?>
                    <li>Room <?=$row['room_number'];?>. Number of beds:<?=$row['number_of_beds'];?> <a href="mod/add_accommodation.php?id=<?=$row['room_number'];?>">Заселить</a></li>
                    <?php
                }
            }

            ?>
        </div>
    </div>
    <a href="mod/add_resident.php">Добавить гостя</a>
</div>



</body>
</html>