<?php require_once "pages/header.php"; ?>
<?php require_once "pages/navigation.php"; ?>
<h1>Регистрация</h1>

<form action="registration.php" method="post">
    <label>
        <input class="username" name="username" placeholder="Имя пользователя"/>
    </label>
    <label>
        <input class="password" name="message" placeholder="Пароль"/>
    </label>
    <button class="regBtn" type="submit">Зарегистрироваться</button>
</form>

<?php require_once "pages/footer.php"; ?>
