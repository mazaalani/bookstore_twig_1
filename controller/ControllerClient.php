<?php

RequirePage::requireModel('CRUD');
RequirePage::requireModel('ModelClient');
RequirePage::requireModel('ModelCity');
RequirePage::requireLibrary('Validation');

class ControllerClient{

 public function index(){

   $client = new ModelClient;
   $select = $client->select();

   return Twig::render('client-list.html', [
                                         'clients' => $select
                                       ]);

 }

 public function insert(){

//Validation
   $val = new Validation;
//$val->name('email')->value($email)->pattern('email')->required();

   $val->name('clientName')->value($_POST['clientName'])->pattern('words')->max(45)->min(2)->required();
   $val->name('clientAddress')->value($_POST['clientAddress'])->pattern('address')->max(45);
   $val->name('clientEmail')->value($_POST['clientEmail'])->pattern('email')->max(45);
   $val->name('clientPhone')->value($_POST['clientPhone'])->pattern('tel')->max(20);
   $val->name('clientCityId')->value($_POST['clientCityId'])->required()->pattern('int');

   if($val->isSuccess()){
    // echo "Validation ok!";
     //insert
     $client = new ModelClient;
     $insert = $client->insert($_POST);
     RequirePage::redirect('client/list');
   }else{
     //echo "Validation error!";
      $city = new ModelCity;
      $selectCities = $city->select("cityName", "ASC");

      $errors = $val->getErrors();


      return Twig::render('client.html', ['action' => 'Saisir',
                                            'cities' => $selectCities,
                                            'client' => $_POST,
                                            'errors' => $errors
                                          ]);

   }




 }

 public function update(){

    $client = new ModelClient;
   if(isset($_POST['delete'])){
//delete
    $delete = $client->delete($_POST['clientId']);
   }else{
//update
     $update = $client->update($_POST);

   }
      RequirePage::redirect('client/list');

 }


 public function selectClient($id){
   $client = new ModelClient;
   if($select = $client->selectId($id)){

     $city = new ModelCity;
     $selectCities = $city->select("cityName", "ASC");

     return Twig::render('client.html', ['action' => 'Mettre à jour',
                                           'cities' => $selectCities,
                                           'client' => $select
                                         ]);

   }else{
     RequirePage::redirect('home/error');
   }

 }

}




 ?>
