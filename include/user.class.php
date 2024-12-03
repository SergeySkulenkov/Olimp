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
      $_SESSION['user']['login']=true;
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
}
?>
