//Load footer
$(function () {
    $("#footer").load("assets/content/static/footer.html");
});

let menu = document.querySelector('#menu-bars');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
  menu.classList.toggle('fa-times');
  navbar.classList.toggle('active');
}

window.onscroll = () => {
  menu.classList.remove('fa-times');
  navbar.classList.remove('active');
}

var swiper = new Swiper(".home-slider", {
  spaceBetween: 30,
  centeredSlides: true,
  autoplay: {
    delay: 3500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  loop: true,
});

// Navbar scroll animation
$(window).scroll(function () {
  if ($(document).scrollTop() > 60) {
    $(".nav-bar").addClass("affix");
  } else {
    $(".nav-bar").removeClass("affix");
  }
});

// Back to Top button 
var btn = $('#backToTop');
$(window).scroll(function () {
  if ($(window).scrollTop() > 80) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});
btn.on('click', function (e) {
  e.preventDefault();
  $('html, body').animate({
    scrollTop: $('#home').offset().top
  }, 'slow');
});

// Home button click animation
var home = $('#home-btn');
home.on('click', function (e) {
  e.preventDefault();
  $('html, body').animate({
    scrollTop: $('#home').offset().top
  }, 'slow');
});
