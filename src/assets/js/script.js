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


var home = $('#home-btn');
var about = $('#about-btn');
var review = $('#review-btn');
var contact = $('#contact-btn');

$(window).scroll(function () {
  if ($(window).scrollTop() > 0) {
    home.addClass('home-color');
    home.removeClass('home-color2');
  } else {
    home.removeClass('home-color');
    home.addClass('home-color2');
  }
});
$(window).scroll(function () {
  if ($(window).scrollTop() > 530) {
    home.removeClass('home-color');
    home.addClass('home-color2');
    about.addClass('about-color');
    about.removeClass('about-color2');
  } else {
    about.removeClass('about-color');
    about.addClass('about-color2');
  }
});
$(window).scroll(function () {
  if ($(window).scrollTop() > 1100) {
    about.removeClass('about-color');
    about.addClass('about-color2');
    review.addClass('review-color')
    review.removeClass('review-color2')
  } else {
    review.removeClass('review-color')
    review.addClass('review-color2')
  }
});
$(window).scroll(function () {
  if ($(window).scrollTop() > 1290) {
    review.removeClass('review-color');
    review.addClass('review-color2');
    contact.addClass('contact-color')
    contact.removeClass('contact-color2')
  } else {
    contact.removeClass('contact-color')
    contact.addClass('contact-color2')
  }
});