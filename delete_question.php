<?php 
include('run.php');
echo $_GET['id'];
$model->delUserQuestion($_GET['id'], $_SESSION['user']['id']);
?>