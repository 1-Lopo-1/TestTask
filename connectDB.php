<?php
    // Подключение файлов для работы с переменными окружения
    require __DIR__ . '/vendor/autoload.php';

    // Предназначенно для использования переменных окружения
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // Данные для подключения к БД 
    $host = 'localhost';
    $db = 'myprojectdb';
    $user = $_ENV['USER_NAME'];
    $pass = $_ENV['USER_PASS'];

    // Подключение к БД
    $connection = new mysqli($host, $user, $pass, $db);
?>