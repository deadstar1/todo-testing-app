<?php
require_once (__DIR__ . '\..\defaultModel.php');
class userModel extends defaultModel
{
    public $name;
    public $userName;
    public $password;
    public $status;
    public $userID;
    public function index($query="select * from users where status='active'")
    {
        parent::index($query);
    }
    public function findById()
    {
        if(!empty($this->userID)){
            $this->parameters=array(':userID'=>$this->userID);
            $this->query='SELECT * from users WHERE  userID=:userID';
            $this->todoRecords=parent::$crud->dbQuery($this->query,$this->parameters);
            parent::fromModelToView('findById');
        }
        else{
            $message=array('userID');
            $this->output['nullParameters']=$message;
        }
    }
    public function update()
    {
        if($this->isPropertiesNull()==true||empty($this->userID)){
            if(empty($this->userID)){
                array_push($this->nullParameters,'userID');
            }
            $this->output['nullParameters']=$this->nullParameters;
            $this->output['template']='errorHandling';
        }
        else {
            $this->parameters = array(
                ':userID' => $this->userID,
                ':name' => $this->name,
                ':userName' => $this->userName,
                ':password' => $this->password,
                ':status' => $this->status
            );
            $this->query = "UPDATE users set Name=:name,
            Username=:userName,
            Password=:password,
            status=:status 
            WHERE UserID=:userID";
            $this->todoRecords = parent::$crud->dbQuery($this->query, $this->parameters);
            // no template dude
            parent::fromModelToView('update');
            var_dump($this->output);
        }
    }
    public function delete()
    {
        if(!empty($this->userID)) {
            print_r('delete is called in model');
            //todo:delete does not work
            $this->parameters = array(':userID' => $this->userID);
            $this->query = "UPDATE users set status='deleted' WHERE UserID=:userID";
            parent::$crud->dbQuery($this->query, $this->parameters);
            $this->query = "UPDATE todos set deleted=1 WHERE UserID=:userID";
            $this->todoRecords = parent::$crud->dbQuery($this->query, $this->parameters);
            //no template in the view
            parent::fromModelToView('delete');
        }
        else{
            $message=array('UserID');
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
            ':fullName'=>$this->name,
            ':userName'=>$this->userName,
            ':password'=>$this->password,
            ':status'=>$this->status
        );
        $this->query="INSERT INTO users(userID,name,userName,password,status) 
          VALUES 
          (UUID_SHORT(),:fullName,:userName,:password,:status)";
        $this->todoRecords=parent::$crud->dbQuery($this->query,$this->parameters);
        parent::fromModelToView('insert');
        }
    }
    //non-doers
    public function new()
    {
        $this->parameters=array(':todoID'=>$this->userID);
        $this->query='show COLUMNS FROM users where FIELD IN("name","username","password")';
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
        if($this->name==''){
            array_push($this->nullParameters,'name');
        }
        if($this->userName==''){
            array_push($this->nullParameters,'userName');
        }
        if($this->status==''){
            array_push($this->nullParameters,'status');
        }
        if($this->password==''){
            array_push($this->nullParameters,'password');
        }
        if(!empty($this->nullParameters[1])){//the property $this->nullParameters holds the null parameters. if this parameter not null it means there are incomplete declared parameters above.
            return true;
        }
        else{
            return false;
        }
    }
}