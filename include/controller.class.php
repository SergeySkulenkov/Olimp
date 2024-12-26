<?php
class Controller{
  private $model;
  private $user;
  public function __construct(&$model){
    $this->model = $model;
    $this->user = new User($model);


  }
  public function checkLogin(){
    //print_r($this->user);
    if($this->user->data['login']==false){
      header("Location:".LOGIN_PAGE);
    }

  }
  public function getLogin(){
    return $this->user->getLogin();

  }
  public function printMenu(){
    $menu = $this->model->getMenu();
    $active_index = 1;
    $size = sizeof($menu);
    if(isset($_GET['id']) && $_GET['id'] >= 1  && $_GET['id'] <= $size ){
      $active_index = $_GET['id'];
    }
    include(ROOT_PATH."/tmpl/menu.php");

  }
  public function getPageName(){
    return  $this->model->getPageName();
  }
  public function getPageContent(){
      if($this->model->pageID == 1){
          return $this->model->getPageContent("tasks");
      }
      else if($this->model->pageID == 2){
          $content = $this->model->getAnswerContent();
          return array('title'=>'Ответы', 'content'=>$content);
      }
      else if($this->model->pageID == 4){
          $content = file_get_contents(ROOT_PATH.'tmpl/profile.php');
          return array('title'=>'Профиль', 'content'=>$content);
      }

  }
  public function logOut(){
    $this->user->logOut();
    //print_r($this->user);
  }
  public function registr(){

  }
  public function checkUploadUserFile(){
      if(!isset($_GET['upload'])){
          return false;
      }
      if(isset($_FILES['userfile']['tmp_name'])){
          $uploadDir = ROOT_PATH."upload/users/".$_SESSION['user']['id'].'/';
          if(!is_dir($uploadDir)){
              if(!mkdir($uploadDir,0777,true)){
                  return false;
              }
          }
          $uploadfile =  $uploadDir.basename($_FILES['userfile']['name']);
          if(move_uploaded_file($_FILES['userfile']['tmp_name'],$uploadfile)){
              $this->model->addUserAnswer(1,$_SESSION['user']['id'],$_FILES['userfile']['name'],$uploadfile);
              return true;
          }else{
              return false;
          }

      }
      return false;
  }
  public function checkUserDeleteAnswer(){

      $file_path = $this->model->getFilePath($_GET['del'],$_SESSION['user']['id']);
      if(!$file_path){
          return false;
      }
      $this->model->transaction_start();
      $res = $this->model->delUserAnswer($_GET['del'],$_SESSION['user']['id']);
      if(!$res){
          return false;

      }
      if(file_exists($file_path['file_path'])){
        if(unlink($file_path['file_path'])){
            $this->model->transaction_commit();
            return true;
        }else{
            $this->model->transaction_rollback();
            return false;
        }
      }
      $this->model->transaction_rollback();
      return false;

  }
}

?>
