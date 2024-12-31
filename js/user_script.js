// Profile Dropdown Toggle
const userBtn = document.querySelector('#user-btn');
userBtn.addEventListener('click', function () {
    const userBox = document.querySelector('.profile-detail');
    userBox.classList.toggle('active');
})

// Navbar Toggle
const toggle = document.querySelector('#menu-btn');
toggle.addEventListener('click', function () {
    const navbar = document.querySelector('.navbar');
    navbar.classList.toggle('active');
});

// Search Form Toggle
const SearchForm = document.querySelector('.search-form');
document.querySelector('#search_service_btn').onclick = () => {
    SearchForm.classList.toggle('active');
};
/*..............testimonial-item..............*/
let slide = document.querySelectorAll('.testimonial-item');
let index = 0;

function rightSlide() {
    slide[index].classList.remove('active');
    index = (index + 1) % slide.length;
    slide[index].classList.add('active');
}

function leftSlide() {
    slide[index].classList.remove('active');
    index = (index - 1 + slide.length) % slide.length;
    slide[index].classList.add('active');
}
function logoutConfirm() {
    if (confirm('Logout from this website?')) {
        window.location.href = 'component/logout.php'; // Redirect to logout.php
        return true;
    } else {
        return false; // Prevent the link from working if not confirmed
    }
}