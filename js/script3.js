var blurStart = false;
function login1() {
    let elms = [login, password];
    for (let el of elms) {
        el.focus();
        el.blur();
    }
    return document.getElementsByClassName("Error").length == 0;
}
function addErrorClass(id) {
    document.getElementById(id).classList.add("Error");
    document.getElementById('generalError').classList.add("Error");

}
function removeErrorClass(id) {
    document.getElementById(id).classList.remove("Error");
    document.getElementById('generalError').classList.remove("Error");
}
login.onblur = function () {

    var regexp = /^[a-z0-9_\-]{4,50}$/i;
    if (!regexp.test(login.value))
        addErrorClass("loginError");
}
login.onfocus = function () {
    removeErrorClass("loginError");
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