<?php
require_once (__DIR__ . '\..\defaultModel.php');
class todoModel extends defaultModel
{
    public $todoID;
    public $title;
    public $description;
    public $startDate;
    public $endDate;
    public $status;
    public $dependeeTodoID;
    public $projectID;
    public $userID;
    public $deleted;
    public $tagID;
    public function index($query='select * from todos where deleted=0')
    {
        parent::index($query);
    }
    public function findById()
    {
        if(!empty($this->todoID)) {
            $this->parameters = array(':todoID' => $this->todoID);
            $this->query = "SELECT todoID, title, description, startDate, endDate, status, dependeeTodoID, projectID, userID FROM todos  WHERE TodoID=:todoID";
            $this->todoRecords = parent::$crud->dbQuery($this->query, $this->parameters);
            parent::fromModelToView('findById');
        }
        else{
            $message=array('todoID');
            $this->output['nullParameters']=$message;
        }
    }
    public function update()
    {//dependee and tagid are not required!
        if($this->isPropertiesNull()==true || empty($this->todoID)){
            if(empty($this->todoID)){
                array_push($this->nullParameters,'todoID');
            }
            $this->output['nullParameters']=$this->nullParameters;
            $this->output['template']='errorHandling';
        }
        else{
            $this->parameters=array(':title'=>$this->title,
                ':description'=>$this->description,
                ':startDate'=>$this->startDate,
                ':endDate'=>$this->endDate,
                ':status'=>$this->status,
                ':dependeeTodoID'=>$this->dependeeTodoID,
                ':projectID'=>$this->projectID,
                ':userID'=>$this->userID,
                'deleted'=>$this->deleted,
                ':todoID'=>$this->todoID,
                ':tagID'=>$this->tagID);
            //todo:insert here tag-todo ID
            $this->query="UPDATE todos set Title=:title,
          Description=:description,
          StartDate=:startDate,
          EndDate=:endDate,
          Status=:status,
          DependeeTodoID=:dependeeTodoID,
          ProjectID=:projectID,
          UserID=:userID,
          deleted=:deleted,
          TagID=:tagID
          WHERE TodoID=:todoID";
            $this->todoRecords=parent::$crud->dbQuery($this->query,
                $this->parameters);
            // no template dude
            parent::fromModelToView('update');
        }//execute the database query
    }
    public function delete()
    {
        if(!empty($this->todoID)){
            //todo:insert here tag-todo ID
            $this->parameters=array(':todoID'=>$this->todoID);
            $this->query="UPDATE todos set deleted=1 WHERE TodoID=:todoID";
            $this->todoRecords=parent::$crud->dbQuery($this->query,$this->parameters);
            //no template in the view

            /*$this->output=$this->todoRecords+array('template'=>'delete');*/
            parent::fromModelToView('delete');
        }
        else{
            $message=array('todoID');
            $this->output['nullParameters']=$message;

        }

    }
    public function insert()
    {
        if($this->isPropertiesNull()==true){
            $this->output['nullParameters']=$this->nullParameters;
            $this->output['template']='errorHandling';

        }
        else{
            //todo:insert here tag-todo ID
            $this->parameters=array(':title'=>$this->title,
            ':description'=>$this->description,
            ':startDate'=>$this->startDate,
            ':endDate'=>$this->endDate,
            ':status'=>$this->status,
            ':dependeeTodoID'=>$this->dependeeTodoID,
            ':projectID'=>$this->projectID,
            ':userID'=>$this->userID,
            'deleted'=>$this->deleted,
            ':tagID'=>$this->tagID);
            $this->query="INSERT INTO todos(TodoID,Title,description,StartDate,EndDate,status,DependeeTodoID,ProjectID,UserID,deleted,tagID) 
VALUES (UUID_SHORT(),:title,:description,:startDate,:endDate,:status,:dependeeTodoID,:projectID,:userID,:deleted,:tagID)";
            $this->todoRecords=parent::$crud->dbQuery($this->query,$this->parameters);
            parent::fromModelToView('insert');
        }
    }
    //non-doers

    public function new()
    {

        $this->parameters=array(':todoID'=>$this->todoID);
        $this->query='show COLUMNS FROM todos where FIELD NOT IN("todoID","userid")';
        $this->todoRecords=parent::$crud->dbQuery($this->query,$this->parameters);
        parent::fromModelToView('new');
    }
    public function toModify()
    {
        $this->findById();
        $this->output['template']='tomodify';
    }
    protected function isPropertiesNull():bool
    {//check the required parameters. if the parameters you are searching does not exist, the parameters are not required.
        //todo: you may use loop here in checking the properties values,all child class,an array contains properties;but pass by reference is now not supported by latest php!

        if($this->title==''){
            array_push($this->nullParameters,'title');
        }
        if($this->description==''){
            array_push($this->nullParameters,'description');
        }
        if($this->startDate==''){
            array_push($this->nullParameters,'startDate');
        }
        if($this->endDate==''){
            array_push($this->nullParameters,'endDate');
        }
        if($this->status==''){
            array_push($this->nullParameters,'status');
        }
        if($this->projectID==''){
            array_push($this->nullParameters,'projectID');
        }
        if($this->userID==''){
            array_push($this->nullParameters,'userID');
        }
        if($this->deleted==''){
            array_push($this->nullParameters,'delete');
        }
        if(!empty($this->nullParameters[1])){//the property $this->nullParameters holds the null parameters. if this parameter not null it means there are incomplete declared parameters above.
            return true;
        }
        else{
            return false;
        }
    }



}