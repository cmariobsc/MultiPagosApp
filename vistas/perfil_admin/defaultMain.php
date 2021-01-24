<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 12/9/2019
 * Time: 01:22
 * Proyecto: lx_redmultipago.com
 */
?>
<div class="row">
    <div class="col s12">
        <form method="post" >
            <div class="card">
                <div class="card-content">
                    <div class="cen">
                        <img class="circle" style="max-width:120px;" src="<?= UserExt::carpeta() . $userSistemaExt->avatar() ?>"/>
                        <h4><?= $userSistemaExt->nombre_completo() ?></h4>
                    </div>
                    <div class="card-title">Mis datos personales</div>
                    <div class="eInt10 cen fColor7">Por el momento, sólo la contraseña será cambiada</div>
                    <div class="eInt3">
                        <?php
                        echo '<div class="row">';
                        echo mat_input("Nombre(s)", "miNombre", ["readonly"=>"", "envoltura"=>"col s12 l6", "required"=>"", "value"=>$userSistema->first_name]);
                        echo mat_input("Apellido(s)", "miApellido", ["readonly"=>"", "envoltura"=>"col s12 l6", "required"=>"", "value"=>$userSistema->last_name]);
                        echo mat_input("Contraseña", "miPass", ["envoltura"=>"col s12 l6", "type"=>"password"]);
                        echo mat_input("Repetir Contraseña", "miPass2", ["envoltura"=>"col s12 l6", "type"=>"password"]);
                        //echo mat_input("Teléfono Móvil", "miTelefono1", ["envoltura"=>"col s12 l4", "value"=>$userSistemaExt->telefono]);
                        //echo mat_input("Teléfono fijo", "miTelefono2", ["envoltura"=>"col s12 l4", "value"=>$userSistemaExt->telefono2]);
                        //echo mat_input("E-Mail", "miCorreo", ["envoltura"=>"col s12 l4", "required"=>"", "value"=>$userSistemaContacto->correo]);
                        //echo mat_file("Mi foto", "miFoto");
                        echo '</div>';
                        ?>
                    </div>
                </div>
                <div class="card-action der"><button type="submit" class="btn">Actualizar</button></div>
            </div>
            <input type="hidden" name="a" value="update" />
        </form>
    </div>
</div>
