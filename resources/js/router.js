import Vue from "vue";
import VueRouter from "vue-router";

import VHome from './views/VHome.vue';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    // linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            alias: '/home',
            name: 'home',
            component: VHome
        },        
        // {
        //     path: '*',
        //     name: 'not-found',
        //     component: NotFound
        // }        
    ]
});

export default router;