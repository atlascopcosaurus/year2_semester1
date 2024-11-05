const darkModeToggle = document.querySelector('.dark-mode-toggle');
const bodyElement = document.body;
const darkModeStylesheet = document.createElement('link'); // Create link element

darkModeStylesheet.href = 'css/styles_dark.css';
darkModeStylesheet.rel = 'stylesheet';

darkModeToggle.addEventListener('click', function () {
    bodyElement.classList.toggle('dark-mode'); // Toggle 'dark-mode' class on body

    // Update toggle background image and text based on class presence
    if (bodyElement.classList.contains('dark-mode')) {
        darkModeToggle.textContent = ''; // Remove any existing text content
        darkModeToggle.classList.add('active'); // Add 'active' class for dark image
        document.head.appendChild(darkModeStylesheet);
    } else {
        darkModeToggle.textContent = ''; // Remove any existing text content
        darkModeToggle.classList.remove('active'); // Remove 'active' class for light image
        document.head.removeChild(darkModeStylesheet); // Optional: remove dark stylesheet
    }
});
