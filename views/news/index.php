<?php

foreach ($result as $news) {
    echo '<h1><a href="/php-mvc-news/web/?r=News/view&id=' . $news["id"] . '"</a>' . $news["title"] . '</h1>';
}