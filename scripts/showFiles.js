$('#showFilesButton').click(function() {
    $.ajax({
        url: 'get_files.php',
        type: 'GET',
        data: { folder: 'upload' },
        dataType: 'json',
        success: function(response) {
            var fileList = $('#fileList');
            fileList.empty();
            for (var i = 0; i < response.files.length; i++) {
                fileList.append('<li>' + response.files[i] + '</li>');
            }
            $('.files').css('display', 'block');
        },
        error: function() {
            console.error('Ошибка при получении списка файлов.');
        }
    });
});