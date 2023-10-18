var darkBackground = document.querySelector(".dark-background");
var navbar = document.querySelector(".navbar_main");

function handleNavbarScroll1() {
  var windowHeight = window.innerHeight;
  var scrollPosition = window.scrollY;

  var darkBackgroundHeight = darkBackground.offsetHeight;
  var darkBackgroundTop = darkBackground.offsetTop;

  var triggerPosition1 = darkBackgroundTop + (darkBackgroundHeight * 0.9);

  if (scrollPosition >= triggerPosition1) {
    navbar.classList.add("navbar_scroll");
  } else {
    navbar.classList.remove("navbar_scroll");
  }
}

window.addEventListener("scroll", handleNavbarScroll1);
window.addEventListener("resize", handleNavbarScroll1);

const navbarBurger = document.querySelector('.navbar_burger');
const navbarburgerback = document.querySelector('.navbar_burger_back');
const navbarMenu = document.querySelector('.navbar_menu');
const navbarOverlay = document.querySelector('.navbar_overlay');

navbarBurger.addEventListener('click', () => {
  navbarMenu.classList.toggle('active');
  navbarOverlay.classList.toggle('active');
});

navbarburgerback.addEventListener('click', () => {
  navbarMenu.classList.remove('active');
  navbarOverlay.classList.remove('active');
});

navbarOverlay.addEventListener('click', () => {
  navbarMenu.classList.remove('active');
  navbarOverlay.classList.remove('active');
});