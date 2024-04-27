function checkPassword() {
  var pass1 = "0927";
  var inputPass = document.getElementById("pass").value;

  if (inputPass === pass1) {
    window.location = "admin_page.php";
  } else {
    window.location = "../login/home.html";
  }
}
let bodybg = document.querySelector("body");
setInterval(() => {
  bodybg.style.backgroundImage = "url(../images/bg-light.jpg)";
  setTimeout(() => {
    bodybg.style.backgroundImage = "url(../images/bg.jpg)";
  }, 1000);
}, 2200);
