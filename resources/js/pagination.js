//
// pagination.js
// This file initializes the habit list based on which page we're on
// It loads the right functionality for dashboard, settings, or calendar pages
//

import { initSearch, filterHabits, resetHabitManager } from './habitSearch.js';
import { initHabitManager } from './habitManager.js';

// Initialize when the page loads
document.addEventListener('DOMContentLoaded', () => {
    const list = document.getElementById('habit-list');
    if (!list) return;
    
    // Get the current view type from the data attribute
    const view = list.dataset.view;
    
    // Dashboard view: initialize both manager and search
    if (view === 'dashboard') {
        initHabitManager();
        initSearch(list);
    }
    
    // Settings view: only need search
    if (view === 'settings') {
        initSearch(list);
    }
});

// Expose functions to global scope for use in inline handlers
window.initHabitPagination = initHabitManager;
window.filterHabits = filterHabits;
window.resetHabitManager = resetHabitManager;