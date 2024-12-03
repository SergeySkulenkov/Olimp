
var regexp = /^[a-z0-9_\-]{4,50}$/i;
var reg = /^[a-z0-9_\-.@]{8,50}$/i;
var emailRegexp = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
var codeRegexp = /^[a-z0-9_\-.@]{8,50}$/i;



function sub() {
    var login = document.getElementById('login').value.trim();
    var password = document.getElementById('password').value;
    if (!regexp.test(login) || !reg.test(password)) {
        //alert("Error");
        document.getElementById('loginError').classList.add("Error");
        document.getElementById('passwordError').classList.add("Error");
        document.getElementById('generalError').classList.add("Error");

        return false;
    }
    else {
        //alert("Ok")

    }
    return false;


}
function registr() {
      var login = document.getElementById('login').value.trim();
      var email = document.getElementById('email').value.trim();
      var password = document.getElementById('password').value;
      var repassword = document.getElementById('repassword').value;
      var codeReg = document.getElementById('codeReg').value;

      if (!regexp.test(login)){
        document.getElementById('loginError').classList.add("Error");
        document.getElementById('loginErrorP').classList.add("Error");
        return false;

      }
      if (!emailRegexp.test(email)){
        document.getElementById('emailError').classList.add("Error");
        document.getElementById('emailErrorP').classList.add("Error");
        return false;

      }
      if (!reg.test(password)){
        document.getElementById('passwordError').classList.add("Error");
        document.getElementById('passwordErrorP').classList.add("Error");
        return false;

      }
      if (repassword != password){
        document.getElementById('repasswordError').classList.add("Error");
        document.getElementById('repasswordErrorP').classList.add("Error");
        return false;

      }
      if (!codeRegexp.test(codeReg)){
        document.getElementById('codeRegError').classList.add("Error");
        document.getElementById('codeRegErrorP').classList.add("Error");
        return false;

      }
    return false;

}
