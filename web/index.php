<?php
session_start();
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/layout/main.php';

(new \Config\Core\Router())->run();