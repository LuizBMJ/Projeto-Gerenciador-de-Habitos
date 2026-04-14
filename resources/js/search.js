//
// search.js
// This file provides search functionality for the habits list
// It handles the search input and filters results in real-time
//

// Debounce timer for search input
let searchTimeout = null;

// Filter habits based on search query
// Called when user types in the search input
function filterHabits(query) {
    // Clear previous debounce timer
    clearTimeout(searchTimeout);

    const input = document.getElementById('habit-search');
    if (!input) return;

    const list = document.getElementById(input.dataset.list ?? 'habit-list');
    if (!list) return;

    const search = query.trim();

    // Wait 300ms after user stops typing before searching
    searchTimeout = setTimeout(() => {
        if (search === '') {
            // If search is empty, reset to show all habits
            if (typeof window.resetHabitPagination === 'function') {
                window.resetHabitPagination();
            }
        } else {
            // Otherwise, search the backend
            searchBackend(search, list);
        }
    }, 300);
}

// Sort habits by relevance to search term
// Results starting with the search term come first
function sortByRelevance(habits, search) {
    const term = search.toLowerCase();

    return habits.slice().sort((a, b) => {
        const aName = a.name.toLowerCase();
        const bName = b.name.toLowerCase();

        // Check which names start with the search term
        const aStarts = aName.startsWith(term);
        const bStarts = bName.startsWith(term);

        // Put starts-with results first
        if (aStarts !== bStarts) return aStarts ? -1 : 1;

        // Then sort alphabetically
        return aName.localeCompare(bName);
    });
}

// Send search to backend and render results
function searchBackend(search, list) {
    const paginateUrl = list.dataset.paginateUrl;
    const noResults   = document.getElementById('no-results');
    const loadMore    = document.getElementById('load-more');
    const loadAll     = document.getElementById('load-all-btn');

    // Hide loading buttons while searching
    if (loadMore) loadMore.classList.add('hidden');
    if (loadAll)  loadAll.classList.add('hidden');
    if (noResults) noResults.add('hidden');

    // Fetch results from server
    fetch(`${paginateUrl}?load_all=1&search=${encodeURIComponent(search)}`, {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(res => res.json())
    .then(data => {
        list.innerHTML = '';

        // If no results, show the no-results message
        if (data.habits.length === 0) {
            if (noResults) noResults.classList.remove('hidden');
            return;
        }

        if (noResults) noResults.classList.add('hidden');
        
        // Sort by relevance and render each habit
        const sorted = sortByRelevance(data.habits, search);

        sorted.forEach(habit => {
            // Dispatch event for other code to handle rendering
            const event = new CustomEvent('render-habit', { detail: habit, bubbles: true });
            list.dispatchEvent(event);
        });

        if (loadMore) loadMore.classList.add('hidden');
        if (loadAll)  loadAll.classList.add('hidden');
    })
    .catch(e => {
        console.error('Search failed:', e);
        if (loadMore) loadMore.classList.remove('hidden');
    });
}

// Expose to global scope for inline handlers
window.filterHabits = filterHabits;