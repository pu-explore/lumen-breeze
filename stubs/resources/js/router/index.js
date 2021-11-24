import {createRouter, createWebHashHistory} from 'vue-router';
import Welcome from '@/views/Welcome.vue';
import store from '@/store';

const routes = [
    {
        path: '/',
        name: 'Welcome',
        component: Welcome,
    },
    {
        path: '/login',
        name: 'Login',
        component: () => import(/* webpackChunkName: "login" */ '@/views/auth/Login.vue'),
    },
    {
        path: '/register',
        name: 'Register',
        component: () => import(/* webpackChunkName: "register" */ '@/views/auth/Register.vue'),
    },
    {
        path: '/forgot-password',
        name: 'ForgotPassword',
        component: () => import(/* webpackChunkName: "forgot-password" */ '@/views/auth/ForgotPassword.vue'),
    },
    {
        path: '/reset-password',
        name: 'ResetPassword',
        component: () => import(/* webpackChunkName: "reset-password" */ '@/views/auth/ResetPassword.vue'),
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: () => import(/* webpackChunkName: "dashboard" */ '@/views/Dashboard.vue'),
    },
];

const router = createRouter({
    history: createWebHashHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    // Clear the error message before entering the new page
    store.commit('clearErrors');
    // If there is a token and it is the Login page, jump to the Dashboard
    if (to.name === 'Login' && store.state.authToken) {
        next({
            path: '/dashboard'
        });
    }
    // If there is no token, jump to the login page (excluding Welcome and Login pages)
    if (!['Welcome', 'Login', 'Register', 'ForgotPassword', 'ResetPassword'].includes(to.name) && !store.state.authToken) {
        next({
            path: '/login'
        });
    }
    console.dir('router.beforeEach:');
    console.dir({
        to: to,
        from: from,
        next: next,
    });
    next();
});

export default router;
