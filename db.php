<?php
session_start();

try {
    $conn = new PDO('mysql:host=localhost;dbname=guestbookdb', 'root', '');
} catch(PDOException $error) {
    die('<p class="error">' . $error->getMessage() . '</p>');
}

function checkAuth($username, $password) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->execute(["username" => $username]);

    $row = $stmt->fetch(PDO::FETCH_LAZY);

    if ($row["password"] === md5($password)) {
        $_SESSION['user_id'] = $row["id"];
    }
}

function checkReg($username, $password) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO users(username, password) VALUES (:username, md5(:password))");
    $stmt->execute(["username" => $username, "password" => $password]);
}

function getUsername() {
    global $conn;

    $stmt = $conn->prepare("SELECT username FROM users WHERE id='$_SESSION[user_id]'");
    $stmt->execute(["id" => $_SESSION["user_id"]]);

    $row = $stmt->fetch(PDO::FETCH_LAZY);

    return $row["username"];
}

function sendMessage($message) {
    global $conn;

    $sql = "INSERT INTO messages (user_id, message_text) VALUES (:user_id, :message_text)";
    $params = [
        ":user_id" => $_SESSION["user_id"],
        ":message_text" => $message
    ];
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
}

function getMessages(): array {
    global $conn;

    $sql = "SELECT messages.id as message_id, users.id as user_id, users.username, messages.message_text, messages.send_date
                FROM messages INNER JOIN users
                ON messages.user_id = users.id ORDER BY messages.send_date";
    $messages = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    return array_reverse($messages);
}

function checkIsLogged(): string {
    return isset($_SESSION['user_id']);
}

function getCurrentUserId() {
    return $_SESSION['user_id'];
}

function putMouse($mousename, $is_mouse) {
    global $conn;

    $sql = "INSERT INTO mice (mousename, is_mouse) VALUES (:mousename, :is_mouse)";
    $params = [
        ":mousename" => $mousename,
        ":is_mouse" => $is_mouse
    ];
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
}
