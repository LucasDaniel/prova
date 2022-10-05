<script>

jQuery(function ($) {

    $('#bt-salvar-tipo').on('click', function() { 
        setTimeout(() => {
            $.ajax({
                type: "POST",
                url: "",
                data: dados,
                success: function (msg) {
                    console.log(msg);
                },
                error: function (request, status, error) {
                    alert(error);
                },complete: function(data) {
                    alert(data);
                }
            });
        }, 500);
    });

})

</script>