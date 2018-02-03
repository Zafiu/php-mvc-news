<?php

use Controller\NewsController;

require_once __DIR__ . '/../../vendor/autoload.php';
?>

<form method="post">
  <input type="text" name="title"><br>
  <textarea name="text"></textarea>
  <input type="submit">
</form>

<?php
if( !empty( $_POST['title'] ) && !empty( $_POST['text'] ) ) {
  $news = new NewsController;
  if( $news->create() ) {
    echo "Post created<br>";
  } else {
    echo 'Es ist leider etwas schief gelaufen.';
  }
}
?>
<a href="/news/web/views/admin/">Back</a>