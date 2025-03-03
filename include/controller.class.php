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
    //To do Проверить индекс 
    if(isset($_GET['id']) && $_GET['id'] >= 1 && $this->issetIndex( $_GET['id'], $menu)){
      $active_index = $_GET['id'];
    }
    include(ROOT_PATH."/tmpl/menu.php");

  }
  public function issetIndex($id, $menu){
    foreach($menu as $value){
      if($value['id']== $id){
        return true;
      }
      

    }
    return false;

  }
  public function getPageName(){
    return  $this->model->getPageName();
  }
  public function getPageContent(){
      if($this->model->pageID == 1){
          return $this->model->getPageContent("tasks");
      }
      else if($this->model->pageID == 2){
        if($_SESSION['user']['role'] == "super_admin"){
          //Если нужно показать список пользователей
          if(!isset($_GET['user'])){
            $content = $this->model->getUserAnswerList();
            return array('title'=>'Ответы', 'content'=>$content);
          }else if(isset($_GET['otvet'])){
            $content = $this->model->getUserAnswer($_GET['otvet']);
            return array('title'=>'Ответы', 'content'=>$content);
          }else{
            $content = $this->model->getUserAnswerContent($_GET['user']);
            return array('title'=>'Ответы', 'content'=>$content);
          }
          

        }else{
          $content = $this->model->getAnswerContent();
          return array('title'=>'Ответы', 'content'=>$content);
        }
      }
      else if($this->model->pageID == 3){
        $content = $this->model->printUserQuestion($_SESSION['user']['id']);
        return array('title'=>'Задать вопрос', 'content'=>$content);
      }
      else if($this->model->pageID == 4){
          $content = $this->model->getUser($_SESSION['user']['id']);
          return array('title'=>'Профиль', 'content'=>$content);
      }
      else if($this->model->pageID == 5){
        $type = 0;
        if(isset($_GET['adminQotvet'])){
          $content = $this->model->getUserQuestion($_GET['adminQotvet']);
          $answers = $this->model->getAdminAnswer($_GET['adminQotvet']);
          if(is_array($answers)){
            $content['answers'] = $answers;
          }
          return array('title'=>'Ответы', 'content'=>$content);

        }else {
          if(isset($_GET['answer']))
              $type = $_GET['answer'];
           $content = $this->model->printAdminQuestion($_SESSION['user']['id'],$type);
           return array('title'=>'Ответы', 'content'=>$content);
        }
      }
      else if($this->model->pageID == 6){
        if(isset($_GET['olimp_id'])){
          $content = $this->model->getOlimp($_GET['olimp_id']);
          $turs = $this->model->getTur($_GET['olimp_id']);
          if(is_array($turs)){
            $content['turs'] = $turs;
          }
          return array('title'=>'Ответы', 'content'=>$content);
        }else{
          $content = $this->model->getOlimpList();
          return array('title'=>'Профиль', 'content'=>$content);
        }
       
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
  public function checkUploadOlimp(){
    if(!isset($_GET['olimp'])){
      return false;
  }
  if(isset($_POST['olimpName']) && isset($_POST['olimpName'])){
    $this->model->createOimp($_POST['olimpName'],$_POST['olimpCode'],$_POST['status']); 
    return true;
  }else{
    return false;
  }
  }
}

?>
