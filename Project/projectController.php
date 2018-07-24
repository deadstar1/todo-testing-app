<?php
require_once(__DIR__ . '\..\defaultController.php');
class projectController extends defaultController{
    protected function setModelProperties()
    {
        $this->model->projectID=isset($_GET['id'])?$_GET['id']:null;
        $this->model->projectName=isset($_POST['projectName'])?$_POST['projectName']:null;
        $this->model->userID=isset($_POST['userID'])?$_POST['userID']:null;
    }

}