# Technical Documentation for the HTML Homepage

## **Overview**
This document explains the structure and functionality of the homepage HTML file. The page is designed to present a personal portfolio or e-commerce page, showcasing ebooks and cloud solutions. It integrates sections for projects, skills, a blog, testimonials, and a call-to-action, while also implementing a dark mode toggle for user comfort. Additionally, it includes client-side scripting for user interaction and an external CSS file for styling.

---

## **HTML Structure**

### **1. HTML Doctype & Language Declaration**
```html
<!DOCTYPE html>
<html lang="en">
```
The document is HTML5, and the language is set to English (`lang="en"`).

---

### **2. Head Section**
```html
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage : Doosan</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"
        rel="stylesheet">
</head>
```
- **Meta Tags**: The `meta charset` defines the character encoding as UTF-8, and `meta viewport` ensures the page is responsive across devices.
- **Title**: The page title is set to “Homepage : Doosan.”
- **External Stylesheet**: The page links to an external CSS file (`styles.css`), responsible for styling the page.
- **Font**: The "Space Mono" font is loaded from Google Fonts for typography.
- **JavaScript**: An embedded script shows an alert about the dark mode feature when the page loads.

---

### **3. Body Section**

#### **Header and Navigation**
```html
<header>
    <nav class="no-dark-mode">
        <div class="logo">CloudNext</div>
        <ul>
            <li><a href="index.html" class="active">Home/</a></li>
            <li><a href="html/about-me.html">About.Us/</a></li>
            <li><a href="html/projects.html">Ebooks/</a></li>
            <li><a href="#services">My.Cart/</a></li>
            <li><a href="html/contact-me.html">Contact.Me/</a></li>
            <li><a href="#blog">Sign.In/</a></li>
            <li><a href="#" class="dark-mode-toggle"></a></li>
        </ul>
    </nav>
</header>
```
- **Logo**: The logo text "CloudNext" represents the site brand.
- **Navigation Links**: The navigation includes links to various sections of the site, including Home, About, Ebooks, My Cart, Contact, Sign In, and a button for dark mode toggle.

#### **Slider Section**
```html
<section id="home" class="home-section slider">
    <!-- Slider Wrapper -->
    <div class="slider-wrapper">
        <div class="slide">
            <div class="home-content">
                <h1>Solutions Architect's Handbook</h1>
                <p>...</p>
                <a href="html/about-me.html" class="btn about-link">Read More</a>
                <a href="#portfolio" class="btn">Add to Cart</a>
            </div>
            <img src="images/profile-pic-6.png" alt="Profile Picture" class="profile-pic">
        </div>
        <!-- Additional slides... -->
    </div>
    <button class="slider-btn prev-btn"><img src="images/left-arrow.png" alt="Previous"></button>
    <button class="slider-btn next-btn"><img src="images/right-arrow.png" alt="Next"></button>
</section>
```
- **Slider**: Displays different books or content with descriptions. Each slide includes text, images, and navigation buttons (Previous/Next) to toggle between slides.
- **Call to Action Buttons**: Buttons to “Read More” or “Add to Cart.”

---

#### **Skills Section**
```html
<section id="skills">
    <div class="skill-item">
        <h2>Technical Competencies</h2>
        <p>Proficient in programming languages, DevOps tools, and cloud services.</p>
        <a href="assets/resume.pdf" download>Download CV</a>
    </div>
    <!-- Additional skill items... -->
</section>
```
- **Skills Display**: Highlights technical competencies and expertise. Includes a downloadable resume (PDF).

---

#### **Projects Section**
```html
<section id="projects">
    <h1>Notable Cloud Engineering Ebooks</h1>
    <div class="projects-grid">
        <div class="project-item">
            <h3>Google Cloud Associate Cloud Engineer Certification</h3>
            <p>...</p>
            <a href="html/project-article.html" class="btn">Add to Cart ›</a>
        </div>
    </div>
</section>
```
- **Project Cards**: Each project displays a book or resource with a description and a button to add it to the cart.

---

#### **Blog Section**
```html
<section id="blog">
    <h1>Explore the Bestsellers Cloud Ebooks</h1>
    <div class="blog-grid">
        <div class="blog-entry">
            <img src="images/books/61etgGVEh7L._SL1360_.jpg" alt="Generative AI for Cloud Solutions">
            <h3>Generative AI for Cloud Solutions</h3>
            <p>...</p>
            <a href="#blog-entry-1" class="btn">Add to Cart ›</a>
        </div>
    </div>
</section>
```
- **Blog Entries**: Displays various articles or resources for users to explore, including buttons to add items to the cart.

---

#### **Testimonials Section**
```html
<section id="testimonials">
    <div class="testimonial-container">
        <button class="testimonial-nav previous"></button>
        <button class="testimonial-nav next"></button>
        <div class="testimonial-item">
            <div class="testimonial-rating">★★★★★</div>
            <blockquote>...</blockquote>
            <div class="testimonial-author">
                <p>Jordan S.</p>
            </div>
        </div>
    </div>
</section>
```
- **Testimonials**: Displays user feedback or reviews with navigation buttons to switch between testimonials.

---

#### **Call-to-Action Section**
```html
<section id="cta">
    <div class="cta-content">
        <h2>Transform your projects with DevOps</h2>
        <p>Unlock the power of DevOps for your business.</p>
    </div>
    <div class="cta-buttons">
        <button class="btn">Hire me</button>
        <button class="btn">Read More</button>
    </div>
</section>
```
- **Call to Action**: Encourages users to engage with the services offered (e.g., Hire or Learn More).

---

#### **Footer Section**
```html
<footer class="footer">
    <div class="footer-logo"><a href="#"><img src="images/devops.png" alt="devOps"></a></div>
    <div class="footer-column">...</div>
    <div class="footer-social">...</div>
    <p>&copy; 2024 Doosan. All rights reserved.</p>
</footer>
```
- **Footer**: Contains social media links, additional navigation, and copyright information.

---

### **JavaScript Functionality**
```html
<script>
    document.addEventListener('DOMContentLoaded', function () {
        alert('Welcome ! This website offers a dark mode...');
    });

    const darkModeToggle = document.querySelector('.dark-mode-toggle');
    darkModeToggle.addEventListener('click', function () {
        document.body.classList.toggle('dark-mode');
    });
</script>
```
- **Dark Mode**: JavaScript toggles a dark mode class on the body when the user clicks the toggle button.
- **Alerts**: An alert informs users about the dark mode upon page load.

---

### **External Scripts**
```html
<script src="js/testimonial.js"></script>
<script src="js/slider.js"></script>
<script src="js/theme.js"></script>
```
- **Testimonial, Slider, and Theme Scripts**: External JavaScript files handle the functionality for testimonials, slider navigation, and theme toggling.

---

## **Conclusion**
This homepage is a fully-featured landing page for promoting ebooks and cloud services. It includes essential sections for content presentation, user engagement, and a user-friendly interface with dark mode capability. External CSS and JavaScript files enhance the appearance and interactivity of the page.