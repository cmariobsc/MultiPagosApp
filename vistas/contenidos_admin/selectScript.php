<script type="text/javascript" src="public/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#soloIdioma').click(function (e) {
            var idiomas = '<?= E_LANG_OTROS ?>'.split(',');
            if (!$(this).is(':checked')) {
                $(this).prop('value', 0);
                for (item of idiomas) {
                    $('#bloquesIdioma_' + item).fadeIn();
                }
            } else {
                $(this).prop('value', 1);
                for (item of idiomas) {
                    $('#bloquesIdioma_' + item).fadeOut();
                }
            }
        });
    });
</script>