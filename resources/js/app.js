require('./bootstrap');

import Vue from 'vue';

import VueRouter from 'vue-router';
import routes from './routes';
import store from './store';
import VueProgressBar from 'vue-progressbar';
import VueSweetAlert2 from 'vue-sweetalert2';
import Login from "./components/Login";

import { library } from '@fortawesome/fontawesome-svg-core';
import { faTimes } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import 'sweetalert2/dist/sweetalert2.min.css';

window.axios = require('axios');
library.add(faTimes);

Vue.component('font-awesome-icon', FontAwesomeIcon);

Vue.use(VueRouter);

const options = {
    color: '#007bff',
    failedColor: '#f99d1b',
    thickness: '5px',
    transition: {
        speed: '0.1s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
};


const alertOptions = {
    confirmButtonColor: '#f99c1c',
    cancelButtonColor: '#e01b22',
};

Vue.use(VueSweetAlert2, alertOptions);
Vue.use(VueProgressBar, options);

let app = new Vue({
    el: '#app',
    store,
    components: {
        Login
    },
    mounted: function(){
        this.$Progress.finish();
    },
    created () {
        //  [App.vue specific] When App.vue is first loaded start the progress bar
        this.$Progress.start();
        //  hook the progress bar to start before we move router-view
        this.$router.beforeEach((to, from, next) => {
            //  does the page we want to go to have a meta.progress object
            if (to.meta.progress !== undefined) {
                let meta = to.meta.progress;
                // parse meta tags
                this.$Progress.parseMeta(meta);
            }
            //  start the progress bar
            this.$Progress.start();
            //  continue to next page
            next();
        });
        //  hook the progress bar to finish after we've finished moving router-view
        this.$router.afterEach((to, from) => {
            //  finish the progress bar
            this.$Progress.finish();
        })
    },

    router: new VueRouter(routes)
});


axios.interceptors.request.use(
    (requestConfig) => {
        if (store.getters['authModule/isAuthenticated']) {
            // console.log('sending authorization');
            // console.log(store.state.authModule.accessToken);
            requestConfig.headers.Authorization = `Bearer ${store.state.authModule.accessToken}`;
        }else{
            console.log('No authorization');
        }

        // requestConfig.headers.xLocalization = this.$store.state.langModule.lang;

        return requestConfig;
    },
    (requestError) => Promise.reject(requestError),
);

axios.interceptors.response.use(
    response => response,
    (error) => {
        if (error.response.status === 401 ) {
            // Clear token and redirect
            store.commit('authModule/setAccessToken', null);
            // window.location.replace(`${window.location.origin}/login`);
        }
        return Promise.reject(error);
    },
);
