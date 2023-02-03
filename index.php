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
        echo "Resident ";
    }
    echo " $row[surname] ";
    if ("$row[room_number]" != $prev_res_room){
        echo "lives in room №$row[room_number] with:";
    }

        echo "<br>";

    $prev_res_room = "$row[room_number]";
}
