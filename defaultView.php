<?php
//todo: modify the templates for validations(client side validation)
require_once('pretty_print.php');
abstract class defaultView
{
    protected $model;
    protected $records;
    protected $template;
    protected $nullParameters;
    protected $ID;
    protected $pretty_print;
    protected $rowCount;
    public function __construct($model,$template)
    {
        $this->pretty_print=new pretty_print();
        $this->model=$model;
        $this->template=$template;// should now location of the template,not only the path
        $this->nullParameters=array(null);
    }
    protected function index()
    {
        require_once ($this->template . "\index.php");

    }
    protected function findByID()
    {
        require_once ($this->template . "\\findByID.php");
    }
    public function run()
    {
        $method=$this->model->output['template'];
        //for debugging
        /*$this->pretty_print->output($this->model->output);*/
        $this->nullParameters=$this->model->output['nullParameters'];
        $this->records=$this->model->output['records']; // if this empty, parameters are not completed!
        $this->rowCount=$this->model->output['rowCount'];
        $this->ID=!empty($this->records[0])?array_keys($this->records[0])[0]:null;//get the key of an array
        if(!method_exists($this,$method)){
            $method='index';
        }
        $this->$method();

    }
    protected function toModify()
    {
        require_once ($this->template ."\\toModify.php");
    }
    protected function new()
    {
        require_once ($this->template ."\\new.php");
    }
    protected function update(){
       /* header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) ."?action=index");*/
    }
    protected function delete(){
        echo 'redirect';
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) ."?action=index");
    }
    protected function insert(){
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) ."?action=index&andshit");
    }
    protected function errorHandling(){
        require_once ($this->template ."\\errorHandling.php");
    }
}