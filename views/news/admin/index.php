<?php
/**
 * @var $result array News
 */ ?>
<body>
<?php
/**
 * @var $result array
 */
foreach ($result as $news) {
    ?>
    <h1>
        <a href='/php-mvc-news/web/?r=news/view&id=<?= $news["id"] ?>'><?= $news["title"] ?></a>
    </h1>
    <a href='/php-mvc-news/web/?r=news/edit&id=<?= $news["id"] ?>'>Edit Post</a>
    <a href='/php-mvc-news/web/?r=news/delete&id=<?= $news["id"] ?>'>Delete Post</a>

<?php } ?><br>
<a href='/php-mvc-news/web?r=news/create'>Post erstellen</a>
</body>
</html>