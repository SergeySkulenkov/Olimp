<?= $message; ?>
<form class="loginForm" novalidate action="index.php?id=4"  method="post" onsubmit="">
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
        <input type="text" id="username" name="username" value="<?= $username;?>" autocomplete="off"
                    placeholder="Имя пользователя">
            <div id="usernameError" class="errorInputBlock <?php echo $loginError;?>">
            </div>
    </div>
    <p id="usernameErrorP" class=" registr generalError<?php echo $loginError;?>"><span>Может содержать буквы от а до Я, цифры, знак
                    тире, знак
                    точка.</span></p>

    <div class="inputblock margin30top">
        <input type="email" id="email" name="email" value="<?= $email;?>" autocomplete="off"
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



    <div class="buttonblock register-buttonblock">
        <div class="right-buttonblock">
            <input type="submit" name="register" value="Обновить">
        </div>
    </div>



</form>
