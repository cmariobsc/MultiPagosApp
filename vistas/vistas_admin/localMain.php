<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 13/4/2019
 * Time: 12:06
 * Proyecto: mn_coffee.eqadoor.com
 */
echo migas(["Textos personalizados"]);
//echo tBack("Textos por Idiomas");
?>
<form method="post" action="<?= E_URL . E_VIEW ?>?a=local&id=<?= $vistaId ?>">
    <div class="card blue-grey lighten-4">
        <div class="card-content">
            <div class="card-title">Ingrese el nuevo texto</div>
            <div class="eInt3">
                <div class="row">
                    <?php
                    echo mat_select("Vista", "vista", Vista::vistasPublicas(), "col s12 l3", isset_get("id"));
                    echo mat_input("Referencia", "ref", ["envoltura"=>"col s12 l9"]);
                    foreach($_SESSION['idiomas'] as $idim)
                    {
                        echo mat_input(ucfirst(nombreIdioma($idim)), "ref_".$idim, ["envoltura"=>"col s12"]);
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="card-action der"><button type="submit" class="btn">Crear</button></div>
        <input type="hidden" name="a" value="local" />
    </div>
</form>
<div class="mAA10 eInt3">
<?= $tablaIdim ?>
</div>



