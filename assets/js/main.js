// ------------------ BURGER MENU ------------------
function onClickMenu() {
  // Toggles the burger menu
  var body = document.querySelector("body"); // Selects the body element
  var dropdownMenu = document.getElementById("dropdownmenu"); // Selects the dropdown-menu element
  dropdownMenu.classList.toggle("change"); // Toggles the class 'change' on the dropdown-menu element
  document.querySelector(".top-menu").classList.toggle("change"); // Toggles the class 'change' on the top-menu element
  document.querySelector(".header-background").classList.toggle("change-header-height"); // Toggles the class 'change-header-height' on the header-background element
  document.querySelector(".header-inner").classList.toggle("change-header-height"); // Toggles the class 'change-header-height' on the header-inner element
  document.querySelector(".logo").classList.toggle("change-logo"); // Toggles the class 'change-logo' on the logo element
  document.querySelector(".header-overlay").classList.toggle("change-header-overlay"); // Toggles the class 'change-header-overlay' on the header-overlay element
  document.querySelector(".gradient-border-open").classList.toggle("gradient-border-open-overlay"); // Toggles the class 'gradient-border-open-overlay' on the gradient-border-open element

  // If dropdown-menu has class 'change', prevent scrolling
  if (dropdownMenu.classList.contains("change")) {
    // If dropdown-menu has class 'change'
    body.style.overflow = "hidden"; // Låser scrolling på body elementet
  } else {
    // If dropdown-menu does not have class 'change'
    body.style.overflow = ""; // Oplåser scrolling på body elementet
  }
}

// ADD CLASS TO ACTIVE MENU ITEM
var menuLinks = document.querySelectorAll(".top-menu a"); // Selects all a elements in the top-menu element and stores them in a variable called menuLinks

for (var i = 0; i < menuLinks.length; i++) {
  // Loops through all the a elements in the top-menu element and adds the class 'active' to the a element that has the same href as the current URL
  if (menuLinks[i].href === document.URL) {
    // If the href of the current a element is the same as the current URL
    menuLinks[i].classList.add("active"); // Add the class 'active' to the current a element
  }
}

// ------------------ SHOW ALL PAST EVENT CARDS ------------------
function showAllPastEvents() {
  // Shows all past event cards and hides the "Show All Past Events" button
  var pastEventCards = document.querySelectorAll(".past-event-card"); // Selects all past event cards and stores them in a variable called pastEventCards
  pastEventCards.forEach(function (card) {
    // Loops through all past event cards and shows them
    card.style.display = "block"; // Shows the current past event card
  });

  // Hide the "Show All Past Events" button after showing all events
  document.getElementById("showAllPastEventsButton").style.display = "none"; // Hides the "Show All Past Events" button
}

// ------------------ MEMBERSHIP BENEFITS SLIDER ------------------
const slider = document.querySelector(".cards-container"); // Selects the cards-container element and stores it in a variable called slider
const cards = document.querySelectorAll(".membership-benefits-card"); // Selects all membership-benefits-card elements and stores them in a variable called cards
const prevBtn = document.querySelector(".prev-btn"); // Selects the prev-btn element and stores it in a variable called prevBtn
const nextBtn = document.querySelector(".next-btn"); // Selects the next-btn element and stores it in a variable called nextBtn

// If slider exists, run the slider code
if (slider) {
  // If slider exists
  let isDragging = false; // Sets isDragging to false
  let startPosition = 0; // Sets startPosition to 0
  let currentTranslate = 0; // Sets currentTranslate to 0
  let prevTranslate = 0; // Sets prevTranslate to 0
  let currentIndex = 0; // Sets currentIndex to 0
  let cardWidth; // Sets cardWidth to undefined

  // Sets the cardWidth to the width of the first card
  function setCardWidth() {
    // Sets the cardWidth to the width of the first card
    cardWidth = cards[0].offsetWidth + parseInt(window.getComputedStyle(cards[0]).marginRight); // Sets the cardWidth to the width of the first card
  }

  setCardWidth(); // Sets the cardWidth to the width of the first card

  window.addEventListener("resize", setCardWidth); // Sets the cardWidth to the width of the first card when the window is resized

  function updateSliderPosition() {
    // Updates the slider position
    slider.style.transform = `translateX(${currentTranslate}px)`; // Updates the slider position
  }

  // Snaps to the current slide
  function snapToSlide() {
    // Snaps to the current slide
    currentIndex = Math.round(-currentTranslate / cardWidth); // Sets the currentIndex to the currentTranslate divided by the cardWidth
    const maxIndex = cards.length - 1; // Sets the maxIndex to the number of cards minus 1
    const targetTranslate = -currentIndex * cardWidth; // Sets the targetTranslate to the currentIndex multiplied by the cardWidth

    if (currentIndex < 0) {
      // If currentIndex is less than 0
      currentIndex = maxIndex; // Sets the currentIndex to the maxIndex
      currentTranslate = -currentIndex * cardWidth; // Sets the currentTranslate to the currentIndex multiplied by the cardWidth
    } else if (currentIndex > maxIndex) {
      // If currentIndex is greater than maxIndex
      currentIndex = 0; // Sets the currentIndex to 0
      currentTranslate = 0; // Sets the currentTranslate to 0
    }

    updateSliderPosition(); // Updates the slider position
  }

  // Dragging functionality
  function dragStart(e) {
    // Dragging functionality
    isDragging = true; // Sets isDragging to true
    startPosition = e.type.includes("mouse") ? e.pageX : e.touches[0].clientX; // Sets the startPosition to the pageX of the mouse or the clientX of the first touch
    prevTranslate = currentTranslate; // Sets the prevTranslate to the currentTranslate
  }

  function drag(e) {
    // Dragging functionality
    if (!isDragging) return; // If isDragging is false, return
    const currentPosition = e.type.includes("mouse") ? e.pageX : e.touches[0].clientX; // Sets the currentPosition to the pageX of the mouse or the clientX of the first touch
    const diff = currentPosition - startPosition; // Sets the diff to the currentPosition minus the startPosition
    currentTranslate = prevTranslate + diff; // Sets the currentTranslate to the prevTranslate plus the diff
    updateSliderPosition(); // Updates the slider position
  }

  function dragEnd() {
    // Dragging functionality
    isDragging = false; // Sets isDragging to false
    snapToSlide(); // Snaps to the current slide
  }

  // Event listeners
  slider.addEventListener("mousedown", dragStart); // Event listener for when the mouse is pressed down on the slider
  slider.addEventListener("touchstart", dragStart); // Event listener for when the touch is pressed down on the slider
  slider.addEventListener("mouseup", dragEnd); // Event listener for when the mouse is released on the slider
  slider.addEventListener("touchend", dragEnd); // Event listener for when the touch is released on the slider
  slider.addEventListener("mousemove", drag); // Event listener for when the mouse is moved on the slider
  slider.addEventListener("touchmove", drag); // Event listener for when the touch is moved on the slider

  // Button functionality
  prevBtn.addEventListener("click", () => {
    // Event listener for when the prevBtn is clicked
    currentIndex--; // Decrements the currentIndex
    currentTranslate = -currentIndex * cardWidth; // Sets the currentTranslate to the currentIndex multiplied by the cardWidth
    snapToSlide(); // Snaps to the current slide
  });

  nextBtn.addEventListener("click", () => {
    // Event listener for when the nextBtn is clicked
    currentIndex++; // Increments the currentIndex
    currentTranslate = -currentIndex * cardWidth; // Sets the currentTranslate to the currentIndex multiplied by the cardWidth
    snapToSlide(); // Snaps to the current slide
  });

  updateSliderPosition(); // Updates the slider position
}

//MODAL
// Get the modal
var modalparent = document.getElementsByClassName("modal_multi"); // Selects all elements with the class 'modal_multi' and stores them in a variable called modalparent
var modal_btn_multi = document.getElementsByClassName("readMore_multi"); // Selects all elements with the class 'readMore_multi' and stores them in a variable called modal_btn_multi
var span_close_multi = document.getElementsByClassName("close_multi"); // Selects all elements with the class 'close_multi' and stores them in a variable called span_close_multi

// When the user clicks the button, open the modal
function setDataIndex() {
  // Sets the data-index attribute on the modalparent, modal_btn_multi and span_close_multi elements
  for (var i = 0; i < modal_btn_multi.length; i++) {
    // Loops through all the modal_btn_multi elements and sets the data-index attribute on the modalparent, modal_btn_multi and span_close_multi elements
    modal_btn_multi[i].setAttribute("data-index", i); // Sets the data-index attribute on the modal_btn_multi element
    modalparent[i].setAttribute("data-index", i); // Sets the data-index attribute on the modalparent element
    span_close_multi[i].setAttribute("data-index", i); // Sets the data-index attribute on the span_close_multi element
  }
}

for (var i = 0; i < modal_btn_multi.length; i++) {
  // Loops through all the modal_btn_multi elements and adds an onclick event listener to each of them
  modal_btn_multi[i].onclick = function () {
    // Adds an onclick event listener to the current modal_btn_multi element
    var ElementIndex = this.getAttribute("data-index"); // Gets the data-index attribute of the current modal_btn_multi element and stores it in a variable called ElementIndex
    modalparent[ElementIndex].style.display = "block"; // Displays the modalparent element with the same data-index attribute as the current modal_btn_multi element
    // Disable scrolling when the modal is open
    document.body.style.overflow = "hidden"; // Disables scrolling on the body element
  };

  // When the user clicks on <span> (x), close the modal
  span_close_multi[i].onclick = function () {
    // Adds an onclick event listener to the current span_close_multi element
    var ElementIndex = this.getAttribute("data-index"); // Gets the data-index attribute of the current span_close_multi element and stores it in a variable called ElementIndex
    modalparent[ElementIndex].style.display = "none"; // Hides the modalparent element with the same data-index attribute as the current span_close_multi element
    // Restore scrolling when the modal is closed
    document.body.style.overflow = "auto"; // Restores scrolling on the body element
  };
}

// When the user clicks anywhere outside of the modal, close it
window.onload = function () {
  // Runs the setDataIndex function when the window is loaded
  setDataIndex(); // Sets the data-index attribute on the modalparent, modal_btn_multi and span_close_multi elements
};
window.onclick = function (event) {
  // Closes the modal when the user clicks outside of it
  if (event.target === modalparent[event.target.getAttribute("data-index")]) {
    // If the user clicks outside of the modal
    modalparent[event.target.getAttribute("data-index")].style.display = "none"; // Hide the modal
    // Restore scrolling when clicking outside the modal
    document.body.style.overflow = "auto"; // Restores scrolling on the body element
  }
};
