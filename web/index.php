<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/layout/main.php';
session_start();

(new \Config\Core\Router())->run();