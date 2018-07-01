$(function () {

    $('#formContato').validator();

    $('#formContato').on('submit', function (e) {
        if (!e.isDefaultPrevented()) {
            var url = "envio.php";

            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (data)
                {
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;

                    var alertBox = '<div class="alert ' + messageAlert + ' alert-dismissable" id="msg"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + messageText + '</div>';
                    if (messageAlert && messageText) {
                        $('#formContato').find('.mensagem').html(alertBox);
                        $('#formContato')[0].reset();
                    }
                }
            });
            return false;
        }
    })
});