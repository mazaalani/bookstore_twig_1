<?php

class ControllerHome{

  public function index(){


  return Twig::render('home.html', ['pageTitle' => 'Accueil']);


  }

  public function error(){

  return Twig::render('error.html', ['' => '']);


  }
}


 ?>
