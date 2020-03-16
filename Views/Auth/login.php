<h1>Авторизуйтесь</h1>
<form method='post' action='/user/login'>
    <?php if($errors): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errors; ?>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" id="login" placeholder="Логин" name="login" value="" require>
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" id="password" placeholder="Пароль" name="password" require>
    </div>
    <button type="submit" class="btn btn-primary">Отправка</button>
</form>