<?php
session_start();
include('config.php');
include(INCLUDE_PATH."model.class.php");
include(INCLUDE_PATH."user.class.php");
include(INCLUDE_PATH."controller.class.php");
$model =new Model;
$controller = new Controller($model);

?>
