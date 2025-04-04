// const header = document.querySelector('header');

// function fixedNavbar() {
//     header.classList.toggle('scrolled', window.pageYOffset > 0);
// }

// fixedNavbar();
// window.addEventListener('scroll', fixedNavbar);

// let menu = document.querySelector('#menu-btn');
// let userBtn = document.querySelector('#user-btn');

// menu.addEventListener('click', function() {
//     let nav = document.querySelector('.navbar');
//     nav.classList.toggle('active');
// });

// userBtn.addEventListener('click', function() {
//     let userBox = document.querySelector('.user-box');
//     userBox.classList.toggle('active');
// });


const header = document.querySelector('header');

// Toggle scrolled class on header when scrolling
function fixedNavbar() {
    header.classList.toggle('scrolled', window.pageYOffset > 0);
}

fixedNavbar();
window.addEventListener('scroll', fixedNavbar);

// Toggle navbar on menu button click
let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

menu.addEventListener('click', function () {
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');
});

// Toggle user box on user button click
userBtn.addEventListener('click', function () {
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
});

// Close navbar and user box when clicking outside
document.addEventListener('click', function (event) {
    let nav = document.querySelector('.navbar');
    let userBox = document.querySelector('.user-box');

    if (!event.target.closest('#menu-btn') && !event.target.closest('.navbar')) {
        nav.classList.remove('active');
    }

    if (!event.target.closest('#user-btn') && !event.target.closest('.user-box')) {
        userBox.classList.remove('active');
    }
});

let closeBtn = document.querySelector('#close-form');

closeBtn.addEventListener('click', () => {
    document.querySelector('.update-container').style.display = 'none';
});
