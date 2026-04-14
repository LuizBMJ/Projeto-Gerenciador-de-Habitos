//
// habitSettings.js
// This file handles the settings page for managing habits
//

import { ICONS } from './icons.js';

// State to keep track of settings page data
let settingsState = {
    list: null,
    toggleUrl: '',
    editUrl: '',
    deleteUrl: '',
    initialized: false
};

// Get the CSRF token from the page
function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]').content;
}

// Initialize the settings page
export function initSettings() {
    const list = document.getElementById('habit-list');
    if (!list) return;
    
    // Don't initialize twice
    if (settingsState.initialized) return;
    settingsState.initialized = true;
    
    // Store URLs and list reference
    settingsState.list = list;
    settingsState.toggleUrl = list.dataset.toggleUrl;
    settingsState.editUrl = list.dataset.editUrl;
    settingsState.deleteUrl = list.dataset.deleteUrl;
    
    // Set up event listeners
    setupEventListeners();
    syncSelectAllCheckbox();
    syncDeleteBtn();
}

// Set up checkbox change handlers
function setupEventListeners() {
    const list = settingsState.list;
    if (!list) return;
    
    // Listen for checkbox changes
    list.addEventListener('change', (e) => {
        const cb = e.target.closest('.habit-checkbox');
        if (!cb) return;
        
        // Update UI states
        syncSelectAllCheckbox();
        syncDeleteBtn();
    });
    
    // Handle "select all" checkbox
    const selectAllCb = document.getElementById('select-all-checkbox');
    if (selectAllCb) {
        selectAllCb.addEventListener('change', async () => {
            const shouldCheck = selectAllCb.checked;
            const checkboxes = [...list.querySelectorAll('.habit-checkbox')];
            
            // Check/uncheck all
            checkboxes.forEach(cb => { cb.checked = shouldCheck; });
            syncDeleteBtn();
        });
    }
}

// Update the "select all" checkbox state
function syncSelectAllCheckbox() {
    const selectAll = document.getElementById('select-all-checkbox');
    if (!selectAll) return;
    
    const list = settingsState.list;
    if (!list) return;
    
    const all = list.querySelectorAll('.habit-checkbox');
    const checked = list.querySelectorAll('.habit-checkbox:checked');
    selectAll.indeterminate = checked.length > 0 && checked.length < all.length;
    selectAll.checked = all.length > 0 && checked.length === all.length;
}

// Show/hide the delete button based on whether any habits are selected
function syncDeleteBtn() {
    const deleteBtn = document.getElementById('delete-selected-btn');
    if (!deleteBtn) return;
    
    const list = settingsState.list;
    if (!list) return;
    
    const anyChecked = list.querySelectorAll('.habit-checkbox:checked').length > 0;
    // Show button when something is checked
    deleteBtn.classList.toggle('hidden', !anyChecked);
    deleteBtn.classList.toggle('flex', anyChecked);
}

// Delete all selected habits
// This is called from the delete button
window.deleteSelectedHabits = async function() {
    const list = settingsState.list;
    if (!list) return;
    
    const checked = [...list.querySelectorAll('.habit-checkbox:checked')];
    
    // Check if anything is selected
    if (checked.length === 0) {
        mostrarToast('error', 'No habit selected.');
        return;
    }
    
    // Disable button and show loading state
    const btn = document.getElementById('delete-selected-btn');
    if (btn) { btn.disabled = true; btn.innerHTML = `${ICONS.trash} Deleting...`; }
    
    const deleteUrl = settingsState.deleteUrl;
    const ids = checked.map(cb => cb.dataset.id);
    let successCount = 0;
    let errorCount = 0;
    
    // Delete all selected habits at once
    await Promise.all(ids.map(async (id) => {
        try {
            const res = await fetch(`${deleteUrl}/${id}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken(),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ _method: 'DELETE' }),
            });
            if (!res.ok) throw new Error('Delete failed');
            // Remove the habit from the list
            const li = list.querySelector(`li[data-id="${id}"]`);
            if (li) li.remove();
            successCount++;
        } catch (e) {
            console.error(`Failed to delete habit ${id}:`, e);
            errorCount++;
        }
    }));
    
    // Reset select all checkbox
    const selectAll = document.getElementById('select-all-checkbox');
    if (selectAll) { selectAll.checked = false; selectAll.indeterminate = false; }
    
    // Reset button state
    if (btn) {
        btn.disabled = false;
        btn.innerHTML = `${ICONS.trash} Delete selected`;
        btn.classList.add('hidden');
        btn.classList.remove('flex');
    }
    
    // Show toast message based on results
    if (errorCount === 0) {
        mostrarToast('success', `${successCount} habit(s) deleted!`);
    } else if (successCount === 0) {
        mostrarToast('error', 'Error deleting habits.');
    } else {
        mostrarToast('warning', `${successCount} deleted, ${errorCount} with error.`);
    }
    
    // If all habits are deleted, show the empty state
    if (list.querySelectorAll('.habit-item').length === 0) {
        const noResults = document.getElementById('no-results');
        const searchWrapper = document.getElementById('search-wrapper');
        if (noResults) noResults.classList.remove('hidden');
        if (searchWrapper) {
            const view = settingsState.list?.dataset.view;
            if (view === 'settings') searchWrapper.classList.add('hidden');
        }
    }
};

// Export for use in other files
export { settingsState };