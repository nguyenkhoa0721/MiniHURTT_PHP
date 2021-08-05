require('./bootstrap');

window.Vue = require('vue').default;;

import Vue from 'vue';
import VueRouter from 'vue-router';

import homepage from './components/homepage.vue';
import edit from './components/edit.vue';
import addnew from './components/new.vue';


import axios from 'axios'
import VueAxios from 'vue-axios'

axios.defaults.baseURL = '/api/repo'
axios.defaults.withCredentials = true;

Vue.use(VueAxios, axios)
Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: homepage
    },
    {
        path: '/new',
        component: addnew
    },
    {
        path: '/edit/:id',
        component: edit,
    }
]

const router = new VueRouter({ mode: 'history', routes: routes })

const app = new Vue({
    el: '#app',
    router
});