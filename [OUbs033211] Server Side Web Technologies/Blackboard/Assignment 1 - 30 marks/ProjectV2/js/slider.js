document.addEventListener("DOMContentLoaded", () => {
    const nextButton = document.querySelector('.next-btn');
    const prevButton = document.querySelector('.prev-btn');

    nextButton.addEventListener('click', nextSlide);
    prevButton.addEventListener('click', previousSlide);
});

let currentIndex = 0; // Starting at the first slide
let slides = document.querySelectorAll('.slide');
const totalSlides = slides.length;

function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides; // Go to the next slide or back to start
    updateSliderPosition();
}

function previousSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides; // Go to the previous slide
    updateSliderPosition();
}

function updateSliderPosition() {
    const sliderWrapper = document.querySelector('.slider-wrapper');
    sliderWrapper.style.transform = `translateX(-${currentIndex * 100}%)`; // Move the slider
}
