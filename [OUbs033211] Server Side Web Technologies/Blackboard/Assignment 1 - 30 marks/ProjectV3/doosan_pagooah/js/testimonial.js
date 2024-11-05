// JavaScript for sliding testimonials

let currentTestimonialIndex = 0;
const testimonials = document.querySelectorAll('.testimonial-item');
const totalTestimonials = testimonials.length;

function showTestimonial(index) {
    // Hide all testimonials
    testimonials.forEach((testimonial, i) => {
        testimonial.style.display = i === index ? 'block' : 'none';
    });

    // Update indicator
    updateIndicator(index);
}

function previousTestimonial() {
    currentTestimonialIndex = (currentTestimonialIndex - 1 + totalTestimonials) % totalTestimonials;
    showTestimonial(currentTestimonialIndex);
}

function nextTestimonial() {
    currentTestimonialIndex = (currentTestimonialIndex + 1) % totalTestimonials;
    showTestimonial(currentTestimonialIndex);
}

function updateIndicator(index) {
    const indicators = document.querySelectorAll('.testimonial-indicator');
    indicators.forEach((indicator, i) => {
        indicator.style.backgroundColor = i === index ? 'black' : '#bbb';
    });
}

// Initialize the first testimonial
showTestimonial(currentTestimonialIndex);
