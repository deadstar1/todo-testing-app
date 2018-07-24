<?php
abstract class defaultController
{
    //parse the params here
protected $model;
public function __construct($model)
{
    $this->model=$model;
    $this->parser();
}
 protected  function parser(){

     if($_GET['action']=='index'){
         $this->model->index();
     }
     elseif ($_GET['action']=='findbyid' /*&& isset($_GET['id'])*/){
         $this->setModelProperties();
         $this->model->findById();
     }
     elseif($_GET['action']=='update' /*&& $this->isPOSTParamsExistAndNotNull()==true && isset($_GET['id'])*/){
             $this->setModelProperties();
             $this->model->update();
     }
     elseif ($_GET['action']=='delete' /*&& isset($_GET['id'])*/){
         print_r('delete will call');
         $this->setModelProperties();
         $this->model->delete();
     }
     elseif ($_GET['action']=='insert' /*&& $this->isPOSTParamsExistAndNotNull()==true*/){
             $this->setModelProperties();
             $this->model->insert();
         echo 'new controller called!';
     }
     elseif ($_GET['action']=='new'){
         $this->model->new();

     }
     elseif ($_GET['action']=='tomodify' /*&& isset($_GET['id'])*/){
         $this->setModelProperties();
         $this->model->toModify();
     }
/*     elseif ($this->isPOSTParamsExistAndNotNull()==false || !isset($_GET['id'])){
         $this->model->errorHandling();
     }*/
     else{
         $this->model->index();
     }
 }
abstract protected function setModelProperties();
}