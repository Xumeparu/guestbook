<?php require_once "pages/header.php"; ?>
<?php require_once "pages/navigation.php"; ?>
<?php require_once "db.php"; ?>
    <h1>Домашняя страница</h1>
    <p class="success">
        <?php
        if(checkIsLogged()) {
            echo "Здравствуйте, " . getUsername();
        } else {
            echo '';
        }
        ?>
    </p>
    <a href="/"><img class="homePage" src="public/images/hi.png" alt="This is logo"></a>
<?php require_once "mouse.php"; ?>
<?php require_once "pages/footer.php"; ?>

