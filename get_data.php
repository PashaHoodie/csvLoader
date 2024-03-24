<?php
error_reporting(0);
require "dbconn.php";
// Запрос для получения данных из таблицы department.
$sql1 = "SELECT * FROM department";
$stmt1 = $conn->query($sql1);
$data1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

// Запрос для получения данных из таблицы users
$sql2 = "SELECT * FROM users";
$stmt2 = $conn->query($sql2);
$data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

// Формирование HTML-кода для отображения данных таблицы department
$html1 = "<h2>Таблица департаментов</h2>";
$html1 .= "<table>";
$html1 .= "<tr>";
foreach ($data1[0] as $column => $value) {
    $html1 .= "<th>$column</th>";
}
$html1 .= "</tr>";
    foreach ($data1 as $row) {
    $html1 .= "<tr>";
        foreach ($row as $value) {
        $html1 .= "<td>$value</td>";
        }
        $html1 .= "</tr>";
    }
    $html1 .= "</table>";

// Формирование HTML-кода для отображения данных таблицы users
$html2 = "<h2>Таблица пользователей</h2>";
$html2 .= "<table>";
$html2 .= "<tr>";
foreach ($data2[0] as $column => $value) {
    $html2 .= "<th>$column</th>";
}
$html2 .= "</tr>";
    foreach ($data2 as $row) {
    $html2 .= "<tr>";
        foreach ($row as $value) {
        $html2 .= "<td>$value</td>";
        }
        $html2 .= "</tr>";
    }
    $html2 .= "</table>";

// Объединение HTML-кода для обоих таблиц
$html = $html1 . $html2;

// Вывод HTML-кода
echo $html;
