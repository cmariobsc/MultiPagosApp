<?php
/**
 * Creator: Eric Larrea
 * E-mail: elapez@gmail.com
 * From: grupomodo.com
 * Date: 3/9/2018
 * Time: 0:19
 */
$_SESSION['mensajeSistema'] = "Ha salido correctamente";
header("Location:" . E_URL . E_INDEX . "?out=1");
exit();