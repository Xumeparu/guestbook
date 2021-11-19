<?php
require_once "db.php";

$message_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

global $link;
$link->query("DELETE FROM messages WHERE id='$message_id' AND user_id='$user_id'");

header("Location: http://"
    .$_SERVER['HTTP_HOST']
    .dirname($_SERVER['PHP_SELF'])
    ."./guestbook.php");
exit;
