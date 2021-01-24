<script type="text/javascript">
    $(function() {
        $('#registrar').click(function(){
            $('#formLogin').slideUp("slow");
            $('#formRegistro').slideDown("slow");
        });

//        $('#registro-submit').click(function(){
//            $('#formPreregistro').submit();
//        });

        $('#login-submit').click(function(){
            $('#formIngreso').submit();
        });
    });
</script>