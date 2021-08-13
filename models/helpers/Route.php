<?php namespace Models\helpers;

trait Route{
  public static function redirect($filename, $params=null){
    header("location: ./{$filename}.php?res=$params");
  }
}