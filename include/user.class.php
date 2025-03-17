<?php
class User{
  private $model;
  public $data;
  public function __construct(&$model){
    $this->model=$model;
    $this->getData();
  }
  public function test(){
    echo "User";
    $this->model->test();
  }
  public function getLogin(){
    $result = $this->model->validLogin();
    if($result){
      $roles = array("1" => "user","2" => "jury","5" => "super_admin");
    $_SESSION['user']['id'] = $result['id'];
    $_SESSION['user']['username'] = $result['login'];
    $_SESSION['user']['login'] = true;
    $_SESSION['user']['role'] = $roles[$result['priv']];
    $this->model->updateLoginData($_SESSION['user']['id'],$_SERVER['REMOTE_ADDR']);

    }
    return !$result;
  }
  private function getData(){
    if(isset($_SESSION['user'])){
      $this->data = $_SESSION['user'];
    }else{
      $this->data['login'] = false;

    }

  }

  public function logOut(){
    unset($_SESSION['user']);
  }

  public function getId(){
     // return $this->model->getUserID()
  }
}
?>
