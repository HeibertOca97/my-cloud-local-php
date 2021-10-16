<?php

<<<<<<< HEAD
include "./layouts/app.php";
=======
$appRoute = "./public/index.php";

if(file_exists($appRoute)){
    require_once $appRoute;
}else{
    print "<p>Problema al encontrar su directorio <strong>public/</strong> revice su archivo <strong>index.php</strong></p>";
}
>>>>>>> b2cee04 (Arreglo de enrutamiento, nueva estructura de ficheros, modulos terminados.)
