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

// ------------------ SHOW ALL PAST EVENT CARDS ------------------
function showAllPastEvents() {
  var pastEventCards = document.querySelectorAll(".past-event-card");
  pastEventCards.forEach(function (card) {
    card.style.display = "block";
  });

  // Hide the "Show All Past Events" button after showing all events
  document.getElementById("showAllPastEventsButton").style.display = "none";
}

// ------------------ MEMBERSHIP BENEFITS SLIDER ------------------
document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".cards-container");
  const cards = document.querySelectorAll(".membership-benefits-card");
  const prevBtn = document.querySelector(".prev-btn");
  const nextBtn = document.querySelector(".next-btn");

  let isDragging = false;
  let startPosition = 0;
  let currentTranslate = 0;
  let prevTranslate = 0;
  let currentIndex = 0;
  let cardWidth;

  function setCardWidth() {
    cardWidth =
      cards[0].offsetWidth +
      parseInt(window.getComputedStyle(cards[0]).marginRight);
  }

  setCardWidth();

  window.addEventListener("resize", setCardWidth);

  function updateSliderPosition() {
    slider.style.transform = `translateX(${currentTranslate}px)`;
  }

  function snapToSlide() {
    currentIndex = Math.round(-currentTranslate / cardWidth);
    const maxIndex = cards.length - 1;
    const targetTranslate = -currentIndex * cardWidth;

    if (currentIndex < 0) {
      currentIndex = maxIndex;
      currentTranslate = -currentIndex * cardWidth;
    } else if (currentIndex > maxIndex) {
      currentIndex = 0;
      currentTranslate = 0;
    }

    updateSliderPosition();
  }

  function dragStart(e) {
    isDragging = true;
    startPosition = e.type.includes("mouse") ? e.pageX : e.touches[0].clientX;
    prevTranslate = currentTranslate;
  }

  function drag(e) {
    if (!isDragging) return;
    const currentPosition = e.type.includes("mouse")
      ? e.pageX
      : e.touches[0].clientX;
    const diff = currentPosition - startPosition;
    currentTranslate = prevTranslate + diff;
    updateSliderPosition();
  }

  function dragEnd() {
    isDragging = false;
    snapToSlide();
  }

  slider.addEventListener("mousedown", dragStart);
  slider.addEventListener("touchstart", dragStart);
  slider.addEventListener("mouseup", dragEnd);
  slider.addEventListener("touchend", dragEnd);
  slider.addEventListener("mousemove", drag);
  slider.addEventListener("touchmove", drag);

  prevBtn.addEventListener("click", () => {
    currentIndex--;
    currentTranslate = -currentIndex * cardWidth;
    snapToSlide();
  });

  nextBtn.addEventListener("click", () => {
    currentIndex++;
    currentTranslate = -currentIndex * cardWidth;
    snapToSlide();
  });

  updateSliderPosition();
});

//MODAL
var modalparent = document.getElementsByClassName("modal_multi");
var modal_btn_multi = document.getElementsByClassName("readMore_multi");
var span_close_multi = document.getElementsByClassName("close_multi");

function setDataIndex() {
  for (var i = 0; i < modal_btn_multi.length; i++) {
    modal_btn_multi[i].setAttribute("data-index", i);
    modalparent[i].setAttribute("data-index", i);
    span_close_multi[i].setAttribute("data-index", i);
  }
}

for (var i = 0; i < modal_btn_multi.length; i++) {
  modal_btn_multi[i].onclick = function () {
    var ElementIndex = this.getAttribute("data-index");
    modalparent[ElementIndex].style.display = "block";
    // Disable scrolling when the modal is open
    document.body.style.overflow = "hidden";
  };

  span_close_multi[i].onclick = function () {
    var ElementIndex = this.getAttribute("data-index");
    modalparent[ElementIndex].style.display = "none";
    // Restore scrolling when the modal is closed
    document.body.style.overflow = "auto";
  };
}

window.onload = function () {
  setDataIndex();
};

window.onclick = function (event) {
  if (event.target === modalparent[event.target.getAttribute("data-index")]) {
    modalparent[event.target.getAttribute("data-index")].style.display = "none";
    // Restore scrolling when clicking outside the modal
    document.body.style.overflow = "auto";
  }
};
