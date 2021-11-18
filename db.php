<?php
session_start();

$link = mysqli_connect('localhost', 'root', '', 'guestbookdb');

if (!$link) {
    die('<p class="error">' .mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');
}

//try {
//    $db = new PDO("mysql:host=localhost;dbname=guestbookdb", "root", "");
//} catch (PDOException $e) {
//    echo "<p class='error'>Error!: " . $e->getMessage() . "</p>";
//    die();
//}
//
//function addUsername() {
//    global $db;
//    $username = 'Не мышь';
//    $password = md5('немышь');
//    $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
//    $params = [
//        ":username" => $username,
//        ":password" => $password
//    ];
//    $stmt = $db->prepare($query);
//    $stmt->execute($params);
//}

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
