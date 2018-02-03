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
if( $news->delete( $id ) ) {
  echo 'Die News konnte erfolgreich entfernt werden. <a href="/news/web/views/admin/">Back</a>';
} else {
  echo 'Der Post konnte leider nicht entfernt werden.';
}

?>