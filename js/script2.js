var blurStart = false;
function registr() {
  let elms = [login, password, repassword,username, email, codeReg];
  for (let el of elms) {
    el.focus();
    el.blur();
  }
  alert(document.getElementsByClassName("Error").length);
  return document.getElementsByClassName("Error").length == 0;

}
function addErrorClass(id) {
  document.getElementById(id).classList.add("Error");
  document.getElementById(id + "P").classList.add("Error");
}
function removeErrorClass(id) {
  document.getElementById(id).classList.remove("Error");
  document.getElementById(id + "P").classList.remove("Error");
}
login.onblur = function () {

  var regexp = /^[a-z0-9_\-]{4,50}$/i;
  if (!regexp.test(login.value))
    addErrorClass("loginError");
}
login.onfocus = function () {
  removeErrorClass("loginError");
}
username.onblur = function () {

  var regexp = /^[a-zа-яё0-9 _\-]{4,50}$/i;
  if (!regexp.test(username.value))
    addErrorClass("usernameError");
}
username.onfocus = function () {
  removeErrorClass("usernameError");
}

password.onblur = function () {
  blurStart = true;
  var regexp = /^[a-z0-9_\-.@]{8,50}$/i;
  if (!regexp.test(password.value))
    addErrorClass("passwordError");
}
password.onfocus = function () {
  removeErrorClass("passwordError");
}
repassword.onblur = function () {
  blurStart = true;
  if (repassword.value != password.value)
    addErrorClass("repasswordError");
}
repassword.onfocus = function () {
  removeErrorClass("repasswordError");
}



email.onblur = function () {
  blurStart = true;
  var regexp = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i;
  if (!regexp.test(email.value))
    addErrorClass("emailError");
}
email.onfocus = function () {
  removeErrorClass("emailError");
}

codeReg.onblur = function () {
  blurStart = true;
  var regexp = /^[a-z0-9_\-.@]{8,50}$/i;
  if (!regexp.test(codeReg.value))
    addErrorClass("codeRegError");
}
codeReg.onfocus = function () {
  removeErrorClass("codeRegError");
}
