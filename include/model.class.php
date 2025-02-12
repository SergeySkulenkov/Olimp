<?php
class Model{
  public $db = false;
  public $pages = array(
                array("id"=>1,"name"=>"Задания","css"=>"zadaniya","user"=>true, "super_admin"=>true),
                array("id"=>2,"name"=>"Ответы","css"=>"otvet","user"=>true, "super_admin"=>true),
                array("id"=>3,"name"=>"Задать вопрос","css"=>"vopros","user"=>true, "super_admin"=>false),
                array("id"=>4,"name"=>"Профиль","css"=>"profile","user"=>true, "super_admin"=>true),
                array("id"=>5,"name"=>"Вопросы","css"=>"adminOtvet","user"=>false, "super_admin"=>true),
                array("id"=>6,"name"=>"Олимпиада","css"=>"olimp","user"=>false, "super_admin"=>true)
              );
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
    $query ="SELECT id, login, priv FROM users WHERE login ='".$login."'and password ='".$password."' and priv != 0";
    $result = mysqli_query($this->db,$query);
    if(!$result){
      echo mysqli_error($this->db);
      exit();
    }
    if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
        return $row;

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
    $retval = array();
    foreach ($this->pages as $item) {
        if($_SESSION['user']['role']=="user"){
            if($item['user']==true){
              $retval[] = $item;
            }
        }else if($_SESSION['user']['role']=="super_admin"){
          if($item['super_admin']==true){
            $retval[] = $item;
          
          }
        }

     }
    return $retval;
  }
  public function getPageName(){
    $menu = $this->getMenu();
    $active_index = 1;
    if(isset($_GET['id']) && $_GET['id'] >= 1&& $this->issetIndex( $_GET['id'], $menu)){
      $active_index = $_GET['id'];
    }
    
    foreach ($menu as $item) {
      if($item['id'] == $active_index){
          $this->pageID = $active_index;
         return $item['name'] ;
       }

     }
  }
  public function issetIndex($id, $menu){
    foreach($menu as $value){
      if($value['id']== $id){
        return true;
    } 
   }
   return false;
  }
  public function getUser($id){
    $query = "SELECT login, password, email, username  FROM users where id = '".$id."'";
    return  $this->querySelectRow($query);

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
  public function getAnswerContent(){
      $sql = "SELECT * FROM `user_answer` WHERE tur_id = 1 and user_id = ".$_SESSION['user']['id']." order by file_date";
      $rows = $this->querySelectRows($sql);
      if(!$rows){
          return false;

      }

      foreach ($rows as $key => $value) {
          $query  = "SELECT * FROM `jury_comments` WHERE answer_id = ".$value['id']." order by date_comment ";
          $r = $this->querySelectRows($query);
          $rows[$key]['jury_comments'] = $r;

      }

      return $rows;
  }
  public function addUserAnswer($tur_id,$user_id,$file_name,$file_path){
      $query = "INSERT INTO `user_answer`(`tur_id`,`user_id`,`file_name`,`file_path`,`file_date`) VALUES
      ('".$tur_id."','".$user_id."','".$file_name."','".$file_path."',NOW())";
      $id = $this->queryInsert($query,true);
      if(mysqli_error($this->db)){
          return false;
      }else{
          return $id;
      }

  }
  public function delUserAnswer($id,$user_id){
      $query = "delete from `user_answer` where id = '".$id."' and user_id = '".$user_id."'";
      return $this->simpleQuery($query);

  }
  public function getFilePath($id, $user_id){
      $query =  "SELECT file_path from `user_answer`  where id = '".$id."' and user_id = '".$user_id."'";
      return $this->querySelectRow($query);

  }
  public function transaction_start(){
      $this->simpleQuery("start transaction");
  }
  public function transaction_commit(){
      $this->simpleQuery("commit");
  }
  public function transaction_rollback(){
      $this->simpleQuery("rollback");
  }

  public function updateUser($id,$login,$username,$email,$password)
  {
    $query ="SELECT login FROM users where id != ".$id." and UPPER(login) = '".strtoupper($login)."'";
    $res = $this->querySelectRow($query);
    if($res){
      return "Пользователь с таким логином уже существует.";
    }
    if($password ==""){
      $query = "UPDATE users set login = '".$login."', username = '".$username."', email = '".$email."' where id ='".$id."'";
    }else{
      $query = "UPDATE users set login = '".$login."', username  = '".$username."', email = '".$email."', password = '".$password."' where id =  '".$id."'";
    }
    return $this->simpleQuery($query);
    
  }
  public function printUserQuestion($user_id){
    $query =  "SELECT * from user_question where user_id = '".$user_id."'";
    $question = $this->querySelectRows($query);
    if(is_array($question)){
      for($i = 0;$i<sizeof($question);$i++){
        $query =  "SELECT * from admin_answer where answer_id = '".$question[$i]['id']."'";
        $question[$i]['answers'] = $this->querySelectRows($query);
  
      }
      return $question;

    }
    return false;
  }
  public function checkUserQuestion($user_id, $text, $tur_id)
  {
    $text = trim($text);
    if(strlen($text)<20 ||  strlen($text)>2000){
      return false;
    }
    $query = "INSERT INTO `user_question`(`tur_id`,`user_id`,`question`,`date`) VALUES
      ('".$tur_id."','".$user_id."','".$text."',NOW())";
    $this->queryInsert($query);  
    return true;
  }
  public function delUserQuestion($id,$user_id){
    $query = "delete from `user_question` where id = '".$id."' and user_id = '".$user_id."'";
    return $this->simpleQuery($query);
  }
  public function printAdminQuestion($user_id, $type=0){
    echo "type=".$type;
    $query = "";
    if($type == 0){
      $query =  "SELECT * FROM `user_question` LEFT JOIN admin_answer ON user_question.id = admin_answer.answer_id and admin_answer.answer_id = NULL order by date desc";
      echo $query;
    }else if($type == 1){
      $query =  "SELECT * FROM `user_question`, admin_answer WHERE user_question.id = admin_answer.answer_id";
    }else if($type == 2){
      $query =  "SELECT * from user_question order by date desc";
    }
    $question = $this->querySelectRows($query);
    if(is_array($question)){
      for($i = 0;$i<sizeof($question);$i++){
        $query =  "SELECT * from admin_answer where answer_id = '".$question[$i]['id']."'";
        $question[$i]['answers'] = $this->querySelectRows($query);
  
      }
      return $question;

    }
    return false;
  }
  public function getUserAnswerList(){
    $query = "SELECT * FROM `users` , user_answer WHERE users.id = user_answer.user_id and user_answer.tur_id = 1 group by (users.id)";
    return $this->querySelectRows($query);
  }

  public function getUserAnswerContent($user_id){
    $sql = "SELECT * FROM `user_answer` WHERE tur_id = 1 and user_id = ".$user_id." order by file_date";
    $rows = $this->querySelectRows($sql);
    if(!$rows){
        return false;

    }

    foreach ($rows as $key => $value) {
        $query  = "SELECT * FROM `jury_comments` WHERE answer_id = ".$value['id']." order by date_comment ";
        $r = $this->querySelectRows($query);
        $rows[$key]['jury_comments'] = $r;

    }

    return $rows;
}
public function getUserAnswer($id){
  $sql = "SELECT * FROM `user_answer` WHERE tur_id = 1 and id = ".$id." order by file_date";
  return $this->querySelectRows($sql);
}
}
?>
