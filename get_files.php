<?php
$files = scandir('upload');
$files = array_diff($files, array('.', '..')); // Удаляем . и .. из списка файлов
$response = ['files' => array_values($files)];
// Возвращение данных в формате JSON
header('Content-Type: application/json');
echo json_encode($response);
?>