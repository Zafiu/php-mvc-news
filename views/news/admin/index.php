<?php

/**
 * @var $result array News
 * @var $userName string Vorname des Users
 * @var $userSurname string Nachname des Users
 */ ?>
<body>
<div>
    <h1>Hallo <?= $userName . ' ' . $userSurname ?></h1>
</div>

<?php

/**
 * @var $result array
 */
foreach ($result as $news) {
    ?>
    <h1>
        <a href='/php-mvc-news/web/?r=News/view&id=<?= $news["id"] ?>'><?= $news["title"] ?></a>
    </h1>
    <a href='/php-mvc-news/web/?r=News/edit&id=<?= $news["id"] ?>'>Edit Post</a>
    <a href='/php-mvc-news/web/?r=News/delete&id=<?= $news["id"] ?>'>Delete Post</a>

<?php } ?><br>
<a href='/php-mvc-news/web?r=News/create'>Post erstellen</a>
</body>
</html>