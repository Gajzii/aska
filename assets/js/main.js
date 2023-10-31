// ------------------ BURGER MENU ------------------
function onClickMenu() {
  document.getElementById("dropdownmenu").classList.toggle("change");
  document.querySelector(".top-menu").classList.toggle("change");
  document.querySelector(".header-background").classList.toggle("change-header-height");
  document.querySelector(".header-inner").classList.toggle("change-header-height");
  document.querySelector(".logo").classList.toggle("change-logo");
}

// ------------------ MEMBERSHIP BENEFITS SLIDER ------------------
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

/* MODAL */
/* var modal = document.getElementById("benefitsModal");

var btn = document.getElementById("modalOpenBtn");

var span = document.getElementsByClassName("modal-close-btn")[0];

btn.onclick = function () {
  modal.style.display = "block";
};

span.onclick = function () {
  modal.style.display = "none";
};

window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}; */

// test
// Get the modal
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
