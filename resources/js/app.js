require('./bootstrap');

import Vue from "vue";
import Vuex from "vuex";
import VueRouter from "vue-router";
import router from "./routes";

import storeDefinition from "./store"

import Index from "./Index";

Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store(storeDefinition);

window.axios.defaults.headers.common = {'Accept': 'application/json'}
window.axios.defaults.baseURL = (process.env.NODE_ENV !== 'production') ? 'http://127.0.0.1:8000/api' : ''

window.Vue = require('vue').default;

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        "index": Index
    },
    async beforeCreate() {
        this.$store.dispatch('loadStoredState');
    }
});
