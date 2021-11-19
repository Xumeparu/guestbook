<?php require_once "db.php"; ?>
<nav>
    <ul class="top-menu">
        <li><a href="../index.php">Домашняя страница</a></li>
        <?php
        if(checkIsLogged()) {
            echo '<li><a href="../guestbook.php">Гостевая книга</a></li>';
        } else {
            echo '';
        }
        ?>
        <?php
        if(checkIsLogged()) {
            echo '<li><a href="../logout.php">Выйти</a></li>';
        } else {
            echo '<li><a href="../authentication.php">Аутентификация</a></li>';
        }
        ?>
    </ul>
</nav>