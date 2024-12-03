<?php
include('run.php');
$controller->checkLogin();
//$model->simpleQuery("UPDATE olimp SET title ='new title' WHERE id = 1");
$model->createOimp("Новая олимпиада", "132124",1);
$res=$model->getOlimpList();
$pageName = $controller->getPageName();
$page = $controller->getPageContent();
if(!$res){
  echo "Error! Нет данных";
}
//print_r($res);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?= $page['title'];?></title>
    <link rel="stylesheet" href="css/main.css">
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
              <?php if($_GET['id']==2){
                 include(ROOT_PATH.'tmpl/answer.php');
              }else{
                 echo  $page['content'];
              }
              ?>

          </div>

        </div>

      </div>

    </div>

  </body>
</html>
