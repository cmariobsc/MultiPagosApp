<?= migas(["contacto"=>"Contacto"]) ?>
<div class="pagina">

<div class="row">
    <div class="col s12">
        <?= tBack($contView[1]["titulo"]) ?>
    </div>
    <div class="col s12 l6">
        <?= $contView[1]["texto"] ?>
    </div>
</div>

    <div class="row">
        <div class="col s12 m5 push-m7">
            <div class="row">
                <div class="col s1">
                    <i class="material-icons tColor1">contact_phone</i>
                </div>
                <div class="col s11 tColor6 letra2">
                    Llámanos
                </div>
                <div class="col s12 mAbajo10">
                    <strong class="tColor6">PBX:</strong> (593) 4 34-371-1620 <br />
                    <strong class="tColor6">Ext.:</strong> 1004, 1003, 1505, 1502
                </div>
            </div>
            <div class="row">
                <div class="col s1">
                    <i class="material-icons tColor1">email</i>
                </div>
                <div class="col s11 tColor6 letra2">
                    Escríbenos
                </div>
                <div class="col s12 mAbajo10">
                    <strong class="tColor6">Servicios varios:</strong> servicios.actech@enfriando.com<br />
                    <strong class="tColor6">Gerencia:</strong> paul.correa@enfriando.com<br />
                    <strong class="tColor6">Maxiclima S.A.:</strong> servicios.maxiclima@enfriando.com<br />
                    <strong class="tColor6">Ductaire S.A.:</strong> servicios.ductaire@enfriando.com<br />
                    <strong class="tColor6">ACTECH CORP:</strong> actech.international@enfriando.com<br />
                </div>
            </div>
            <div class="row">
                <div class="col s1">
                    <img src="<?= E_URL ?>public/img/skype.svg" <?= altImg("") ?> style="width: 1.5em;" />
                </div>
                <div class="col s11 tColor6 letra2">
                    Contacto a través de Skype
                </div>
                <div class="col s12 mAbajo10">
                    <p>Para contactarnos a través de Skype puede hacer uso de los correos antes mostrados</p>
                </div>
            </div>
            <div class="row">
                <div class="col s1">
                    <i class="material-icons tColor1">location_on</i>
                </div>
                <div class="col s11 tColor6 letra2">
                    Visítanos
                </div>
                <div class="col s12 mAbajo10">
                    <p>Para ver nuestros almacenes <a href="<?= E_URL ?>almacenes" >Click Aquí</a></p>
                </div>
            </div>
        </div>
        <div class="col s12 m7 pull-m5">
            <form method="post" id="formContacto" action="contacto">
                <div class="row">
                    <?= mat_input('Nombre <span class="tColor7">*</span>', "nombre", ["envoltura"=>"col s12 m11", "required"=>"1"]) ?>
                    <?= mat_input('Su correo electrónico <span class="tColor7">*</span>', "correo", ["type"=>"email", "required"=>"1", "envoltura"=>"col s12 m11"]) ?>
                    <?= mat_input('Asunto <span class="tColor7">*</span>', "asunto", ["envoltura"=>"col s12 m11", "required"=>"1"]) ?>

                    <?= mat_textarea('Mensaje <span class="tColor7">*</span>', "mensaje", "col s12 m11") ?>
                    <div class="col s12 m11">
                        <span class="tColor7" >*</span> <i><small>Campos obligatorios</small></i>
                    </div>
                    <div class="col s12 cen eInt3" ><div class="noDiv bCen" id="chachacha" ></div></div>
                    <div class="col s12 m11 der">
                        <button type="submit" class="waves-effect waves-light btn">Enviar mensaje</button>
                    </div>
                </div>
                <input type="hidden" name="a" value="enviar" />
            </form>
        </div>
    </div>
</div>
<div id="CONTACTO_mapa"></div>
<script type="text/javascript">
    $(function () {
        $('#enviarFormulario').click(function () {
            if($('#g-recaptcha-response').val().length > 0)
            {
                $('#form1').submit();
            }
            else
            {
                M.toast({html: 'Resuelva el Captcha !'});
            }
        })
    })
</script>

