<?php
include('run.php');
$login = "";
$error = false;

if (isset($_POST['login'])){
  $login = $_POST['login'];
  $error =$controller->getLogin();
  if(!$error){
    header("Location:".INDEX_PAGE);
  }
}else{
  $controller->logOut();
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
      <div id="logo"></div>
      <div id="text">
        Эвристическая олимпиада школы программирования и дизайна «Молодёжная студия Я»
      </div>
    </div>
    <div id="bottombg"></div>
  </div>

  <div class="right">
    <div class="login">
      <form class="loginForm" action="login.php" method="post" onsubmit="return login1()">
        <h1>Вход</h1>
        <div class="inputblock margin30">
          <input type="text" id="login" name="login" value="" placeholder="Имя пользователя">
          <div class="errorInputBlock" id="loginError"></div>
        </div>
        <div class="inputblock">
          <input type="password" id="password" name="password" value="" placeholder="Пароль">
          <div class="errorInputBlock" id="passwordError"></div>
        </div>
        <p id="generalError"><span>Неверный логин или пароль</span></p>
        <div class="buttonblock">
          <div class="left-buttonblock">
            <a href="email.html">Я забыл пароль</a>
          </div>
          <div class="right-buttonblock">
            <input type="submit" name="" value="Войти">
          </div>
        </div>
        <div class="bottom-buttonblock">
          <a href="registr.php">У меня нет аккаунта</a>
        </div>
      </form>
    </div>
  </div>

  <script type="text/javascript" src="js/script3.js"></script>
</body>

</html>
