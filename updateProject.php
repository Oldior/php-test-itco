<?php

    include_once 'classes/Project.php';
    $pr = new Project();

    if (isset($_GET['id'])) {
        $id = base64_decode($_GET['id']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (!empty($_POST['deleteImage'])){
            $project = $pr->deleteImage($id);
        }
        $project = $pr->updateProject($_POST, $_FILES, $id);
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
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7">
                        <h3 class="text-white">Редактирование информации</h3>
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
                            <?php 
                                $getProject = $pr->getProjectById($id);
                                if ($getProject) {
                                    while ($row = $getProject->fetch()) {
                                        ?>
                                <form method="POST" enctype="multipart/form-data">
                                    <label for="">Название</label>
                                    <input type="text" name="name" value="<?=$row['name']?>" class="form-control">
                                
                                    <label for="">Описание</label>
                                    <textarea name="description" class="form-control"><?=$row['description']?></textarea>
                            
                                    <label for="">Изображение</label>
                                    <input type="file" name="image" class="form-control">
                                    <br>
                                    <div class="container text-center">
                                        <div class="row align-items-center">
                                            <div class="col">
                                            <img src="<?=$row['image']?>" style="width: 200px;" class="img-thumbnail" alt="">
                                            </div>
                                            <div class="col">
                                                <label>Удалить изображение</label>
                                                <input type="checkbox" name="deleteImage" value="<?=$row['id']?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="container text-center">
                                        <div class="row align-items-start">
                                            <div class="col">
                                            <input type="submit" class="btn btn-success form-control" value="Сохранить">
                                            </div>
                                            <div class="col">
                                            <a class="btn btn-primary form-control" href="index.php">К списку проектов</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                    <?php
                                    }
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>