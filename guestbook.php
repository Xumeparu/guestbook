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

    <div class="messages">
        <ul>
            <?php
            foreach (getMessages() as $message_item) {
                ?><li>
                <label>
                    <label class="user"><?=$message_item["username"]?>:</label>
                    <?=$message_item["message_text"]?>,
                    <?=$message_item["send_date"]?>
                </label>
                <?php
                if(getCurrentUserId() === $message_item["user_id"]) {
                    ?>
                    <a class="deleteBtn" href="deleteMessage.php?id=<?=$message_item["id"]?>">x</a>
                    <?php
                }
                ?></li>
                <?php
            }
            ?>
        </ul>
    </div>
<?php require_once "pages/footer.php"; ?>