<?php
session_start();
session_destroy();

header("Location: http://"
    .$_SERVER['HTTP_HOST']
    .dirname($_SERVER['PHP_SELF'])
    ."./authentication.php");
exit;