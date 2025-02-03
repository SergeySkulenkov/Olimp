<?php 
include('run.php');
if(isset($_SESSION['user']['login'])){
    if($model->delUserQuestion($_GET['id'], $_SESSION['user']['id'])){
        echo "true";
    }else{
        echo "error";
    }
}else{
    echo 'Error';
}

?>