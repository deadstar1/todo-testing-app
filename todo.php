<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
include_once('Todo/todoModel.php');
include_once('Todo/todoController.php');
include_once('Todo/todoView.php');
$model=new todoModel();
$controller=new todoController($model);
$view=new todoView($model,__DIR__ ."\Templates");
$view->run();
?>
</body>
</html>