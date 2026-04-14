//
// habitSearch.js
// This file handles searching and filtering habits
//

import { renderHabit } from './habitManager.js';
import { initSettings } from './habitSettings.js';

// State to keep track of search status
let searchState = {
    loading: false,
    paginateUrl: '',
    list: null,
    view: ''
};

// Get the CSRF token from the page
function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]').content;
}

// Initialize search functionality for the habit list
export function initSearch(listElement) {
    if (!listElement) return;
    
    // Store references to list element and its data
    searchState.list = listElement;
    searchState.paginateUrl = listElement.dataset.paginateUrl;
    searchState.view = listElement.dataset.view;
    
    // Don't initialize twice
    if (listElement.dataset.searchInitialized === 'true') return;
    listElement.dataset.searchInitialized = 'true';
    
    // Load habits initially
    loadHabits();
}

// Load habits from the server with optional search filter
// This fetches habits from the server and renders them
async function loadHabits(search = '') {
    // Prevent multiple simultaneous requests
    if (searchState.loading) return;
    searchState.loading = true;
    
    const list = searchState.list;
    const view = searchState.view;
    const paginateUrl = searchState.paginateUrl;
    
    try {
        // Fetch habits from the server
        const res = await fetch(`${paginateUrl}?search=${encodeURIComponent(search)}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });
        const data = await res.json();
        
        // Clear the current list and add new habits
        list.innerHTML = '';
        data.habits.forEach(habit => {
            list.insertAdjacentHTML('beforeend', renderHabit(habit));
        });
        
        // Show/hide search elements based on habit count
        const searchWrapper = document.getElementById('search-wrapper');
        const searchInputWrapper = document.getElementById('search-input-wrapper');
        const selectAllWrapper = document.getElementById('select-all-wrapper');
        const noResults = document.getElementById('no-results');
        
        const allCount = data.all_count ?? 0;
        const filteredCount = data.total ?? 0;
        
        // Show search wrapper on dashboard always, otherwise only if there are habits
        if (searchWrapper) {
            if (view === 'dashboard') {
                searchWrapper.classList.remove('hidden');
            } else {
                searchWrapper.classList.toggle('hidden', allCount === 0);
            }
        }
        
        // Hide search input and select all if there's only 0 or 1 habit
        if (searchInputWrapper) searchInputWrapper.classList.toggle('hidden', allCount <= 1 && !search);
        if (selectAllWrapper) selectAllWrapper.classList.toggle('hidden', allCount <= 1 && !search);
        if (noResults) noResults.classList.toggle('hidden', filteredCount > 0);
        
        // Initialize settings after loading (for settings view)
        if (view === 'settings') {
            initSettings();
        }
        
        // Update the select all checkbox state
        syncSelectAllCheckbox();
    } catch (e) {
        console.error('Failed to load habits:', e);
    } finally {
        searchState.loading = false;
    }
}

// Update the "select all" checkbox based on current selections
function syncSelectAllCheckbox() {
    const list = searchState.list;
    if (!list) return;
    
    const selectAll = document.getElementById('select-all-checkbox');
    if (!selectAll) return;
    
    const all = list.querySelectorAll('.habit-checkbox');
    const checked = list.querySelectorAll('.habit-checkbox:checked');
    selectAll.indeterminate = checked.length > 0 && checked.length < all.length;
    selectAll.checked = all.length > 0 && checked.length === all.length;
}

// Filter habits by search text
// Called when user types in the search input
export function filterHabits(value) {
    loadHabits(value);
}

// Reset and reload all habits (clears search)
export function resetHabitManager() {
    loadHabits();
}