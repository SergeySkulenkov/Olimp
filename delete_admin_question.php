<?php 
include('run.php');
if(isset($_SESSION['user']['login'])){
    if($model->delAdminQ($_GET['id'],)){
        echo "true";
    }else{
        echo "error";
    }
}else{
    echo 'Error';
}

?>