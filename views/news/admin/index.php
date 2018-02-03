<?php


foreach ($result as $news) {
    ?>
    <h1>
        <a href='view?id=<?= $news["id"] ?>'><?= $news["title"] ?></a>
    </h1>
    <a href='/news/web/?r=News/edit&id=<?= $news["id"] ?>'>Edit Post</a>
    <a href='/news/web/?r=News/delete.php?id=<?= $news["id"] ?>'>Delete Post</a>
    <a href='/news/web/?r=News/move?id=<?= $news["id"] ?>&dir=up'>↑</a>
    <a href='/news/web/?r=News/move?id=<?= $news["id"] ?>&dir=down'>↓</a> <br>


<?php } ?><br>
<a href='/news/web/?r=News/create.php'>Post erstellen</a>
