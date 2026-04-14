//
// theme.js
// This file handles switching between light and dark theme
//

// Initialize theme toggle functionality
function initTheme() {
    // Get the toggle button and both icons
    const themeToggle = document.getElementById('theme-toggle');
    const darkIcon    = document.getElementById('theme-toggle-dark-icon');
    const lightIcon   = document.getElementById('theme-toggle-light-icon');

    // Get current theme from the HTML element
    const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';

    // Show the correct icon based on current theme
    if (currentTheme === 'dark') {
        darkIcon?.classList.remove('hidden');
        lightIcon?.classList.add('hidden');
    } else {
        lightIcon?.classList.remove('hidden');
        darkIcon?.classList.add('hidden');
    }

    // Exit if no toggle button on this page
    if (!themeToggle) return;

    // Handle clicking the theme toggle button
    themeToggle.addEventListener('click', () => {
        // Check current theme and switch to the opposite
        const isDark   = document.documentElement.getAttribute('data-theme') === 'dark';
        const newTheme = isDark ? 'light' : 'dark';

        // Apply the new theme to the HTML element
        document.documentElement.setAttribute('data-theme', newTheme);
        
        // Save preference to localStorage (persists across sessions)
        localStorage.setItem('theme', newTheme);

        // Update icon visibility
        if (newTheme === 'dark') {
            darkIcon?.classList.remove('hidden');
            lightIcon?.classList.add('hidden');
        } else {
            lightIcon?.classList.remove('hidden');
            darkIcon?.classList.add('hidden');
        }

        // Dispatch event so other parts of the app can respond
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: { theme: newTheme } }));

        // Provide haptic feedback on supported devices
        if (window.navigator.vibrate) {
            window.navigator.vibrate(5);
        }
    });
}

// Initialize when page is ready
document.addEventListener('DOMContentLoaded', initTheme);

// Expose to global scope
window.initTheme = initTheme;