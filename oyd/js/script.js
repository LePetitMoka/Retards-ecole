function showVericalNavbar () {
  let btn = document.querySelector('.burger');
  const burgerContainer = document.querySelector('header .burger-bar');
  const verticalNavbar = document.querySelector('.vertical-navbar');

  console.log(btn);
  console.log("entered function");

  btn.addEventListener('click', () => {
    burgerContainer.classList.toggle('burgerAnim');
    console.log("burger anim");
    verticalNavbar.classList.toggle('show-vnav');
    console.log("show nav");
  })
}

showVericalNavbar();