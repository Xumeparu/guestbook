<?php require_once "pages/header.php"; ?>
<?php require_once "db.php"; ?>
    <h1>Аутентификация</h1>

    <form action="authentication.php" method="post">
        <label>
            <input class="username" name="username" placeholder="Имя пользователя"/>
        </label>
        <label>
            <input class="password" name="password" type="password" placeholder="Пароль"/>
        </label>
        <button class="enterBtn" type="submit">Войти</button>
    </form>
<label>
    <a href="registration.php" class="link">Зарегистрироваться</a>
</label>

<?php
global $link;

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"]
        ? trim(mysqli_real_escape_string($link, $_POST["username"]))
        : "";
    $password = $_POST["password"]
        ? trim(mysqli_real_escape_string($link, $_POST["password"]))
        : "";

    if (!empty($username) && !empty($password)) {
        checkAuth($username, $password);
        header("Location: http://"
            .$_SERVER['HTTP_HOST']
            .dirname($_SERVER['PHP_SELF'])
            ."./index.php");
        exit;
    }
}
?>
<?php require_once "pages/footer.php"; ?>