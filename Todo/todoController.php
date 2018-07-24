<?php

require_once (__DIR__ . '\..\defaultController.php');
class todoController extends defaultController
{
    protected function setModelProperties()
    {
        $this->model->startDate=isset($_POST['startDate'])?$_POST['startDate']:null;
        $this->model->endDate=isset($_POST['endDate'])?$_POST['endDate']:null;
        $this->model->description=isset($_POST['description'])?$_POST['description']:null;
        $this->model->title=isset($_POST['title'])?$_POST['title']:null;
        $this->model->status=isset($_POST['status'])?$_POST['status']:null;
        $this->model->dependeeTodoID=isset($_POST['dependeeTodoID'])?$_POST['dependeeTodoID']:null;
        $this->model->tagID=isset($_POST['tagID'])?$_POST['tagID']:null;
        $this->model->projectID=isset($_POST['projectID'])?$_POST['projectID']:null;
        $this->model->userID=isset($_POST['userID'])?$_POST['userID']:null;
        $this->model->deleted=isset($_POST['deleted'])?$_POST['deleted']:null;
        $this->model->todoID=isset($_GET['id'])?(string)$_GET['id']:null;
    }
}