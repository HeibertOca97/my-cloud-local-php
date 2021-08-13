<?php namespace Models;

Class UploadFile{

  protected $path = __DIR__;
  protected $uploads_dir_image = "./assets/image";
  protected $uploads_dir_doc = "assets/document";
  protected $ext_img = array("jpeg", "jpg", "png");
  protected $ext_doc = array("pdf");
  private $max_size_img = 2097152;

  private static function createDir($routeFile){
    if(!file_exists($routeFile)){
      mkdir($routeFile, 0777, true);
    }
  }

  protected static function validatedAttr($inputname, $filename){
    if(isset($inputname)){
      return $inputname["$filename"];
    }
  }

  public static function getToObjectFile($object){
    $newObject = [
      "name" => self::validatedAttr($object, "name"),
      "size" => self::validatedAttr($object, "size"),
      "tmp" => self::validatedAttr($object, "tmp_name"),
      "type" => self::validatedAttr($object, "type"),
    ];
    return json_decode(json_encode($newObject));
  }

  private static function getFileType($filename){
    $convertarray = explode('.',$filename); 
    $lastArray = end($convertarray);
    $ext = strtolower($lastArray);
    return $ext;
  }

  public function UploadImage($file){
    //Verificar - Crear directorio
    self::createDir($this->uploads_dir_image);
    //Convertir archivo y obtener un objeto
    $obj = self::getToObjectFile($file);
    //Extraer el tipo del archivo
    $filetype = self::getFileType($obj->name);
    $errors=[];
    
    if(in_array($filetype, $this->ext_img) === false){
      $errors[] = "Extensión no permitida, elija un archivo JPG, JPEG o PNG";
    }
    
    if($obj->size > $this->max_size_img) {
      $errors[] ='El tamaño del archivo debe ser de aproximadamente 2 MB';
    }

    if(empty($errors) == true){
      move_uploaded_file($obj->tmp, "$this->uploads_dir_image/$obj->name");
      return [
        "success" => true,
        "message" => "Archivo almacenado",
        "status" => 200
      ];
    }else{
      $err="";
      if(count($errors) > 1){
        $err = $errors[0].". ".$errors[1]. ".";
      }else{
        $err = $errors[0];
      }
      return [
        "success" => false,
        "message" => $err,
        "status" => 400
      ];
    }

  }
}
