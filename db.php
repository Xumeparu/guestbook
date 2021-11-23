<?php
session_start();

//$link = mysqli_connect('localhost', 'root', '', 'guestbookdb');
$link = mysqli_connect('localhost', 'debian-sys-maint', 'YUOULJpihCP0s1xY', 'guestbookdb');

if (!$link) {
    die('<p class="error">' .mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');
}

function checkAuth($username, $password) {
    global $link;
    $result = mysqli_query($link,"SELECT id, password FROM users WHERE username='$username'");
    $row = mysqli_fetch_row($result);

    if ($row[1] === md5($password)) {
        $_SESSION['user_id'] = $row[0];
        echo "<p class='success'>Добро пожаловать</p>";
    } else {
        echo "<p class='error'>Ты мышь, получается, раз не смог войти в профиль " . mysqli_error($link) . "</p>";
    }
}

function checkReg($username, $password) {
    global $link;
    $link->query("INSERT INTO users(username, password) VALUES ('$username', md5('$password'))");

    if ($link->affected_rows == 1) {
        echo "<p class='success'>Регистрация успешна</p>";
    } else {
        echo "<p class='error'>Ты мышь, получается, раз не смог зарегистрироваться " . $link->error . "</p>";
    }
}

function getUsername() {
    global $link;

    $result = mysqli_query($link,"SELECT username FROM users WHERE id='$_SESSION[user_id]'");
    $row = mysqli_fetch_row($result);

    return $row[0];
}

function sendMessage($message) {
    global $link;
    $link->query("INSERT INTO messages(user_id, message_text) VALUES ('$_SESSION[user_id]', '$message')");
}

function getMessages() {
    global $link;
    $messages = [];

    $result = mysqli_query($link, "SELECT messages.id, users.id, users.username, messages.message_text, messages.send_date 
                                         FROM messages INNER JOIN users 
                                         ON messages.user_id = users.id ORDER BY messages.send_date");
    while ($row = mysqli_fetch_row($result)) {
        $messages[] = [
            "id" => $row[0],
            "user_id" => $row[1],
            "username" => $row[2],
            "message_text" => $row[3],
            "send_date" => $row[4]
        ];
    }

    return array_reverse($messages);
}

function checkIsLogged(): string {
    return isset($_SESSION['user_id']);
}

function getCurrentUserId() {
    return $_SESSION['user_id'];
}
