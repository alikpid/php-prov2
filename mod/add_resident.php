<?php
require_once '../config/dbconnect.php';
?>
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
$errors = [];
// Обработчик HTML-формы
if (!empty($_POST)) {
   // Если поле first не заполнено, выводим сообщение об ошибке
   if (empty($_POST['surname'])) {
       $errors[] = 'Введите фамалию';
   }
   if (empty($_POST['name'])) {
       $errors[] = 'Введите имя';
   }
    if (empty($_POST['phone_number'])) {
        $errors[] = 'Введите телефон';
    }
    if (empty($_POST['passport'])) {
        $errors[] = 'Введите данные паспорта';
    }

   // Если нет ошибок, начинаем обработку данных
   if (empty($errors)) {
       $surname = strip_tags($_POST['surname']);
       $name = strip_tags($_POST['name']);
       $middlename = strip_tags($_POST['middlename']);
       $passport = strip_tags($_POST['passport']);
       $phone_number = strip_tags($_POST['phone_number']);
       $sex = strip_tags($_POST['sex']);;
       $addRes = "INSERT INTO `resident` (`surname`, `name`, `middlename`, `passport`, `phone_number`, `sex`)
                  VALUES ('$surname', '$name', '$middlename', '$passport', '$phone_number', '$sex')
                  ";
       $addRes = mysqli_query($mysqli, $addRes);
       if (!$addRes) die (mysqli_error($mysqli));
       echo "Гость добавлен <br>";
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
<div class="container">
    <div class="row">
        <div class="col-md-3">

            <form action="" method="post">

                <div class="form-group">
                    <label for="surname">Фамилия</label>
                    <input type="text" class="form-control" id="surname" name="surname">
                </div>

                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="form-group">
                    <label for="middlename">Отчество</label>
                    <input type="text" class="form-control" id="middlename" name="middlename">
                </div>

                <div class="form-group">
                    <label for="passport">Серия и номер паспорта (без пробелов)</label>
                    <input type="text" class="form-control" id="passport" name="passport" maxlength="10">
                </div>

                <div class="form-group">
                    <label for="phone_number">Телефон</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number">
                </div>

                <div class="form-group">
                    <p>Пол</p>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" id="male" value="1" checked>
                        <label class="form-check-label" for="male">Мужской</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sex" id="female" value="0">
                        <label class="form-check-label" for="female">Женский</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
</div>
</body>
</html>