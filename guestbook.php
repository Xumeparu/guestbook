<?php require_once "pages/header.php"; ?>
<?php require_once "pages/navigation.php"; ?>
    <h1>Guestbook page</h1>

    <form action="guestbook.php" method="post">
        <label>
            <input class="username" name="username" placeholder="Имя"/>
        </label>
        <label>
            <input class="message" name="message" placeholder="Сообщение"/>
        </label>
        <button class="submitBtn" type="submit">Отправить</button>
    </form>

<?php
$db = "db.txt";

if (isset($_POST["username"]) && isset($_POST["message"])) {
    $username_field = $_POST["username"];
    $message_field = $_POST["message"];

    $data = $username_field . ":" . $message_field . "/n";
    file_put_contents($db, $data, FILE_APPEND);
}

$file = file_get_contents($db);
$messages_strings = explode("/n", $file);
$messages_strings = array_reverse($messages_strings);
$messages = [];

foreach ($messages_strings as $message_string) {
    $string = explode(":", $message_string);
    if (count($string) === 1) {
        continue;
    }

    $messages[] = [
        "username" => $string[0],
        "message" => $string[1]
    ];
}
?>

    <ul>
        <?php
        foreach ($messages as $message) {
            ?>
            <li class="user-message">
                <b><?=$message["username"]; ?></b>:
                <?=$message["message"]; ?>
            </li>
            <?php
        }
        ?>
    </ul>
<?php require_once "pages/footer.php"; ?>