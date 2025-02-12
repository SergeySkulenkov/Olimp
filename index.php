
<?php

include('run.php');
$controller->checkLogin();
//$model->simpleQuery("UPDATE olimp SET title ='new title' WHERE id = 1");
//$model->createOimp("Новая олимпиада", "132124",1);
$res=$model->getOlimpList();
$pageName = $controller->getPageName();
$deleteFileError = "";
$page = $controller->getPageContent();
if($controller->checkUploadUserFile()){
    header("Location:".INDEX_PAGE."?id=".$_GET['id']);

}
if(isset($_GET['del'])){
    if($controller->checkUserDeleteAnswer()){
        header("Location:".INDEX_PAGE."?id=".$_GET['id']);
    }else{

        $deleteFileError = "<p class = 'deleteFileError'>Не удалось удалить файл, свяжитесь с администратором сервера.</p><script>\$(document).ready(function(){\$('.deleteFileError').delay(3000).hide(300);});</script>";
    }

}
$message = "";
if(isset($_GET['id']) && $_GET['id']== 4){
  if(isset($_POST['username'])){
    $res = $model->updateUser($_SESSION['user']['id'], $_POST['login'], $_POST['username'], $_POST['email'],$_POST['password']);
    if($res === true){
      $message =  "<p class = 'update'>Данные обновлены.</p><script>\$(document).ready(function(){\$('.update').delay(3000).hide(300);});</script>";
      $page = $controller->getPageContent();
    }else{
      $message =  "<p class = 'updateError'>".$res."</p><script>\$(document).ready(function(){\$('.updateError').delay(3000).hide(300);});</script>";
    }
  }
  $login = $page['content']['login'];
  $username = $page['content']['username'];
  $email = $page['content']['email'];

}
if(isset($_GET['id']) && $_GET['id']== 3){
  $num = $_SESSION['question'];
  if(isset($_POST['question_'.$num])){
    
    $res = $model->checkUserQuestion($_SESSION['user']['id'],$_POST['question_'.$num] , 1);
    if($res === true){
      $message =  "<p class = 'update'>Вопрос отправлен.</p><script>\$(document).ready(function(){\$('.update').delay(3000).hide(300);});</script>";
      $page = $controller->getPageContent();
    }else{
      $message =  "<p class = 'updateError'>Ошибка!</p><script>\$(document).ready(function(){\$('.updateError').delay(3000).hide(300);});</script>";
    }
    unset($_SESSION['question']);
  }

}







?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?= $page['title'];?></title>
    <link rel="stylesheet" href="css/main.css">
    <script type="text/javascript" src="js/jquery-3.7.1.min.js">

    </script>
  </head>
  <body>
    <div class="left">
      <a href="/"><img class="logo" src="images/logoWhite.png" alt=""></a>
      <?php $controller->printMenu(); ?>

    </div>
    <div class="right">
      <div class="topBlock">

      </div>
      <div class="container">
        <div class="contentBlock">
          <div class="titleBlock">
            <?= $pageName ?>

          </div>
          <div class="mainContent">
              <?php 
             if(isset($_GET['id']) && $_GET['id']==2){
              if($_SESSION['user']['role'] == "super_admin"){
                include(ROOT_PATH.'tmpl/admin_answer.php');
              }else{
                 include(ROOT_PATH.'tmpl/answer.php');
              }
             }else if(isset($_GET['id']) && $_GET['id']==4){
                include(ROOT_PATH.'tmpl/profile.php');
             }else if(isset($_GET['id']) && $_GET['id']==3){
              include(ROOT_PATH.'tmpl/question.php');
             }else if(isset($_GET['id']) && $_GET['id']==5){
              include(ROOT_PATH.'tmpl/otvet.php');
             }else{
                if($_SESSION['user']['role'] == "super_admin"){
                 ?>
                  <div class = "adminEdit">
                    <a href="<?=INDEX_PAGE;?>?edit=1&id=1">Редактировать</a>
                  </div>
                 <?php 
                }
                if(isset($_GET['edit']) && $_GET['edit']==1){
                  ?>
                    <form action="<?=INDEX_PAGE;?>?edit=1&id=1" method="post">
                      <textarea name="editor" id="editor"><?=$page['content']?></textarea>
                      <input type="submit" value="Сохранить">
                    </form>
                  <?php

                }else{
                  echo  $page['content'];
                }
                 
             }
              ?>

          </div>

        </div>

      </div>

    </div>

  </body>
</html>
