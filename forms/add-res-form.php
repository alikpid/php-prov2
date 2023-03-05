<?php include '../mod/add-res-form-handler.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Add resident</title>
</head>

<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <form method="post" class="my-2">

                <div class="form-group">
                    <label for="name">Имя</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="surname">Фамилия</label>
                    <input type="text" class="form-control" id="surname" name="surname" required>
                </div>


                <div class="form-group">
                    <label for="middlename">Отчество</label>
                    <input type="text" class="form-control" id="middlename" name="middlename">
                </div>

                <div class="form-group">
                    <label for="passport">Серия и номер паспорта (без пробелов)</label>
                    <input type="text" class="form-control" id="passport" name="passport" maxlength="10" required>
                </div>

                <div class="form-group">
                    <label for="phone_number">Телефон</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" required>
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
                <br>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>