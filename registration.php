<?php require_once "pages/header.php"; ?>
<?php require_once "db.php"; ?>
    <h1>Регистрация</h1>

    <form action="registration.php" method="post">
        <label>
            <input class="username" name="username" placeholder="Имя пользователя"/>
        </label>
        <label>
            <input class="password" name="password" type="password" placeholder="Пароль"/>
        </label>
        <button class="regBtn" type="submit">Зарегистрироваться</button>
    </form>
<label>
    <a href="authentication.php" class="link">Войти</a>
</label>

<?php
$link = mysqli_connect('localhost', 'root', '', 'guestbookdb');

if (!$link) {
    die('<p style="color:#ffb200">' .mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"]
        ? trim(mysqli_real_escape_string($link, $_POST["username"]))
        : "";
    $password = $_POST["password"]
        ? trim(mysqli_real_escape_string($link, $_POST["password"]))
        : "";

    if (!empty($username) && !empty($password)) {
        checkReg($username, $password);
        header("Location: http://"
            .$_SERVER['HTTP_HOST']
            .dirname($_SERVER['PHP_SELF'])
            ."./authentication.php");
        exit;
    }
}
?>
<?php require_once "pages/footer.php"; ?>
