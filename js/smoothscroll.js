document.addEventListener("DOMContentLoaded", function() {
    // Select all navigation links
    const navLinks = document.querySelectorAll('nav ul li a');

    // Add click event listener to each navigation link
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default anchor behavior

            // Get the target element id from href attribute
            const targetId = this.getAttribute('href').substring(1);

            // Get the target element
            const targetElement = document.getElementById(targetId);

            // Scroll to the target element with smooth behavior
            targetElement.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
