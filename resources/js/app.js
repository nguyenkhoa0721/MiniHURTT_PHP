require('./bootstrap');

window.Vue = require('vue').default;;

import Vue from 'vue';
import VueRouter from 'vue-router';

import homepage from './components/homepage.vue';
import edit from './components/edit.vue';
Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: homepage
    },
    {
        path: '/edit',
        component: edit
    }
]

const router = new VueRouter({ mode: 'history', routes: routes })

const app = new Vue({
    el: '#app',
    router
});