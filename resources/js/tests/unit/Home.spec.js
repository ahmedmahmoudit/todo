import { shallowMount, createLocalVue } from '@vue/test-utils'
import Vuex from 'vuex'
import Home from '../../components/Home.vue';
import {describe} from "@jest/globals";
import VueRouter from "vue-router";

const localVue = createLocalVue();

localVue.use(Vuex);
localVue.use(VueRouter);
const router = new VueRouter();

describe('Home', () => {
    let actions;
    let store;

    beforeEach(() => {
        actions = {
            actionClick: jest.fn(),
            actionInput: jest.fn()
        };
        store = new Vuex.Store({
            actions
        })
    });

    it('Guest users should redirected to login', () => {
        const wrapper = shallowMount(Home, { store, localVue, router });
        expect(router.currentRoute.path).toBe('/login');
    });
});
