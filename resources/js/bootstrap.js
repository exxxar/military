window._ = require('lodash');

try {
    require('bootstrap');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });


window.user = document.head.querySelector('meta[name="user"]') != null ?
    document.head.querySelector('meta[name="user"]').content : null;


if (window.user) {
    window.user = JSON.parse(window.user)
    window.user.is_guest = false
} else {
    window.user = {}
    window.user.is_admin = false
    window.user.is_guest = true
}


window.mode = document.head.querySelector('meta[name="mode"]') != null ?
    document.head.querySelector('meta[name="mode"]').content : "online";
