<?php

use Controller\NewsController;

require_once __DIR__ . '/../../vendor/autoload.php';

if( !empty( $_GET['id'] ) && !empty( $_GET['dir'] ) ) {
  $id = $_GET['id'];
} else {
  echo 'wronggg';
  exit;
}
$news = new NewsController;
$news->move( $_GET['id'], $_GET['dir'] );
echo "Post moved<br>";
header( 'Location: /news/web/views/admin/' );
?>
