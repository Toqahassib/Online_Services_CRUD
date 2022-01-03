

$(document).ready(function(){

    // rotate the menu icon when clicked on it
    $('.fa-bars').click(function(){
        $(this).toggleClass('fa-times');

        // drop the menu
        $('.navbar').toggleClass('nav-toggle');
    });

    $(window).on('load scroll', function(){
        $('.fa-bars').removeClass('fa-times');
        $('.navbar').removeClass('nav-toggle');

    // change color of navbar when scrolling
    if ($(window).scrollTop() > 30) {
        $('.header').css({'background':'#2d3032', 'box-shadow':'0 0.2rem 0.5rem rgba(0,0,0,.4)'});
    }
    else{
        $('.header').css({'background':'none', 'box-shadow':'none'});
    }
    });
});

// Scroll to top
const scrolltop = document.querySelector("#scrolltop");
scrolltop.addEventListener("click", function () {
  window.scrollTo({
    top: 0,
    left: 0,
    behavior: "smooth",
  });
});
window.addEventListener("scroll", function () {
  if (window.scrollY >= 700) {
    scrolltop.style.opacity = 1;
  } else {
    scrolltop.style.opacity = 0;
  }
});


// Theme

const themeToggle = document.querySelector(".checkbox");
const body = document.querySelector("body");

// dark mode will stay after refreshing the page
const darkmode = localStorage.getItem("dark");

if (darkmode) {
  body.classList.add("dark");
  themeToggle.checked = true;
}

themeToggle.addEventListener("change", function () {
  body.classList.toggle("dark");

  if (body.classList.contains("dark")) {

    // dark mode will stay after refreshing the page
    localStorage.setItem("dark", "active");
  } else {
    localStorage.removeItem("dark");
  }
});


