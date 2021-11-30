<?php
require_once "db.php";

$message_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

global $conn;

$stmt = $conn->prepare("DELETE FROM messages WHERE id=:id AND user_id=:user_id");
$stmt->execute(["id" => $message_id, "user_id" => $user_id]);

header("Location: http://"
    .$_SERVER['HTTP_HOST']
    .dirname($_SERVER['PHP_SELF'])
    ."./guestbook.php");
exit;
