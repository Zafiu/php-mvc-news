<?php

if (!empty($_SESSION)) { ?>
    <div>
        <h1>Hallo <?= $_SESSION['username'] ?></h1>
        <a href="/php-mvc-news/web/?r=login/logout">Logout</a>
    </div>
    <?php
} else { ?>
    <div>
        <a href="/php-mvc-news/web/?r=login">Login</a>
    </div>
    <?php
}
?>

<div>
    <a href="/php-mvc-news/web/?r=news">Zurück zur Startseite</a>
</div>
