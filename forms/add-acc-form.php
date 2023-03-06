<?php include '../mod/add-acc-form-handler.php' ?>

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
            <form action="" method="post" class="my-2">

                <div class="form-group">
                    <label for="check_in_date">Дата заселения</label>
                    <input type="datetime-local" class="form-control" id="check_in_date" name="check_in_date">
                </div>

                <div class="form-group">
                    <label for="check_out_date">Дата выселение</label>
                    <input type="datetime-local" class="form-control" id="check_out_date" name="check_out_date">
                </div>

                <div class="form-group">
                    <label for="bill">Счёт</label>
                    <input type="text" class="form-control" id="bill" name="bill">

                <div class="checkselect">
                    <label for="resId">Гость(и)</label>
                    <select class="form-select" multiple aria-label="multiple select example" id="resId" name="resId[]">

                    <?php
                        global $mysqli;
                        $query = "SELECT `surname`, `id` FROM `hotel`.`resident`";
                        $res = mysqli_query($mysqli, $query);
                        if(!$res) die (mysqli_error($mysqli));
                        while ($row = mysqli_fetch_assoc($res)){
                            ?> <option value=<?=$row['id'];?>><?=$row['surname'];?></option> <?php
                        }
                    ?>

                    </select>
                </div>

                 <br>
                 <button type="submit" class="btn btn-primary" name="submit">Заселить</button>

            </form>
        </div>
    </div>
</div>
</body>
</html>
