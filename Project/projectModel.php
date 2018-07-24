<?php
require_once(__DIR__ . '\..\defaultModel.php');
class projectModel extends defaultModel{
    public $projectID;
    public $projectName;
    public $userID;
    public function index($query='select * from projects')
    {
        parent::index($query);
    }

    public function findByID()
    {
        if(!empty($this->projectID)) {
            $this->parameters = array(':projectID' => $this->projectID);
            $this->query = 'SELECT projectName,userID from projects WHERE projectID=:projectID';
            $this->todoRecords = parent::$crud->dbQuery($this->query, $this->parameters);
            parent::fromModelToView('findById');
        }
        else{
            $message=array('projectID');
            $this->output['nullParameters']=$message;
        }
    }

    public function update()
    {
        if($this->isPropertiesNull()==true || empty($this->projectID)){
            if(empty($this->projectID)){
                array_push($this->nullParameters,'projectID');
            }
            $this->output['nullParameters']=$this->nullParameters;
            $this->output['template']='errorHandling';
        }
        else{
            $this->parameters=array(':projectID'=>$this->projectID,
                ':projectName'=>$this->projectName,
                ':userID'=>$this->userID);
            $this->query="UPDATE projects set projectName=:projectName,
          userID=:userID
          WHERE projectID=:projectID";
            $this->todoRecords=parent::$crud->dbQuery($this->query,
                $this->parameters);
            // no template dude
            parent::fromModelToView('update');
        }//execute the database query
    }

    public function delete()
    {
        if(!empty($this->projectID)){
            $this->parameters=array(':projectID'=>$this->projectID);
            $this->query="DELETE FROM projects WHERE projectID=:projectID";
            $this->todoRecords=parent::$crud->dbQuery($this->query,$this->parameters);
            //no template in the view
            /*$this->output=$this->todoRecords+array('template'=>'delete');*/
            parent::fromModelToView('delete');
        }
        else{
            $message=array('projectID');
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
            $this->parameters=array(
                ':projectName'=>$this->projectName,
                ':userID'=>$this->userID);
            $this->query="INSERT INTO projects(projectID,projectName,userID)
VALUES (UUID_SHORT(),:projectName,:userID)";
            $this->todoRecords=parent::$crud->dbQuery($this->query,$this->parameters);
            parent::fromModelToView('insert');
        }
    }

    public function new()
    {
        $this->parameters=array(':todoID'=>$this->projectID);
        $this->query='show COLUMNS FROM projects where FIELD NOT IN("projectid")';
        $this->todoRecords=parent::$crud->dbQuery($this->query,$this->parameters);
        parent::fromModelToView('new');
    }

    public function toModify()
    {
        $this->findById();
        $this->output['template']='tomodify';
    }

    protected function isPropertiesNull()
    {
        if($this->userID==''){
            array_push($this->nullParameters,'userID');
        }
        if($this->projectName==''){
            array_push($this->nullParameters,'projectName');
        }
        if(!empty($this->nullParameters[1])){//the property $this->nullParameters holds the null parameters. if this parameter not null it means there are incomplete declared parameters above.
            return true;
        }
        else{
            return false;
        }
    }
}

