import Vue from "vue";
import VueRouter from "vue-router";

import PageHome from './views/PageHome.vue';
import PageRequest from './views/PageRequest.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    // linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            alias: '/home',
            name: 'home',
            component: PageHome
        },
        {
            path: '/:request_id',
            name: 'show',
            component: PageRequest
        },
               
        // {
        //     path: '*',
        //     name: 'not-found',
        //     component: NotFound
        // }        
    ]
});

export default router;