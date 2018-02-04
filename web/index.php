<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/layout/main.php';
$config = require(__DIR__ . '/../config/config.php');

(new \Config\Core\Router($config))->run();