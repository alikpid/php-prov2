<?php require_once 'config/dbconnect.php'; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm">
            <h2>Guest List</h2>
            <table class="table table-dark table-striped">
                <tr>
                    <th>Room</th>
                    <th>Arrival Date</th>
                    <th>Departure Date</th>
                    <th>Resident</th>
                </tr>
            <?php
            $resInAcc = 'SELECT resident.surname, room.room_number, accommodation.check_in_date, accommodation.check_out_date 
                         FROM residents_in_accommodation JOIN resident ON residents_in_accommodation.id_resident = resident.id 
                         JOIN accommodation ON residents_in_accommodation.id_accommodation = accommodation.id 
                         JOIN room ON accommodation.room_number = room.room_number;';
            $resInAcc = mysqli_query($mysqli, $resInAcc);
            if (!$resInAcc) die (mysqli_error($mysqli));
            $prev_res_room = null;
            while ($row = mysqli_fetch_assoc($resInAcc)) {
                if ("$row[room_number]" != $prev_res_room) {
                    echo '<tr>';
                    echo '<td>' . $row['room_number'] . '</td>';
                    echo '<td>'.$row['check_in_date'].'</td>';
                    echo '<td>'.$row['check_out_date'].'</td>';
                    echo '<td>';
                }
                echo "$row[surname] <br>";
                $prev_res_room = "$row[room_number]";
            }
            ?>
            </table>
        </div>

        <div class="col-sm">
            <h2>Available Rooms</h2>
            <table class="table table-dark table-striped">
                <tr>
                    <th>Room Number</th>
                    <th>Price</th>
                    <th>Number of beds</th>
                    <th>Action</th>
                </tr>
            <?php
            $query = 'SELECT * FROM room WHERE isBusy = 0;';
            $res = mysqli_query($mysqli, $query);
            if (!$res) die (mysqli_error($mysqli));
            while ($row = mysqli_fetch_assoc($res)) {
                echo '<tr>';
                echo '<td>'.$row['room_number'].'</td>';
                echo '<td>'.$row['price_per_day'].'</td>';
                echo '<td>'.$row['number_of_beds'].'</td>';
                echo '<td><a class="link-success" href="forms/add-acc-form.php?id='.$row['room_number'].'">Заселить</a></td>';
                echo '</tr>';
            }
            ?>
            </table>

            <a class="link-dark" href="forms/add-res-form.php">Добавить гостя</a>

        </div>
    </div>
</div>
</body>
</html>



