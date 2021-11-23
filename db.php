<?php
session_start();

try {
    $conn = new PDO('mysql:host=localhost;dbname=guestbookdb', 'debian-sys-maint', 'YUOULJpihCP0s1xY');
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

function getMessages() {
//    global $conn;
//    $messages = [];
//
//    $sql = "SELECT messages.id, users.id, users.username, messages.message_text, messages.send_date
//                FROM messages INNER JOIN users
//                ON messages.user_id = users.id ORDER BY messages.send_date";
//    $messages = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
//    foreach ($messages as )
//
//    $stmt = $conn->prepare($sql);
//    while ($row = mysqli_fetch_row($result)) {
//        $messages[] = [
//            "id" => $row[0],
//            "user_id" => $row[1],
//            "username" => $row[2],
//            "message_text" => $row[3],
//            "send_date" => $row[4]
//        ];
//    }
//
//    return array_reverse($messages);
}

function checkIsLogged(): string {
    return isset($_SESSION['user_id']);
}

function getCurrentUserId() {
    return $_SESSION['user_id'];
}
