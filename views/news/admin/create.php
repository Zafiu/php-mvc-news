<form action="/php-mvc-news/web/?r=news/create" method="post">
    <input type="text" name="title" required><br>
    <input type="hidden" name="userId" value="<?= $userId ?>"><br>
    <textarea name="text" required></textarea>
    <input type="submit">
</form>