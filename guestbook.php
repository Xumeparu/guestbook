<?php require_once "pages/header.php"; ?>
<?php require_once "pages/navigation.php"; ?>
    <h1>Гостевая книга</h1>

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
$link = mysqli_connect('localhost', 'root', '', 'guestbookdb');

if (!$link) {
    die('<p style="color:#9a1f1f">' .mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');
}

$result = mysqli_query($link, "SELECT * FROM messages;");

echo '<ul>';
while ($row = mysqli_fetch_row($result)) {
    echo "<li>{$row[1]}: {$row[2]}, {$row[3]}</li>";
}
echo '</ul>';
?>
<?php require_once "pages/footer.php"; ?>