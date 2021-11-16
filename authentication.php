<?php require_once "pages/header.php"; ?>
<?php require_once "pages/navigation.php"; ?>
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
        $result = mysqli_query($link,"SELECT password FROM users WHERE username='$username'");
        $row = mysqli_fetch_row($result);

        if ($row[0] === md5($password)) {
            if ($link->affected_rows == 1) {
                echo "<p class='success'>Добро пожаловать</p>";
            } else {
                echo "<p class='error'>Ты мышь, получается, раз не смог войти в профиль " . $link->error . "</p>";
            }
        }
    }
}
?>
<?php require_once "pages/footer.php"; ?>