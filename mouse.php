<?php require_once "pages/header.php"; ?>
<?php require_once "pages/navigation.php"; ?>
<?php require_once "db.php"; ?>
    <h1>Мышь?</h1>
    <form action="mouse.php" method="post">
        <label>
            Введите мышь
            <input class="mousename" name="mousename" placeholder="Введите мышь"/>
        </label>
        <label>
            Это мышь?
            <input type="checkbox" name="is_mouse" value="1"/>
        </label>
        <button class="mouseBtn" type="submit">Отправить мышь</button>
    </form>
<?php
global $conn;

if (isset($_POST["mousename"]) && isset($_POST["is_mouse"])) {
    $mousename = $_POST["mousename"]
        ? trim($_POST["mousename"])
        : "";
    $is_mouse = $_POST["is_mouse"]
        ? trim($_POST["is_mouse"])
        : "";

    $mousename = htmlspecialchars($mousename, ENT_HTML5);
    $is_mouse = htmlspecialchars($is_mouse, ENT_HTML5);

    if (!empty($mousename) && !empty($is_mouse)) {
        putMouse($mousename, $is_mouse);
        var_dump("Мы забираем вашу мышь");
        exit;
    }
}
?>
<?php require_once "pages/footer.php"; ?>