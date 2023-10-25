// ------------------ BURGER MENU ------------------
function onClickMenu() {
  document.getElementById("dropdownmenu").classList.toggle("change");
  document.querySelector(".top-menu").classList.toggle("change");
  document
    .querySelector(".header-background")
    .classList.toggle("change-header-height");
  document
    .querySelector(".header-inner")
    .classList.toggle("change-header-height");
  document.querySelector(".logo").classList.toggle("change-logo");
}
