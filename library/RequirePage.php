<?php
class RequirePage{

  static function requireModel($page){
    return require_once 'model/'.$page.'.php';

  }

  static function requireLibrary($page){
    return require_once 'library/'.$page.'.php';

  }

  static function redirect($url){
    header("Location: /TP02/Site_v1/$url");
  }

}


 ?>
