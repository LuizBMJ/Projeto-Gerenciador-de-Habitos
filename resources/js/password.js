window.togglePassword = function(id, button) {
    const input = document.getElementById(id);

    const eyeOpen = button.querySelector(".eye-open");
    const eyeClosed = button.querySelector(".eye-closed");

    if (input.type === "password") {
        input.type = "text";

        eyeOpen.classList.add("hidden");
        eyeClosed.classList.remove("hidden");

    } else {
        input.type = "password";

        eyeOpen.classList.remove("hidden");
        eyeClosed.classList.add("hidden");
    }
}