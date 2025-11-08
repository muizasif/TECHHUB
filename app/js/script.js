//pre loaddder 

const loadder = document.getElementById("preloadder");

window.addEventListener("load",()=>{
    loadder.style.display = "none";
});

//sticky navbar 

window.addEventListener('scroll',function(){
    const header = document.querySelector('header');
    header.classList.toggle("sticky",window.scrollY > 0);
  
})

// nav bar 
const header = document.getElementById('header');
const toggle = document.getElementById('toggle');
const navbar = document.getElementById('primary-navbar');

document.onclick = function(e){
    if(e.target.id !== 'header' && e.target.id !== 'toggle' && e.target.id !== 'primary-navbar' ){
        toggle.classList.remove('active');
        navbar.classList.remove('active');
    };
};

toggle.addEventListener('click',()=>{
    toggle.classList.toggle('active');
    navbar.classList.toggle('active');
})


// faq 

const acc = document.getElementsByClassName('accordian_item');

for(i=0;i<acc.length;i++){
    acc[i].addEventListener("click",function(){
        this.classList.toggle('active');
    });
};
let currentIndex = 0;

const carousel = document.querySelector('.carousel');
const cards = document.querySelectorAll('.review-card');
const totalCards = cards.length;

document.querySelector('.prev').addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
        updateCarousel();
    }
});

document.querySelector('.next').addEventListener('click', () => {
    if (currentIndex < totalCards - 1) {
        currentIndex++;
        updateCarousel();
    }
});

function updateCarousel() {
    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
}
