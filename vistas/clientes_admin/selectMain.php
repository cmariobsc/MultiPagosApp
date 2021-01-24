<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 10/4/2019
 * Time: 10:11
 * Proyecto: lx_cotizador.eqadoor.com
 */
echo migas(["clientes_admin"=>"Clientes", $cliente->nombre]);
echo tBack("Cliente seleccionado");
?>

<div class="row">
    <div class="col s12 l6">
        <form method="post" id="form1" enctype="multipart/form-data">
            <div class="card">
                <div class="card-content">
                    <div class="card-title">Cliente: <?= $cliente->nombre ?></div>
                    <div class="eInt3">
                        <div class="row">
                            <div class="col s12">
                                <div class="row">
                                    <?php
                                    echo mat_input("Nombre de la empresa cliente", "empresaNombre", ["required"=>"", "value"=>"$cliente->nombre"]);

                                    echo '<div class="col s11 offset-s1 l3">';
                                    echo mat_radio("RUC", "rucTipo", "R", "", "with-gap",$radioR);
                                    echo mat_radio("Cédula", "rucTipo", "C", "", "with-gap",$radioC);
                                    echo mat_radio("Pasaporte", "rucTipo", "P", "", "with-gap",$radioP);
                                    echo '</div>';
                                    echo mat_input("No. de Identidad", "empresaRuc", ["envoltura"=>"col s12 l9", "value"=>$clienteDatos->ruc]);

                                    echo mat_textarea("Notas", "empresaNotas", "", $clienteDatos->notas);
                                    ?>
                                </div>
                            </div>

                            <div class="col s12 l6">
                                <fieldset>
                                    <legend>CRÉDITO</legend>
                                    <div class="row">
                                        <?= mat_input("Crédito", "empresaCredito", ["envoltura"=>"col s10 offset-s1", "value"=>$siCredito]) ?>
                                        <div class="col s12 cen notas">
                                            Sólo números y punto (.) como separador decimal
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s10 offset-s1">
                                            <?= $eTipo ?>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <div class="col s12 l6 cen">
                                <fieldset class="eInt3" >
                                    <legend>Activación</legend>
                                    <div class="mAA10">
                                        <div>&nbsp;</div>
                                        <?= mat_check("Activar", "empresaEstado", "1", "empresaEstado", "filled-in", $cliente->estado) ?>
                                        <aside class="eInt notas">Si desactiva este cliente, toda la información relativa al mismo dejará de ser mostrada.</aside>
                                        <div>&nbsp;</div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-action der">
                    <button type="submit" class="btn">Actualizar Cliente</button>
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $cliente->id ?>" />
            <input type="hidden" name="a" value="update" />
        </form>
    </div>
    <div class="col s12 l6">
        <div class="card">
            <div class="card-content">
                <div class="card-title">Agencias</div>
                <div class="eInt3">
                    <ul class="collapsible" id="listaSedes">
                        <?php
                        if($sucursales && $cantidadSedes > 0)
                        {
                            foreach ($sucursales as $sucursal)
                            {
                                if ($sucursal->matriz == 1) {
                                    $sMatrizVal = 1;
                                    $sMatrizCheck = 1;
                                } else {
                                    $sMatrizVal = 0;
                                    $sMatrizCheck = "";
                                }

                                ?>
                                <li>
                                    <div class="collapsible-header"><i class="material-icons">keyboard_arrow_right</i><?= $sucursal->nombre ?></div>
                                    <div class="collapsible-body ftColor7">
                                        <form method="post" >
                                            <div class="row">
                                                <?php
                                                echo mat_input("Nombre de la agencia", "sedeNombre", ["id"=>uniqid(), "value"=>$sucursal->nombre, "required"=>""]);
                                                echo $b->blk(mat_check("Es casa matriz", "sedematriz", $sMatrizVal, uniqid(), "with-gap", $sucursal->matriz), ["class"=>"col s10 offset-s2"]);
                                                echo mat_textarea("Actividad", "sedeActividad", "", $sucursal->actividad, uniqid(), "materialize-textarea", 255);
                                                echo mat_textarea("Dirección", "sedeDireccion", "", $sucursal->direccion, uniqid(), "materialize-textarea", 255);
                                                echo mat_textarea("Notas", "sedeNotas", "", $sucursal->notas, uniqid());
                                                ?>
                                                <div class="col s12 der">
                                                    <button type="submit" class="btn" >Actualizar Agencia</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="a" value="updateSede" />
                                            <input type="hidden" name="sedeId" value="<?= $sucursal->id ?>" />
                                        </form>

                                        <ul class="collapsible">
                                            <?php
                                            $contactos = $sucursal->contactos();
                                            foreach($contactos as $contactoId => $contactoVal)
                                            {
                                                $conSede = EmpContacto::find($contactoId);

                                                echo '<li>';
                                                echo '<div class="collapsible-header"><i class="material-icons">account_circle</i>' . $conSede->nombre . " " . $conSede->apellido . '</div>';
                                                echo '<div class="collapsible-body">';
                                                echo '<form method="post" >';
                                                echo '<div class="card blue-grey lighten-4">';
                                                echo '<div class="card-content">';
                                                //echo '<div class="card-title">Contacto: ' . $conSede->nombre . '</div>';
                                                echo '<div class="row">';
                                                echo mat_input("Nombre(s)", "contactoNombre", ["envoltura"=>"col s12", "required"=>"", "value"=>$conSede->nombre, "id"=>uniqid()]);
                                                echo mat_input("Apellido(s)", "contactoApellido", ["envoltura"=>"col s12", "value"=>$conSede->apellido, "id"=>uniqid()]);
                                                echo mat_input("Teléfono fijo", "contactoTelefonoFijo", ["envoltura"=>"col s12 l6", "value"=>$conSede->telefono_fijo, "id"=>uniqid()]);
                                                echo mat_input("Teléfono Móvil", "contactoTelefonoMovil", ["envoltura"=>"col s12 l6", "value"=>$conSede->telefono_movil, "id"=>uniqid()]);
                                                echo mat_input("E-Mail", "contactoCorreo", ["envoltura"=>"col s12", "required"=>"", "value"=>$conSede->correo, "id"=>uniqid()]);
                                                echo mat_input("Cargo", "contactoCargo", ["envoltura"=>"col s12", "value"=>$conSede->cargo, "id"=>uniqid()]);
                                                echo mat_select("Tipo de usuario", "contactoRol", $listaRoles, "col s12", $conSede->rol()->id);
                                                echo mat_textarea("Notas", "contactoNotas", "", $conSede->notas, uniqid());
                                                echo $b->blk('<button type="submit" class="btn" >Actualizar Contacto</button>', ["class"=>"input-field col s12 der"]);
                                                if(check_acceso_rol(["Master","Administrador"])):
                                                    //echo $b->blk('<a href="'.E_URL.E_VIEW.'/resetPass?id='.$conSede->user()->id.'" class="btn claro" onclick="return confirma(\'Realmente desea generar una nueva contraseña para este usuario\')" ><i class="material-icons left">delete</i> Reset Contraseña</a>', ["class"=>"input-field col s12 der"]);
                                                    echo $b->blk('<a href="' . E_URL . 'clientes_admin/resetPass?id=' . $conSede->user()->id . '" onclick="return confirma(\'¿ Confirma el reset de la contraseña ?\')" class="waves-effect waves-light red accent-3 btn" id="resetPass"><i class="material-icons left">delete</i> Reset contraseña</a>', ["class"=>"input-field col s12 der"]);
                                                endif;
                                                echo '</div>';
                                                echo '</div>';
                                                echo '</div>';
                                                echo '<input type="hidden" name="a" value="updateContacto" />';
                                                echo '<input type="hidden" name="contactoId" value="'.$conSede->id.'" />';
                                                echo '<input type="hidden" name="userId" value="'.$conSede->user()->id.'" />';
                                                echo '</form>';
                                                echo '</div>';
                                                echo '</li>';
                                            }
                                            ?>
                                        </ul>

                                        <div id="contactos<?= $sucursal->id ?>"></div>


                                        <div class="cen">
                                            <button type="button" class="btn" onclick="addContacto(<?= $sucursal->id ?>, true)">Añadir Contacto</button>
                                        </div>



                                    </div>
                                </li>
                                <?php
                            }
                        }
                        else
                        {
                            echo '<li>';
                            echo '<div class="collapsible-header"><i class="material-icons">keyboard_arrow_right</i>Este cliente no tiene sucursales</div>';
                            echo '<div class="collapsible-body"><span>-</span></div>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                    <div class="mAA10">
                        <div class="row" id="nuevasSedes"></div>
                    </div>
                </div>
                <div class="eInt3 mAA10 cen">
                    <button class="btn waves-effect waves-light" onclick="addSede({entorno: 'col s12', destino: 'nuevasSedes', formulario:2})" type="button" >Nueva Agencia</button>
                </div>
            </div>
        </div>
    </div>
</div>
