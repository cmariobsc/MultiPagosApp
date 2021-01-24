<div class="row">
    <div class="col s12 m6 offset-m3">
        <form method="post" id="formIngreso">
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col s6 offset-s3 l12 cen">
                            <a href="<?= E_URL ?>inicio" >
                                <img src="<?= E_URL ?>public/img/logoSitio.png" <?= altImg(E_DOMINIO) ?> />
                            </a>
                        </div>
                    </div>
                    <div class="card-title cen tColor4">
                        <h2 class="flow-text">INICIO DE SESIÓN</h2>
                        <p class="flow-text">Ingresa tus datos para acceder a la plataforma</p>
                    </div>
                    <div class="eInt3">
                        <div class="row">
                            <?= mat_input("Nombre de usuario","correo", ["required"=>""]) ?>
                        </div>
                        <div class="row">
                            <?= mat_input("Contraseña","clave", ["required"=>"", "type"=>"password"]) ?>
                        </div>
                    </div>
                </div>
                <div class="card-action cen">
                    <button type="submit" class="waves-effect waves-light btn-large">Entrar</button>
                </div>
            </div>
            <input type="hidden" name="a" value="login" />
        </form>
    </div>
</div>

