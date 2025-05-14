import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// window.Pusher = Pusher;
// // Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;

// var pusher = new Pusher('5bbe12be208136a43e28', {
//     cluster: 'mt1'
// });

// var channel = pusher.subscribe('borrowing-channel');
// channel.bind('borrowing-event', function (data) {
//     alert(JSON.stringify(data));
// });
