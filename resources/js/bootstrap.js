//
// bootstrap.js
// This file sets up Axios for making HTTP requests
// Axios is a library that makes it easy to send requests to the server
//

// Import axios library and make it available globally
import axios from 'axios';
window.axios = axios;

// Set default header for all axios requests
// This tells the server we're making an AJAX request
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';