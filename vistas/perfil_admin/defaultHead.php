<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: www.emprende.la
 * Date: 12/9/2019
 * Time: 01:55
 * Proyecto: lx_redmultipago.com
 */

use Cartalyst\Sentinel\Native\Facades\Sentinel;

$userSistema = Sentinel::findById($usuario->id);

if($userSistema)
{
    $userSistemaExt = UserExt::getUser($usuario->id);
    $userSistemaContacto = $userSistemaExt->empresa_contacto();
}