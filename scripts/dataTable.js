$(document).ready(function() {
    // Функция для загрузки данных с помощью AJAX
    function loadData() {
        $.ajax({
            url: "get_data.php", // Путь к серверному скрипту, который будет загружать данные
            method: "GET",
            success: function(response) {
                // Отображение данных на странице
                $("#data").html(response);
            }
        });
    }

    // Обработчик события нажатия на кнопку "Загрузить данные с таблиц"
    $("#loadDataButton").click(function() {
        loadData();
    });
});