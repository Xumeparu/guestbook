<?php require_once "pages/header.php"; ?>
<?php require_once "pages/navigation.php"; ?>
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

<?php
$link = mysqli_connect('localhost', 'root', '', 'guestbookdb');

if (!$link) {
    die('<p style="color:#9a1f1f">' .mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"]
        ? trim(mysqli_real_escape_string($link, $_POST["username"]))
        : "";
    $password = $_POST["password"]
        ? trim(mysqli_real_escape_string($link, $_POST["password"]))
        : "";

    if (!empty($username) && !empty($password)) {
        $link->query("INSERT INTO users(username, password) VALUES ('$username', '$password')");
        if ($link->affected_rows == 1) {
            echo "<p class='success'>Регистрация успешна</p>";
        } else {
            echo "<p class='error'>Ты мышь, получается, раз не смог зарегистрироваться" . $link->error . "</p>";
        }
    }
}
?>
<?php require_once "pages/footer.php"; ?>
