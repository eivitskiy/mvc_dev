<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasks application</title>

    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="src/css/main.css">
    <script src="src/js/main.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Tasks application</a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <? if(!isset($_SESSION['auth']) || !$_SESSION['auth']): ?>
                    <li><a href="auth">Authorization</a></li>
                    <? else: ?>
                    <li><a href="auth/logout">Logout</a></li>
                    <? endif ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#AddNewTaskModal">
                            <span class="glyphicon glyphicon-plus"></span> Add new task
                        </a >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<main class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <? include $content; ?>
        </div>
    </div>
</main>

<!-- Модальные окна -->
<div class="modal fade" id="AddNewTaskModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="AddNewTaskTitle">Добавление новой задачи</h4>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal">
                    <div class="form-group has-feedback">
                        <label for="username" class="control-label col-xs-4">Имя пользователя:</label>
                        <div class="col-xs-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="text" class="form-control" required="required" name="username" id="username" pattern="[A-Za-z]{4,}">
                            </div>
                            <span class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="email" class="control-label col-xs-4">E-mail:</label>
                        <div class="col-xs-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input type="email" class="form-control" required="required" name="email" id="email">
                            </div>
                            <span class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="text" class="control-label col-xs-4">Текст задачи:</label>
                        <div class="col-xs-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-edit"></i></span>
                                <textarea class="form-control" required="required" name="text" id="text" rows="5"></textarea>
                            </div>
                            <span class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="images" class="control-label col-xs-4">Картинки:</label>
                        <div class="col-xs-8">
                            <input id="images" type="file" multiple required="required" accept="image/jpeg,image/png,image/gif">
                            <span class="glyphicon form-control-feedback"></span>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Нижняя часть модального окна -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button id="add_task_save" type="button" class="btn btn-primary">Добавить</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
