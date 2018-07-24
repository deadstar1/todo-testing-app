<?php

require_once (__DIR__ . '\..\defaultController.php');
class userController extends defaultController
{
    protected function setModelProperties()
    {
        $this->model->name=isset($_POST['name'])?$_POST['name']:null;
        $this->model->userName=isset($_POST['username'])?$_POST['username']:null;
        $this->model->password=isset($_POST['password'])?$_POST['password']:null;
        $this->model->status=isset($_POST['status'])?$_POST['status']:null;
        $this->model->userID=(isset($_GET['id'])?(string)$_GET['id']:null);
    }
}