"use strict";

// Show or hide the back-to-top button based on scroll
const backToTopBtn = document.getElementById("backToTop");

window.onscroll = function () {
  if (
    document.body.scrollTop > 200 ||
    document.documentElement.scrollTop > 200
  ) {
    backToTopBtn.classList.add("show"); // Show button after scrolling 200px
  } else {
    backToTopBtn.classList.remove("show"); // Hide button at the top
  }
};

// Scroll back to the top smoothly
backToTopBtn.addEventListener("click", function (event) {
  event.preventDefault();
  window.scrollTo({ top: 0, behavior: "smooth" });
});

// Set a timeout to hide the alert after 5 seconds
setTimeout(function () {
  let alert = document.getElementById("alert-message");
  if (alert) {
    alert.classList.remove("show"); // Remove the Bootstrap 'show' class to trigger fade-out
    setTimeout(() => alert.remove(), 150); // After fade-out, remove from DOM
  }
}, 5000); // 5000 milliseconds = 5 seconds

// Get all navigation links
// const navLinks = document.querySelectorAll(".nav-link");

// Add click event listener to each link
// navLinks.forEach((link) => {
//   link.addEventListener("click", function () {
//     // Remove active class from all links
//     navLinks.forEach((nav) => nav.classList.remove("active"));

//     // Add active class to the clicked link
//     this.classList.add("active");
//   });
// });

// // Optionally, set the initial active link based on the current URL hash
// const currentHash = window.location.hash;
// if (currentHash) {
//   navLinks.forEach((nav) => {
//     if (nav.getAttribute("href") === currentHash) {
//       nav.classList.add("active");
//     }
//   });
// }
