window.Vue = require('vue');
window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// window.axios.defaults.headers.common = {};
// window.axios.defaults.headers.common.accept = 'application/json';

// window.axios.interceptors.request.use((config) => {
//     const token = document.cookie
//         .split('; ')
//         .find(row => row.startsWith('XSRF-TOKEN='))
//         .split('=')[1];
//     if(token) {
//         config.headers.Authorization = `Bearer ${token}`;
//     }
//     return config;
// }, error => {
//     return Promise.reject(error);
// // });
// window.axios.interceptors.request.use(request => {
// console.log('Starting Request', JSON.stringify(request, null, 2))
// return request
// });
  
// window.axios.interceptors.response.use(response => {
// console.log('Response:', JSON.stringify(response, null, 2))
// return response
// });

import App from './App.vue';
import router from './router.js';

const app = new Vue(
    {
        el: '#root',
        render: h => h(App),
        router
    }
);