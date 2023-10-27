// ------------------ BURGER MENU ------------------
function onClickMenu() {
  document.getElementById("dropdownmenu").classList.toggle("change");
  document.querySelector(".top-menu").classList.toggle("change");
  document.querySelector(".header-background").classList.toggle("change-header-height");
  document.querySelector(".header-inner").classList.toggle("change-header-height");
  document.querySelector(".logo").classList.toggle("change-logo");
}

// ------------------ MEMBERSHIP BENEFITS SLIDER ------------------
// script.js
document.addEventListener("DOMContentLoaded", function () {
  const slider = document.querySelector(".membership-benefits-cards");
  const cards = document.querySelectorAll(".membership-benefits-card");
  const prevBtn = document.querySelector(".prev-btn");
  const nextBtn = document.querySelector(".next-btn");

  let isDragging = false;
  let startPosition = 0;
  let currentTranslate = 0;
  let prevTranslate = 0;
  let currentIndex = 0;
  const cardWidth = cards[0].offsetWidth;

  function updateSliderPosition() {
    cards.forEach((card, index) => {
      card.style.transform = `translateX(${currentTranslate}px)`;
    });
  }

  function snapToSlide() {
    currentIndex = Math.round(-currentTranslate / cardWidth);
    const targetTranslate = -currentIndex * cardWidth;
    const maxTranslate = (cards.length - 1) * cardWidth;

    if (currentTranslate > 0) {
      currentIndex = cards.length - 1;
      currentTranslate = -maxTranslate;
    } else if (currentTranslate < -maxTranslate) {
      currentIndex = 0;
      currentTranslate = 0;
    }

    updateSliderPosition();
  }

  cards.forEach((card, index) => {
    card.addEventListener("mousedown", dragStart);
    card.addEventListener("touchstart", dragStart);
    card.addEventListener("mouseup", dragEnd);
    card.addEventListener("touchend", dragEnd);
    card.addEventListener("mousemove", drag);
    card.addEventListener("touchmove", drag);

    function dragStart(e) {
      isDragging = true;
      startPosition = e.type.includes("mouse") ? e.pageX : e.touches[0].clientX;
      prevTranslate = currentTranslate;
    }

    function drag(e) {
      if (!isDragging) return;
      const currentPosition = e.type.includes("mouse") ? e.pageX : e.touches[0].clientX;
      const diff = currentPosition - startPosition;
      currentTranslate = prevTranslate + diff;
      updateSliderPosition();
    }

    function dragEnd() {
      isDragging = false;
      snapToSlide();
    }
  });

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
