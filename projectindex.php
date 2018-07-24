<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<?php
include_once ('project/projectModel.php');
include_once ('project/projectController.php');
include_once ('project/projectView.php');
$model=new projectModel();
$controller=new projectController($model);
$view=new projectView($model,__DIR__ ."\Project\\template");
$view->run();
?>
</body>
</html>