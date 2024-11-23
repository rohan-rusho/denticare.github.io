const userBtn = document.querySelector('#user-btn');
userBtn.addEventListener('click', function(){
    const userBox = document.querySelector('.profile'); // Fixed quotes
    userBox.classList.toggle('active');
});

const toggle = document.querySelector('#menu-btn');
toggle.addEventListener('click', function(){
    const navbar = document.querySelector('.navbar'); // Fixed quotes
    navbar.classList.toggle('active');
});

const SearchForm = document.querySelector('.search-form');
document.querySelector('#search_service_btn').onclick = () => {
    SearchForm.classList.toggle('active');
};
