//
// habitManager.js
// This file handles displaying and toggling habits on the dashboard
//

import { ICONS } from './icons.js';

// State to keep track of habit list and settings
let managerState = {
    list: null,
    view: '',
    toggleUrl: '',
    initialized: false
};

// Get the CSRF token from the page (required for POST requests)
function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]').content;
}

// Create the HTML for a single habit item
// Returns a string of HTML based on the current view (dashboard or settings)
export function renderHabit(habit) {
    const view = managerState.view;
    
    // View for the main dashboard
    if (view === 'dashboard') {
        return `
            <li class="glass-card mb-3 p-4 md:p-4 habit-item flex flex-col gap-3 group" data-id="${habit.id}" data-name="${habit.name.toLowerCase()}">
                <div class="ripple-effect top-1/2 left-8 -translate-y-1/2 w-12 h-12"></div>
                <div class="flex items-center justify-between z-10 relative">
                    <div class="flex items-center gap-4 w-full">
                        <input type="checkbox" class="habit-checkbox checkbox-animate w-7 h-7 md:w-6 md:h-6 appearance-none border-[2.5px] border-brand-blue rounded-full checked:bg-brand-blue checked:border-brand-blue cursor-pointer relative after:content-[''] after:absolute after:top-[40%] after:left-[50%] after:-translate-x-1/2 after:-translate-y-1/2 after:w-[6px] after:h-[11px] md:after:w-[6px] md:after:h-[10px] after:border-r-2 after:border-b-2 after:border-white after:rotate-45 after:opacity-0 checked:after:opacity-100 transition-all flex-shrink-0"
                            data-id="${habit.id}"
                            ${habit.wasCompletedToday ? 'checked' : ''}>
                        <p class="font-semibold text-[1.125rem] md:text-[1.05rem] text-text-primary tracking-tight group-hover:text-brand-blue transition-colors flex-1 cursor-pointer select-none" onclick="this.previousElementSibling.click()">${habit.name}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-[0.95rem] md:text-[0.9rem] font-bold text-brand-orange bg-brand-orange-light border border-brand-orange/20 px-3 py-1.5 md:px-2 md:py-0.5 rounded-lg md:rounded-md flex items-center gap-1.5 md:gap-1 shadow-sm">
                            <span>${ICONS.streak}</span> 
                            <span class="streak-count">${habit.streak || 0}</span>
                        </span>
                    </div>
                </div>
            </li>`;
    }
    
    // View for the settings page
    if (view === 'settings') {
        const editUrl = managerState.list?.dataset?.editUrl || '';
        const deleteUrl = managerState.list?.dataset?.deleteUrl || '';
        
        return `
            <li class="glass-card mb-3 p-4 habit-item flex flex-col gap-3 group relative z-10"
                data-id="${habit.id}"
                data-name="${habit.name.toLowerCase()}"> 
                <div class="flex flex-nowrap items-center justify-between z-10 relative gap-3">
                    <div class="flex items-center gap-3.5 w-full sm:w-auto flex-1">
                        <input type="checkbox" class="habit-checkbox checkbox-animate w-6 h-6 appearance-none border-2 border-brand-blue rounded-full checked:bg-brand-blue checked:border-brand-blue cursor-pointer relative after:content-[''] after:absolute after:top-[40%] after:left-[50%] after:-translate-x-1/2 after:-translate-y-1/2 after:w-[6px] after:h-[10px] after:border-r-2 after:border-b-2 after:border-white after:rotate-45 after:opacity-0 checked:after:opacity-100 transition-all flex-shrink-0"
                            data-id="${habit.id}">
                        <p class="font-semibold text-[1.05rem] text-text-primary tracking-tight group-hover:text-brand-blue transition-colors flex-1 cursor-pointer select-none" onclick="this.previousElementSibling.click()">${habit.name}</p>
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto justify-end sm:ml-0">
                        <a href="${editUrl}/${habit.id}/edit"
                            class="flex items-center justify-center bg-surface-secondary text-text-secondary rounded-xl p-1.5 hover:bg-brand-blue hover:text-white transition-all duration-200 shadow-sm border border-border border-b-[2px] active:translate-y-[1px] active:border-b">
                            ${ICONS.update}
                        </a>
                        <form action="${deleteUrl}/${habit.id}" method="POST" class="m-0">
                            <input type="hidden" name="_token" value="${csrfToken()}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit"
                                class="flex items-center justify-center bg-surface-secondary text-error rounded-xl p-1.5 hover:bg-error hover:text-white transition-all duration-200 shadow-sm border border-border border-b-[2px] cursor-pointer active:translate-y-[1px] active:border-b">
                                ${ICONS.trash}
                            </button>
                        </form>
                    </div>
                </div>
            </li>`;
    }
    
    return '';
}

// Initialize the habit manager
// Sets up event listeners and renders the habit list
export function initHabitManager() {
    const list = document.getElementById('habit-list');
    if (!list) return;
    
    // Don't initialize twice
    if (list.dataset.initialized === 'true') return;
    list.dataset.initialized = 'true';
    
    managerState.list = list;
    managerState.view = list.dataset.view;
    managerState.toggleUrl = list.dataset.toggleUrl;
    
    // Set up event listeners for checkboxes
    setupEventListeners();
}

// Set up click handlers for checkboxes
function setupEventListeners() {
    const list = managerState.list;
    if (!list) return;
    
    // Listen for checkbox changes on the list
    list.addEventListener('change', (e) => {
        const cb = e.target.closest('.habit-checkbox');
        if (!cb) return;
        
        // Only handle dashboard view toggles
        if (managerState.view === 'dashboard') {
            if (cb.checked) {
                const li = cb.closest('li');
                const ripple = li.querySelector('.ripple-effect');
                if (ripple) {
                    ripple.style.animation = 'none';
                    ripple.offsetHeight;
                    ripple.style.animation = null;
                }
            }
            // Toggle the habit completion
            toggleHabit(cb.dataset.id, cb).then(() => {
                if (typeof syncSelectAllCheckbox === 'function') {
                    syncSelectAllCheckbox();
                }
            });
        }
    });
    
    // Handle "select all" checkbox
    const selectAllCb = document.getElementById('select-all-checkbox');
    if (selectAllCb) {
        selectAllCb.addEventListener('change', async () => {
            const shouldCheck = selectAllCb.checked;
            const checkboxes = [...list.querySelectorAll('.habit-checkbox')];
            
            if (managerState.view === 'dashboard') {
                const targets = checkboxes.filter(cb => cb.checked !== shouldCheck);
                if (targets.length === 0) return;
                
                targets.forEach(cb => { cb.checked = shouldCheck; });
                
                selectAllCb.disabled = true;
                await Promise.all(targets.map(cb => toggleHabit(cb.dataset.id, cb)));
                selectAllCb.disabled = false;
                
                if (typeof syncSelectAllCheckbox === 'function') {
                    syncSelectAllCheckbox();
                }
            }
        });
    }
}

// Toggle a habit as completed or not completed
// Sends a POST request to the server
async function toggleHabit(habitId, checkbox) {
    const toggleUrl = managerState.toggleUrl;
    if (!toggleUrl) return;
    
    checkbox.disabled = true;
    try {
        const res = await fetch(`${toggleUrl}/${habitId}/toggle`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken(),
                'Content-Type': 'application/json',
            }
        });
        if (!res.ok) throw new Error('Toggle failed');
        const data = await res.json();
        checkbox.checked = data.completed;
        
        // Update the streak count display
        const li = checkbox.closest('li');
        if (li) {
            const streakCount = li.querySelector('.streak-count');
            if (streakCount && data.streak !== undefined) {
                streakCount.textContent = data.streak;
            }
        }
    } catch (e) {
        console.error('Toggle failed:', e);
        checkbox.checked = !checkbox.checked;
    } finally {
        checkbox.disabled = false;
    }
}

// Update the "select all" checkbox state
// This handles the indeterminate state and checked state
function syncSelectAllCheckbox() {
    const list = managerState.list;
    if (!list) return;
    
    const selectAll = document.getElementById('select-all-checkbox');
    if (!selectAll) return;
    
    const all = list.querySelectorAll('.habit-checkbox');
    const checked = list.querySelectorAll('.habit-checkbox:checked');
    selectAll.indeterminate = checked.length > 0 && checked.length < all.length;
    selectAll.checked = all.length > 0 && checked.length === all.length;
}

// Initialize when the page loads
document.addEventListener('DOMContentLoaded', () => {
    initHabitManager();
});

// Expose this function to the global scope for pagination
window.initHabitPagination = initHabitManager;