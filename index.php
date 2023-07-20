<?php

    include_once 'classes/Project.php';
    $pr = new Project();
    if (isset($_POST['deleteProject']) && !empty($_POST['checkbox_id'])){
        $all_id = $_POST['checkbox_id'];
        $extract_id = implode(', ', $all_id);
        $deleteProject = $pr->deleteProject($extract_id);
        header("Location: index.php");
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
        <title class="">Список проектов</title>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-7">
                        <h3 class="text-white">Список проектов</h3>
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
                            <div class="card-body">
                                <form method="POST" action="">
                                <table class="table table-bordered">
                                    <tr>
                                        <th></th>
                                        <th>Название</th>
                                        <th>Описание</th>
                                        <th>Изображение</th>
                                    </tr>
                                    <?php
                                        $allProject = $pr->allProject();
                                        if ($allProject) {
                                            while ($row = $allProject->fetch()){
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkbox_id[]" value="<?=$row['id'];?>"></td>
                                                <td><a class="link-underline link-underline-opacity-0" href="updateProject.php?id=<?=base64_encode($row['id'])?>"><?=$row['name']?></a></td>
                                                <td><?=$row['description']?></td>
                                                <td><img style="width: 100px;"src="<?=$row['image']?>" class="img-fluid rounded mx-auto d-block" alt=""></td>
                                            </tr>
                                                <?php
                                            }
                                        }
                                    ?>
                                </table>
                                <button type="submit" name="deleteProject" class="btn btn-primary" onclick="return confirm('Подтвердите удаление')" >Удалить</button>
                                <a class="btn btn-primary" href="createProject.php">Создать</a>
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