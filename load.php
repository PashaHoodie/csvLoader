<?php
require "dbconn.php";
$uploadDirectory = 'upload/';
if(!empty($_FILES['passed_file']['tmp_name']))
{
    // Ожидаемый паттерн столбцов пользователей
    $expectedColumns1 = ["XML_ID", "LAST_NAME", "NAME", "SECOND_NAME", "DEPARTMENT",
        "WORK_POSITION", "EMAIL", "MOBILE_PHONE", "PHONE", "LOGIN", "PASSWORD"];
    // Ожидаемый паттерн столбцов департаментов
    $expectedColumns2 = ["XML_ID", "PARENT_XML_ID", "NAME_DEPARTMENT"];
    $handle = fopen($_FILES['passed_file']['tmp_name'], 'r');
    $uploadedFile = $uploadDirectory . basename($_FILES['passed_file']['name']);

    //exit();
    // Игнорируем первую строку, если она содержит заголовки столбцов
    $firstRow = fgetcsv($handle, 0, ";");
    if ($firstRow === $expectedColumns1) {
        move_uploaded_file($_FILES['passed_file']['tmp_name'], $uploadedFile);
        // Перебираем строки CSV-файла
        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            // Выполняем вставку данных в соответствующую таблицу базы данных с использованием подготовленного запроса
            $stmt = $conn->prepare("INSERT INTO users (XML_ID, LAST_NAME, NAME, SECOND_NAME, DEPARTMENT, WORK_POSITION, EMAIL, MOBILE_PHONE, PHONE, LOGIN, PASSWORD) 
                VALUES (:xml_id, :last_name, :name, :second_name, :department, :work_position, :email, :mobile_phone, :phone, :login, :password)");
            $xml_id = htmlspecialchars(strip_tags($xml_id));
            $last_name = htmlspecialchars(strip_tags($last_name));
            $name = htmlspecialchars(strip_tags($name));
            $second_name = htmlspecialchars(strip_tags($second_name));
            $department = htmlspecialchars(strip_tags($department));
            $work_position = htmlspecialchars(strip_tags($work_position));
            $email = htmlspecialchars(strip_tags($email));
            $mobile_phone = htmlspecialchars(strip_tags($mobile_phone));
            $phone = htmlspecialchars(strip_tags($phone));
            $login = htmlspecialchars(strip_tags($login));
            $password = htmlspecialchars(strip_tags($password));
            // Привязываем значения параметров к подготовленному запросу
            $stmt->bindValue(':xml_id', $data[0]);
            $stmt->bindValue(':last_name', $data[1]);
            $stmt->bindValue(':name', $data[2]);
            $stmt->bindValue(':second_name', $data[3]);
            $stmt->bindValue(':department', $data[4]);
            $stmt->bindValue(':work_position', $data[5]);
            $stmt->bindValue(':email', $data[6]);
            $stmt->bindValue(':mobile_phone', $data[7]);
            $stmt->bindValue(':phone', $data[8]);
            $stmt->bindValue(':login', $data[9]);
            $stmt->bindValue(':password', $data[10]);

            $stmt->execute();
        }
        $message = 'Данные успешно загружены!';
        header('Location: index.php?message=' . urlencode($message));
        exit; // Добавляем exit для прекращения выполнения скрипта после перенаправления
    }
    else if ($firstRow === $expectedColumns2) {
        move_uploaded_file($_FILES['passed_file']['tmp_name'], $uploadedFile);
        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            $stmt = $conn->prepare("INSERT INTO department (XML_ID, PARENT_XML_ID, NAME_DEPARTMENT) 
                VALUES (:xml_id, :parent_xml_id, :name_department)");
            $xml_id = htmlspecialchars(strip_tags($xml_id));
            $parent_xml_id = htmlspecialchars(strip_tags($parent_xml_id));
            $name_department = htmlspecialchars(strip_tags($name_department));
            // Привязываем значения параметров к подготовленному запросу
            $stmt->bindValue(':xml_id', $data[0]);
            $stmt->bindValue(':parent_xml_id', $data[1]);
            $stmt->bindValue(':name_department', $data[2]);
            $stmt->execute();
        }
        $message = 'Данные успешно загружены!';
        header('Location: index.php?message=' . urlencode($message));
        exit; // Добавляем exit для прекращения выполнения скрипта после перенаправления
    }
    else{
        $message = 'Ошибка! Загружен некорректный файл.';
        header('Location: index.php?message=' . urlencode($message));
        exit;
    }
    fclose($handle);
}
else {
    $message = 'Ошибка! Загрузите файл формата csv.';
    header('Location: index.php?message=' . urlencode($message));
    exit;
}



