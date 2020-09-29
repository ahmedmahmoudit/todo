import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

import * as authModule from './modules/auth';
import * as tasksModule from './modules/tasks';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        authModule: authModule,
        tasksModule: tasksModule
    },
    plugins: [createPersistedState()],
})
