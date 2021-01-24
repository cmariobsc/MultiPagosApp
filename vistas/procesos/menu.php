<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 21/7/2019
 * Time: 8:10
 * Proyecto: lx_multipagos.eqadoor.com
 */
?>
<div class="col s12">
    <div class="card">
        <div class="card-content">
            <div class="card-title">Procesos principales</div>
            <a href="<?= E_URL . E_INDEX ?>" ><div class="wtodo eInt3"><i class="material-icons left">home</i>Inicio</div></a>
            <a href="<?= E_URL ?>recargas" ><div class="wtodo eInt3"><i class="material-icons left">mobile_friendly</i>Recargas</div></a>
            <a href="<?= E_URL ?>giros_venezuela" ><div class="wtodo eInt3"><i class="material-icons left">local_atm</i>Venezuela</div></a>
            <a href="<?= E_URL ?>recaudaciones" ><div class="wtodo eInt3"><i class="material-icons left">local_atm</i>Recaudaciones</div></a>
            <!-- <a href="<?= E_URL ?>giros" ><div class="wtodo eInt3"><i class="material-icons left">monetization_on</i>Giros</div></a> -->
            <a href="<?= E_URL ?>bancos" ><div class="wtodo eInt3"><i class="material-icons left">account_balance</i>Bancarias</div></a>
            <a href="<?= E_URL ?>consultas" ><div class="wtodo eInt3"><i class="material-icons left">report</i>Consultas</div></a>
            <?php if(check_acceso_rol(5, false)): ?>
            <a href="<?= E_URL ?>reversos" ><div class="wtodo eInt3"><i class="material-icons left">rotate_left</i>Reversos</div></a>
            <?php endif ?>
        </div>
    </div>
</div>


