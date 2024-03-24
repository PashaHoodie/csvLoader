<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>b1 test</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php $message = isset($_GET['message']) ? $_GET['message'] : '';?>
<div class="container d-flex flex-column justify-content-center align-items-center ">
    <h1 class="display-1 text-center">Загрузите csv-файл</h1><br>
    <?php if (!empty($message)): ?>
        <div class ="alert alert-<?php echo (str_contains($message, 'Ошибка')) ? 'danger' : 'success' ?>" id="alert"><?php echo $message; ?></div>
    <?php endif; ?>
    <form action="load.php" method="post" class="col-6" enctype="multipart/form-data">
        <div class="mb-3 ">
            <label class="col-form-label" for="passed_file">Загрузите файл <i>формата <b>.csv</b></i></label>
                <input type="file" name="passed_file" class="form-control" id="passed_file">
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
    <button id="showFilesButton" class="btn btn-primary col-6 mt-5">Показать загруженные файлы</button>
    <div class="files col-6"  style="display: none">
        <hr>
        <ul id="fileList"></ul>
    </div>
    <button id="loadDataButton" class="btn btn-primary col-6 mt-2">Показать таблицы загруженных файлов</button>
    <div id="data"></div>
</div>
<script src="scripts/showFiles.js"></script>
<script src="scripts/dataTable.js"></script>
</body>
</html>