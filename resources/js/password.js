//
// password.js
// This file handles toggling password visibility
// Shows/hides the password when clicking the eye icon
//

// Toggle between password (dots) and text visibility
// id: the ID of the input element
// button: the button element that was clicked
window.togglePassword = function(id, button) {
    const input = document.getElementById(id);

    // Get the open and closed eye icons inside the button
    const eyeOpen = button.querySelector(".eye-open");
    const eyeClosed = button.querySelector(".eye-closed");

    // Toggle between password and text type
    if (input.type === "password") {
        input.type = "text";

        // Show the open eye, hide the closed eye
        eyeOpen.classList.add("hidden");
        eyeClosed.classList.remove("hidden");

    } else {
        input.type = "password";

        // Show the closed eye, hide the open eye
        eyeOpen.classList.remove("hidden");
        eyeClosed.classList.add("hidden");
    }
}