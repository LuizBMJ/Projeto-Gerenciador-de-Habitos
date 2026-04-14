//
// toast.js
// This file handles showing toast notifications (small popup messages)
// Toast types: success (green), error (red), warning (yellow)
// These appear at the bottom of the screen to give feedback to the user
//

// Timer for auto-hiding the toast
let toastTimeout = null;

// Icons for each toast type
const TOAST_ICONS = {
    success: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>`,
    error:   `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 256 256"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>`,
    warning: `<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 256 256"><path d="M236.8,188.09,149.35,36.22h0a24.76,24.76,0,0,0-42.7,0L19.2,188.09a23.51,23.51,0,0,0,0,23.72A24.35,24.35,0,0,0,40.55,224h174.9a24.35,24.35,0,0,0,21.33-12.19A23.51,23.51,0,0,0,236.8,188.09ZM222.93,203.8a8.5,8.5,0,0,1-7.48,4.2H40.55a8.5,8.5,0,0,1-7.48-4.2,7.59,7.59,0,0,1,0-7.72L120.52,44.21a8.75,8.75,0,0,1,15,0l87.45,151.87A7.59,7.59,0,0,1,222.93,203.8ZM120,144V104a8,8,0,0,1,16,0v40a8,8,0,0,1-16,0Zm20,36a12,12,0,1,1-12-12A12,12,0,0,1,140,180Z"></path></svg>`,
};

// CSS classes for each toast type (defined in app.css)
const TOAST_STYLES = {
    success: 'toast-success',
    error:   'toast-error',
    warning: 'toast-warning',
};

// Show a toast notification
// tipo: 'success', 'error', or 'warning'
// mensagem: the text message to display
window.mostrarToast = function(tipo, mensagem) {
    // Get toast elements
    const toast   = document.getElementById('toast');
    const message = document.getElementById('toast-message');
    const icon    = document.getElementById('toast-icon');

    if (!toast) return;

    // Clear any existing auto-hide timer
    if (toastTimeout) clearTimeout(toastTimeout);

    // Remove old toast styles
    toast.classList.remove('toast-success', 'toast-error', 'toast-warning');

    // Add the new style class
    toast.classList.add(...TOAST_STYLES[tipo].split(' '));
 
    // Update content
    if (icon)    icon.innerHTML    = TOAST_ICONS[tipo] ?? '';
    if (message) message.textContent = mensagem;

    // Show the toast with animation
    toast.classList.remove('hidden', 'opacity-0');
    void toast.offsetWidth; // Force reflow to enable animation
    toast.classList.add('opacity-100');

    // Auto-hide after 3 seconds
    toastTimeout = setTimeout(() => {
        toast.classList.remove('opacity-100');
        toast.classList.add('opacity-0');
        setTimeout(() => toast.classList.add('hidden'), 500);
    }, 3000);
};

// Show toast messages from server-side (Laravel session flash messages)
document.addEventListener("DOMContentLoaded", () => {

    const session = document.getElementById("toast-session");
    if (!session) return;

    // Get messages from data attributes
    const success = session.dataset.success;
    const warning = session.dataset.warning;
    const error   = session.dataset.error;

    // Show each type of message if it exists
    if (success) {
        mostrarToast("success", success);
    }

    if (warning) {
        mostrarToast("warning", warning);
    }

    if (error) {
        mostrarToast("error", error);
    }

});