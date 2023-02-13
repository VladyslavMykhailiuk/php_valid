<?php
include_once 'valid.php';
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Palmo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <br>
    <div class="container">
        <div class="row">

            <form style="width: 100%" method="post" action="index.php">
                <div class="form-group row">
                    <label for="title" class="col-md-2 col-form-label">Заголовок</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($_POST['title'])) {
                            echo $_POST['title'];
                        }
                        else echo '';?>">
                        <?php if(isset($err['title'])) {
                            echo $err['title'];
                        }
                        else echo '';
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="annotation" class="col-md-2 col-form-label">Аннотация</label>
                    <div class="col-md-10">
                        <textarea name="annotation" id="annotation" class="form-control" cols="30" rows="10"><?php if(isset($_POST['annotation'])) {
                                echo $_POST['annotation'];
                            }
                            else echo '';?></textarea>
                        <?php if(isset($err['annotation'])) {
                            echo $err['annotation'];
                        }
                        else echo '';
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="content" class="col-md-2 col-form-label">Текст новости</label>
                    <div class="col-md-10">
                        <textarea name="content" id="content" class="form-control" cols="30" rows="10"><?php if(isset($_POST['content'])) {
                                echo $_POST['content'];
                            }
                            else echo '';?></textarea>
                        <?php if(isset($err['content'])) {
                            echo $err['content'];
                        }
                        else echo '';
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-2 col-form-label">Email автора для связи</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="email" name="email" value="<?php if(isset($_POST['email'])) {
                            echo $_POST['email'];
                        }
                        else echo '';?>">
                        <?php if(isset($err['email'])) {
                            echo $err['email'];
                        }
                        else echo '';
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="views" class="col-md-2 col-form-label">Кол-во просмотров</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="views" name="views" value="<?php if(isset($_POST['views'])) {
                            echo $_POST['views'];
                        }
                        else echo '';?>">
                        <?php if(isset($err['views'])) {
                            echo $err['views'];
                        }
                        else echo '';
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date" class="col-md-2 col-form-label">Дата публикации</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" id="date" name="date" value="<?php if(isset($_POST['date'])) {
                            echo $_POST['date'];
                        }
                        else echo '';?>">
                        <?php if(isset($err['date'])) {
                            echo $err['date'];
                        }
                        else echo '';
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_publish" class="col-md-2 col-form-label">Публичная новость</label>
                    <div class="col-md-10">
                            <input type="checkbox" class="form-control" <?php if(isset($_POST['is_publish'])) { ?>
                               checked
                          <?php  } ?>
                        id="is_publish" name="is_publish">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label">Публиковать на главной</label>
                    <div class="col-md-10">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="publish_in_index" id="publish_in_index_yes" value="yes"
                                <?php if(isset($_POST['publish_in_index']) && $_POST['publish_in_index'] == 'yes') { ?>
                            checked
                                <?php } ?>
                            >
                            <label class="form-check-label" for="publish_in_index_yes">
                                Да
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="publish_in_index" id="publish_in_index_no" value="no"
                                <?php if(isset($_POST['publish_in_index']) && $_POST['publish_in_index'] == 'no') { ?>
                                    checked
                                    <?php } ?>
                            >
                            <label class="form-check-label" for="publish_in_index_no">
                                Нет
                            </label>
                        </div>
                        <?php if(isset($err['publish_in_index'])) {
                            echo $err['publish_in_index'];
                        }
                        else echo '';
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="category" class="col-md-2 col-form-label">Публичная новость</label>
                    <div class="col-md-10">
                        <select id="category" class="form-control" name="category">
                            <option disabled selected>Выберете категорию из списка..</option>
                            <option value="1" <?php if(isset($_POST['category']) && $_POST['category'] == 1) { ?>
                                selected
                            <?php } ?>>Спорт</option>
                            <option value="2" <?php if(isset($_POST['category']) && $_POST['category'] == 2) { ?>
                                selected
                            <?php } ?>>Культура</option>
                            <option value="3" <?php if(isset($_POST['category']) && $_POST['category'] == 3) { ?>
                                selected
                            <?php } ?>>Політика</option>
                        </select>
                        <?php if(isset($err['category'])) {
                            echo $err['category'];
                        }
                        else echo '';
                        ?>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-9">
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </div>
                    <div class="col-md-3">
                        <?php if(isset($_GET['mes'])) { ?>
                            <div class="alert alert-success">Форма валідна</div>
                        <?php }
                        else { ?>
                            <div class="alert alert-danger">Форма невалідна</div>
                        <?php } ?>
                    </div>
                </div>
            </form>

        </div>
    </div>
</body>

</html>