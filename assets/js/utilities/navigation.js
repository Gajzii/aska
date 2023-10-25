export function navigation() {
  // BURGER MENU
  function onClickMenu() {
    document.getElementById("dropdownmenu").classList.toggle("change");
    document.querySelector(".top-menu").classList.toggle("change");
  }

  // ADD CLASS TO ACTIVE MENU ITEM
  for (var i = 0; i < document.links.length; i++) {
    if (document.links[i].href == document.URL) {
      document.links[i].className = "active";
    }
  }
}
