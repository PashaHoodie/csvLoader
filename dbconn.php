<?php
//Соединение с базой данных обернули в try/catch на случай возникновения ошибок
//данный файл будем подключать везде где будут встречаться запросы к бд при помощи require_once()
$host = "localhost";
$db_name = "b1";
$username = "root";
$password = "";
try {
    $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
} catch (PDOException $exception){
    echo $exception->getMessage();
}

