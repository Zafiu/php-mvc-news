<?php

use Controller\NewsController;

require_once __DIR__ . '/../../vendor/autoload.php';

if( !empty( $_GET['id'] ) ) {
  $id = $_GET['id'];
} else {
  echo 'wronggg';
  exit;
}

$news = new NewsController;
$post = $news->view( $id );
?>

<form method="post">
  <input type="text" name="title" value="<?= $post['title'] ?>"><br>
  <textarea name="text"><?= $post['text'] ?></textarea>
  <input type="submit">
</form>

<?php

if( !empty( $_POST['title'] ) && !empty( $_POST['text'] ) ) {
  $news->edit( $id );
  header( "Refresh:0" );
}
?>
<a href="/news/web/views/admin/">Back</a>