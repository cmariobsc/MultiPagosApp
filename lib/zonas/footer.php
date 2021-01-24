<footer id="pie" class="fColor3">
    <div class="pagina">
        <?php
        switch($userTipo)
        {
            case 1:
            case 2:
                // es master o admin
                include(E_LIB . DS . "zonas" . DS . "footerAdmin.php");
                break;
            case 3:
            case 5:
                // Es usuario común
                break;
            default:
                // Es público
                include(E_LIB . DS . "zonas" . DS . "footerPublico.php");
        }
        ?>
        <div class="divider"></div>
        <div class="cen mAA10">
            <p>Copyright &copy; 2002 - <?= date("Y") ?> &nbsp; <?= strtoupper(E_DOMINIO) ?></p>
            <p><small>Con la asistencia de: <a class="oscuro" href="http://latinex.us" target="_blank">www.latinex.us</a></small></p>
        </div>
    </div>
</footer>

