<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
/*include_once('Project/projectModel.php');
include_once('Project/projectController.php');
include_once('Project/projectView.php');
$model=new projectModel();
$controller=new projectController($model);
$view=new  projectView($model,__DIR__ ."\Templates");
$view->run();*/

include_once ('user/userModel.php');
include_once ('user/userController.php');
include_once ('user/userView.php');
$model=new userModel();
$controller=new userController($model);
$view=new userView($model,__DIR__ ."\Templates");
$view->run();

/*include_once('Todo/todoModel.php');
include_once('Todo/todoController.php');
include_once('Todo/todoView.php');
$model=new todoModel();
$controller=new todoController($model);
$view=new todoView($model,__DIR__ ."\Templates");
$view->run();*/
?>
</body>
</html>