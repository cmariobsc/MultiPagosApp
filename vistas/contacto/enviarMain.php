<?php

echo migas(["contacto"=>"Contacto"]);

if ($mal === 0) {
    echo salioBien();
} else {
    echo salioMal($mal, 1);
}

