<?php
require_once "./models/UploadFile.php";
require_once "./models/helpers/Route.php";

use Models\UploadFile;
use Models\helpers\Route;


if (isset($_FILES)) {
  $classFile = new UploadFile();
  $response = $classFile->UploadImage($_FILES["image"]);
  Route::redirect("index", $response["message"]);
}else{
  Route::redirect("index", "El dato que intenta almacenar no es un archivo");
}