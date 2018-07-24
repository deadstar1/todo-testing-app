<?php
include_once ('Crud.php');
abstract class defaultModel
{
//create a new intance of Crud class
//todo: create a singleton
public static $crud; //public to same cpu loads https://stackoverflow.com/questions/151969/when-to-use-self-over-this
    //
public $output;
protected $query;
protected $parameters; //is to bind parameters
protected $todoRecords;
protected $nullParameters;
protected $arrayOfProperties;
public function __construct()
{
    self::$crud=new Crud();
    $this->output=array(
        'records'=>array(null),
        'rowCount'=>0,
        'columnCount'=>0,
        'nullParameters'=>array(null),
        'template'=>'');
    $this->nullParameters=array(null);
}
public function index($query){
    $this->parameters=array(':table'=>'');
    $this->query=$query;
    $this->todoRecords=self::$crud->dbQuery($this->query,$this->parameters);
    $this->fromModelToView('index');
} //for view's index method
abstract public function findByID(); //for view's findByID method. this method used for view single record
abstract public function update(); //no view for this
abstract public function delete();// no view for this
abstract public function insert();
//non-doer
abstract public function new();
abstract public function toModify(); //or view. show a view which has text input tags and  its corresponding datum ready to modify.
/*abstract protected function outputQueryResult();*/
abstract protected function isPropertiesNull(); //not null throwns an errors
protected function fromModelToView($view){
    $this->output['records']=$this->todoRecords['record'];
    $this->output['rowCount']=$this->todoRecords['rowcount'];
    $this->output['columnCount']=$this->todoRecords['columnCount'];
    $this->output['template']=$view;
}
}