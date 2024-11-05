document.getElementById('contact-form').addEventListener('submit', function (event) {
    var isValid = true;
    var name = document.getElementById('name').value.trim();
    var email = document.getElementById('email').value.trim();
    var message = document.getElementById('message').value.trim();
    var terms = document.getElementById('terms').checked;

    if (!name) {
        alert('Please enter your name.');
        isValid = false;
    } else if (!email || !email.includes('@')) { // Simple validation for example purposes
        alert('Please enter a valid email address.');
        isValid = false;
    } else if (!message) {
        alert('Please enter your message.');
        isValid = false;
    } else if (!terms) {
        alert('You must agree to the terms.');
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault(); // Prevent form submission if validation fails
    }
});