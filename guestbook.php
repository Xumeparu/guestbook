<?php require_once "pages/header.php"; ?>
<?php require_once "pages/navigation.php"; ?>
<?php require_once "db.php"; ?>
    <h1>Гостевая книга</h1>

    <form action="guestbook.php" method="post">
        <p class='success'><?=getUsername(); ?></p>
        <label>
            <input class="message" name="message" placeholder="Сообщение"/>
        </label>
        <button class="submitBtn" type="submit">Отправить</button>
    </form>

    <ul>
        <?php
        foreach (getMessages() as $message_item) {
            ?><li>
                <?=$message_item["username"]?>:
                <?=$message_item["message_text"]?>,
                <?=$message_item["send_date"]?>
            </li><?php
        }
        ?>
    </ul>

<?php
global $link;

if (isset($_POST["message"])) {
    $message = $_POST["message"]
        ? trim(mysqli_real_escape_string($link, $_POST["message"]))
        : "";

    if (!empty($message)) {
        sendMessage($message);
    }
}
?>
<?php require_once "pages/footer.php"; ?>