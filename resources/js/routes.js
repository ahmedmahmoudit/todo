import NotFound from './components/partials/NotFound';
import Login from './components/Login';
import Home from './components/Home';

// const routes = new Router({
export default {
    mode: 'history',

    linkActiveClass: 'link-active',

    routes: [

        {
            path: '*',
            component: NotFound
        },
        {
            path: '/home',
            component: Home,
            name: 'home',
        },
        {
            path: '/',
            component: Home,
        },
        {
            path: '/login',
            component: Login,
            name: 'login',
        }

    ]
}
