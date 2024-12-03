<?php
include('run.php');
$login = "";
$email = "";
$username ="";
$password = "";
$repassword = "";
$registration_code = "";
$error = false;
$loginError = "";
if (isset($_POST['login'])){
  $login = $_POST['login'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $repassword = $_POST['repeat_password'];
  $registration_code = $_POST['registration_code'];
  $username = $_POST['username'];

  if(!preg_match('/^[a-z0-9_\-]{4,50}$/i',$login)){
    $loginError = " Error";
  }

  if(!preg_match('/^[a-zа-яё0-9 _\-]{4,50}$/i',$username)){
      $loginError = " Error";
  }
  if(!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i',$email)){
    $loginError = " Error";
  }
  if(!preg_match('/^[a-z0-9_\-.@]{8,50}$/i',$password)){
    $loginError = " Error";
  }
  if($password != $repassword){
    $loginError = " Error";
  }
  if(!preg_match('/^[a-z0-9_\-.@]{8,50}$/i',$registration_code)){
    $loginError = " Error";
  }
  if($loginError==""){
     echo "На указанный адрес электронной почты было оптравленно письмо.";
     $ip = $_SERVER['REMOTE_ADDR'];
     $model->registr($login,$username,$password,$email,$registration_code,$ip,0);
     exit();

  }else{
    echo "Errorrrro";
  }

}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Вход в систему</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="left">
        <div class="logo-text">
            <div id="logo">
            </div>
            <div id="text">
                Эвристическая олимпиада школы программирования и дизайна «Молодёжная студия Я»
            </div>
        </div>
        <div id="bottombg">
        </div>
    </div>

    <div class="right">
        <div class="login">
            <form class="loginForm" novalidate action="registr.php" method="post" onsubmit="return registr()">
                <h1>Регистрация</h1>
                <div class="inputblock">
                    <input type="text" id="login" name="login" value="<?= $login;?>" autocomplete="off"
                        placeholder="Логин">
                    <div id="loginError" class="errorInputBlock<?php echo $loginError;?>">
                    </div>
                </div>
                <p id="loginErrorP" class="registr generalError<?php echo $loginError;?>"><span>Может содержать буквы от а до Z, цифры, знак
                        тире, знак
                        точка.</span></p>
                <div class="inputblock margin30top">
                    <input type="text" id="username" name="username" value="" autocomplete="off"
                                placeholder="Имя пользователя">
                        <div id="usernameError" class="errorInputBlock <?php echo $loginError;?>">
                        </div>
                </div>
                <p id="usernameErrorP" class=" registr generalError<?php echo $loginError;?>"><span>Может содержать буквы от а до Я, цифры, знак
                                тире, знак
                                точка.</span></p>

                <div class="inputblock margin30top">
                    <input type="email" id="email" name="email" value="" autocomplete="off"
                        placeholder="Электронная почта">
                    <div id="emailError" class="errorInputBlock <?php echo $loginError;?>">
                    </div>
                </div>
                <p id="emailErrorP" class=" registr generalError<?php echo $loginError;?>"><span>Может содержать буквы от а до Я, цифры, знак
                        тире, знак
                        точка.</span></p>

                <div class="inputblock margin30top">
                    <input type="password" id="password" name="password" value="" autocomplete="off"
                        placeholder="Пароль">
                    <div id="passwordError" class="errorInputBlock<?php echo $loginError;?> ">
                    </div>
                </div>
                <p id="passwordErrorP" class=" registr generalError<?php echo $loginError;?>"><span>Может содержать буквы от а до Я, цифры, знак
                        тире, знак
                        точка.</span></p>

                <div class="inputblock margin30top">
                    <input type="password" id="repassword" name="repeat_password" value="" autocomplete="off"
                        placeholder="Пароль ещё раз">
                    <div id="repasswordError" class="errorInputBlock <?php echo $loginError;?>">
                    </div>
                </div>
                <p id="repasswordErrorP" class=" rep generalError <?php echo $loginError;?>"><span>Пароли не совпадают.</span></p>

                <div class="inputblock margin30top">
                    <input type="text" id="codeReg" name="registration_code" value="" autocomplete="off"
                        placeholder="Код регистрации">
                    <div id="codeRegError" class="errorInputBlock <?php echo $loginError;?>  ">
                    </div>
                </div>
                <p id="codeRegErrorP" class="registr generalError <?php echo $loginError;?> "><span>Может содержать буквы от а до Я, цифры, знак
                        тире, знак
                        точка.</span></p>


                <div class="buttonblock register-buttonblock">
                    <div class="right-buttonblock">
                        <input type="submit" name="register" value="Зарегистрироваться">
                    </div>
                </div>



                <div class="bottom-buttonblock">
                    <a href="login.php">У меня уже есть аккаунт</a>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/script2.js"></script>

</body>

</html>
