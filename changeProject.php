<?php

    include_once 'classes/Project.php';
    $pr = new Project();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $project = $pr->addProject($_POST, $_FILES);
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content='width=device-width, initial-scale=1.0'>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <title>Редактирование информации</title>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col12">
                        <h3 class="text-white">Редактирование информации</h3>
                        <a class="btn btn-primary" href="index.php">Список проектов</a>
                    </div>
                </div>
            </div>
        </header>
        <section>
            <br>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7">
                        <div class="card shadow">
                            <?php
                                if (isset($project)) {
                                    ?>
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <strong><?=$project?></strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                        </button>
                                        </div>
                                    <?php
                                }
                            ?>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data">
                                    <label for="">Название</label>
                                    <input type="text" name="name" class="form-control">
                                
                                    <label for="">Описание</label>
                                    <textarea rows="3" name="description" class="form-control"></textarea>
                            
                                    <label for="">Изображение</label>
                                    <input type="file" name="image" class="form-control">

                                    <br>
                                    <input type="submit" class="btn btn-success form-control" value="Сохранить">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>