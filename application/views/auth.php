<h3>Авторизация</h3>

<form role="form" method="post" action="auth/login" class="form-horizontal">
    <div class="form-group has-feedback">
        <label for="username" class="control-label col-xs-4">Имя пользователя:</label>
        <div class="col-xs-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" required="required" name="username" pattern="[A-Za-z]{5,}">
            </div>
            <span class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div class="form-group has-feedback">
        <label for="password" class="control-label col-xs-4">Пароль:</label>
        <div class="col-xs-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-wrench"></i></span>
                <input type="password" class="form-control" required="required" name="password">
            </div>
            <span class="glyphicon form-control-feedback"></span>
        </div>
    </div>
    <div class="form-group has-feedback">
        <div class="col-xs-offset-4 col-xs-8">
            <button class="btn btn-primary" id="btn_auth">Авторизоваться</button>
        </div>
    </div>
</form>

<script src="src/js/auth.js"></script>