<?php

$appRoute = "./public/index.php";

if(file_exists($appRoute)){
    require_once $appRoute;
}else{
    print "<p>Problema al encontrar su directorio <strong>public/</strong> revice su archivo <strong>index.php</strong></p>";
}

