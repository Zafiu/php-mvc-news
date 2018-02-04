<form method="post">
    <input type="text" name="title" value="<?= $news['title'] ?>"/><br>
    <textarea name="text"><?= $news['text'] ?></textarea>
    <input type="hidden" name="id" value="<?= $news['id'] ?>"/><br>
    <input type="hidden" name="userId" value="<?= $news['fk_userId'] ?>"/><br>
    <input type="submit">
</form>