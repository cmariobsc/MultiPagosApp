<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.latinex.us
 * Date: 21/7/2019
 * Time: 8:32
 * Proyecto: lx_multipagos.eqadoor.com
 */

$listaServicios = EmpServicios::where("segmento_id", 19)->pluck("nombre", "id")->toArray();
