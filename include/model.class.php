<?php
class Model{
  public $db = false;
  public $pages = array(array("id"=>1,"name"=>"Задания","css"=>"zadaniya"),
                array("id"=>2,"name"=>"Ответы","css"=>"otvet"),
                array("id"=>3,"name"=>"Задать вопрос","css"=>"vopros"),
                array("id"=>4,"name"=>"Профиль","css"=>"profile"));
  public $pageID;
  public function __construct(){
    $this->dbConnect();


  }
  public function dbConnect(){
    $this->db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    if(!$this->db){
      echo "Ошибка: Неудалось подключиться";
      exit();
    }

  }
  public function test(){
    echo "TestModel<br>";
  }
  public function validLogin(){
    $login = $_POST['login'];
    $password = $_POST['password'];
    if (strlen($login)<4 || strlen($password)<4){
      return false;

    }
    $query ="SELECT * FROM users WHERE login ='".$login."'and password ='".$password."'";
    $result = mysqli_query($this->db,$query);
    if(!$result){
      echo mysqli_error($this->db);
      exit();
    }
    if(mysqli_num_rows($result)==1){
      return true;

    }else{
      return false;
    }
  }
  public function querySelectRow($query){
    $result = mysqli_query($this->db,$query);
    if(!$result){
      echo mysqli_error($this->db);
      exit();
    }
    if(mysqli_num_rows($result)>0){
      return mysqli_fetch_assoc($result);

    }else{
      return false;
    }


  }

  public function querySelectRows($query){
    $result = mysqli_query($this->db,$query);
    if(!$result){
      echo mysqli_error($this->db);
      exit();
    }

    if(mysqli_num_rows($result)>0){
      for($i=0;$i<mysqli_num_rows($result);$i++){
           $rows[] = mysqli_fetch_assoc($result);
      }
      return $rows;

    }else{
      return false;
    }
  }

  public function queryInsert($query,$getId = false){
    if(!mysqli_query($this->db,$query)){
        echo mysqli_error($this->db);
        exit();
    }
    if($getId){
      $id =mysqli_insert_id($this->db);
      return $id;
    }else{
      return true;
    }
  }

  public function simpleQuery($query){
    $result = mysqli_query($this->db,$query);
    if(!$result){
      echo mysqli_error($this->db);
      exit();
    }
    return $result;
  }

  public function getOlimp(){
    $query = "SELECT * FROM olimp WHERE status = 1";
    return $this->querySelectRow($query);

  }
  public function getOlimpFromId($id){
    $query = "SELECT * FROM olimp WHERE id = ".$id;
    return $this->querySelectRow($query);

  }
  public function getOlimpList($status = false){
    $query = "";
    if ($status === false){
      $query = "SELECT * FROM olimp";

    }else{
        $query = "SELECT * FROM olimp WHERE status = ".$status;

    }

    return $this->querySelectRows($query);

  }
  public function createOimp($title, $code,$status){
    $query = "INSERT INTO `olimp` (`id`, `title`, `code`, `status`) VALUES
(NULL, '".$title."', '".$code."', '".$status."')";
    return $this->queryInsert($query,true);

  }

  public function getMenu(){
    return $this->pages;
  }
  public function getPageName(){
    $menu = $this->getMenu();
    $active_index = 1;
    $size = sizeof($menu);
    if(isset($_GET['id']) && $_GET['id'] >= 1  && $_GET['id'] <= $size ){
      $active_index = $_GET['id'];
    }
    foreach ($menu as $item) {
      if($item['id'] == $active_index){
          $this->pageID = $active_index;
         return $item['name'] ;
       }

     }
  }
  public function registr($login,$username,$password,$email,$code,$ip,$priv){
    $query = "INSERT INTO `users` (`login`,`username`, `password`,`email`, `date_reg`,`ip`,`priv`) VALUES
    ('".$login."', '".$username."', '".$password."','".$email."',NOW(),'".$ip."','".$priv."')";
    echo $query;
    return $this->queryInsert($query,true);

  }
  public function getPageContent($alias){
      $sql = "SELECT * FROM `pages` WHERE alias = '".$alias."'";
      return  mysqli_fetch_assoc($this->simpleQuery($sql));
  }
}
?>