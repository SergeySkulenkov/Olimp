
<?php

include('run.php');
$controller->checkLogin();
//$model->simpleQuery("UPDATE olimp SET title ='new title' WHERE id = 1");
//$model->createOimp("Новая олимпиада", "132124",1);
//$res=$model->getOlimpList();
if(isset($_POST['JuryAnswer'])){
  $model->addJuryAnswer($_GET['user'],$_GET['otvet_id'],$_POST['JuryAnswer'],);// ответ на задание
}
if(isset($_GET['delJrc'])){
  $model-> delJuryAnswer($_GET['delJrc']);
}
if(isset($_GET['delAdA'])){
  $model-> delAdminAnswer($_GET['delAdA']);
}
if(isset($_GET['edit']) && $_GET['edit'] == 2){
  $model->updateContent($_POST["editor"]);
}


$pageName = $controller->getPageName();
$deleteFileError = "";
$page = $controller->getPageContent();
if($controller->checkUploadUserFile()){
    header("Location:".INDEX_PAGE."?id=".$_GET['id']);

}
if($controller->checkUploadOlimp()){
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
    <script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                include(ROOT_PATH.'tmpl/jury_answer.php');
              }else{
                 include(ROOT_PATH.'tmpl/answer.php');
              }
             }else if(isset($_GET['id']) && $_GET['id']==4){
                include(ROOT_PATH.'tmpl/profile.php');
             }else if(isset($_GET['id']) && $_GET['id']==3){
              include(ROOT_PATH.'tmpl/question.php');
             }else if(isset($_GET['id']) && $_GET['id']==5){
              include(ROOT_PATH.'tmpl/otvet.php');
             }else if(isset($_GET['id']) && $_GET['id']==6){
              include(ROOT_PATH.'tmpl/olimp.php');
             }else{
                if(isset($_GET['edit']) && ($_GET['edit']==1 || $_GET['edit']==2)){
                  ?>
                  <!--     editor   -->
              <div class="editorStyle">
                <div class="toolbar">
                <a href="#" data-command='undo'><i class='fa fa-undo'></i></a>
                <a href="#" data-command='redo'><i class='fa fa-repeat'></i></a>
                <div class="fore-wrapper"><i class='fa fa-font' style='color:#C96;'></i>
                  <div class="fore-palette">
                  </div>
                </div>
                <div class="back-wrapper"><i class='fa fa-font' style='background:#C96;'></i>
                  <div class="back-palette">
                  </div>
                </div>
                <a href="#" data-command='bold'><i class='fa fa-bold'></i></a>
                <a href="#" data-command='italic'><i class='fa fa-italic'></i></a>
                <a href="#" data-command='underline'><i class='fa fa-underline'></i></a>
                <a href="#" data-command='strikeThrough'><i class='fa fa-strikethrough'></i></a>
                <a href="#" data-command='justifyLeft'><i class='fa fa-align-left'></i></a>
                <a href="#" data-command='justifyCenter'><i class='fa fa-align-center'></i></a>
                <a href="#" data-command='justifyRight'><i class='fa fa-align-right'></i></a>
                <a href="#" data-command='justifyFull'><i class='fa fa-align-justify'></i></a>
                <!--<a href="#" data-command='indent'><i class='fa fa-indent'></i></a>
                <a href="#" data-command='outdent'><i class='fa fa-outdent'></i></a> -->
                <a href="#" data-command='insertUnorderedList'><i class='fa fa-list-ul'></i></a>
                <a href="#" data-command='insertOrderedList'><i class='fa fa-list-ol'></i></a>
                <a href="#" data-command='h1'>H1</a>
                <a href="#" data-command='h2'>H2</a>
                <a href="#" data-command='createlink'><i class='fa fa-link'></i></a>
                <a href="#" data-command='unlink'><i class='fa fa-unlink'></i></a>
                <a href="#" data-command='insertimage'><i class='fa fa-image'></i></a>
                <a href="#" data-command='p'>P</a>
                <a href="#" data-command='subscript'><i class='fa fa-subscript'></i></a>
                <a href="#" data-command='superscript'><i class='fa fa-superscript'></i></a>
                <a href="#" data-command='save'><i class='fa fa-save'></i></a>
                <a href="#" data-command='code'><i class='fa fa-code'></i></a>

              </div>
              <div id='editor' contenteditable><?=$page['content']?></div>
                
          
              <script>
              function saveText(){
                let text = document.getElementById("editor").innerHTML;
                document.getElementById("editorHide").innerHTML = text;
                document.getElementById("editorForm").submit();
                return false;
                
              }
              var colorPalette = ['000000', 'FF9966', '6699FF', '99FF66', 'CC0000', '00CC00', '0000CC', '333333', '0066FF', 'FFFFFF'];
              var forePalette = $('.fore-palette');
              var backPalette = $('.back-palette');

              var codeMode = false;

              for (var i = 0; i < colorPalette.length; i++) {
                forePalette.append('<a href="#" data-command="forecolor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
                backPalette.append('<a href="#" data-command="backcolor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
              }

              $('.toolbar a').click(function(e) {
                var command = $(this).data('command');
                if (command == 'h1' || command == 'h2' || command == 'p') {
                  document.execCommand('formatBlock', false, command);
                }
                if (command == 'forecolor' || command == 'backcolor') {
                  document.execCommand($(this).data('command'), false, $(this).data('value'));
                }
                if (command == 'createlink' || command == 'insertimage') {
                  url = prompt('Enter the link here: ', 'http:\/\/');
                  document.execCommand($(this).data('command'), false, url);
                } else document.execCommand($(this).data('command'), false, null);
                if(command== 'save'){
                  saveText();
                }
                if(command == 'code'){
                  codeMode=!codeMode;
                  if(codeMode){
                    let html = document.getElementById("editor").innerHTML;
                    document.getElementById("editorHide").innerHTML = html;
                    document.getElementById("editorHide").style.display='block';
                    document.getElementById("editor").style.display='none';
                  }else{
                    let html = document.getElementById("editorHide").value;
                    document.getElementById("editor").innerHTML = html;
                    document.getElementById("editorHide").style.display='none';
                    document.getElementById("editor").style.display='block';
                    
                  }
                  

                }

              });
          

              </script>
            </div>
                  <!--     .editor   -->
                    <form action="<?=INDEX_PAGE;?>?edit=2&id=1"  id="editorForm" method="post">
                      <textarea name="editor" id="editorHide"></textarea>
                      <a href="#" class="saveButton blueButton" onclick="return saveText();"><span class="fa fa-save"></span>Сохранить</a>
                    </form>
                  <?php

                }else{
                  if($_SESSION['user']['role'] == "super_admin"){
                    ?>
                     <div class = "adminEdit">
                       <a class="editButton orangeButton" href="<?=INDEX_PAGE;?>?edit=1&id=1"><span class="fa fa-pencil"></span>Редактировать</a>
                     </div>
                    <?php 
                   }
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
