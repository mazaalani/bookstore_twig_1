<?php
require_once __DIR__.'/library/RequirePage.php';
require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/library/Twig.php';

$url = isset($_SERVER['PATH_INFO']) ? explode ('/', ltrim($_SERVER['PATH_INFO'], '/')) : '/';

print_r($url);

if($url=="/"){
  require_once __DIR__.'/controller/ControllerHome.php';
  $controller = new ControllerHome;
  $controller->index();


}else{
  $requestUrl = $url[0];
  
  $requestUrl = ucfirst($requestUrl);
  $controllerPath = __DIR__.'/controller/Controller'.$requestUrl.'.php';

  /* if(file_exists($controllerPath)){
    require_once $controllerPath;
    $controllerName = 'Controller'.$requestUrl;
    $controller = New $controllerName; */

///[0]client/[1]selectClient/][2]10

 /*    if(isset($url[1])){
      $method = $url[1];
      if(isset($url[2])){
        $value=$url[2];
        $controller->$method($value);
      }else{
        $controller->$method();
      }
    }else{
      $controller->index();
    }

  }else{
    require_once __DIR__.'/controller/ControllerHome.php';
    $controller = new ControllerHome;
    $controller->error();
  } */




}





 ?>
