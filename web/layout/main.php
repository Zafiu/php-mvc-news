<?php
/**
 * @var $userName string Vorname des Users
 * @var $userSurname string Nachname des Users
 */

if (!empty($_SESSION)) { ?>
    <div>
        <h1>Hallo <?= $_SESSION['username'] ?></h1>
        <a href="/php-mvc-news/web/?r=Login/logout">Logout</a>
    </div>
    <?php
}
?>