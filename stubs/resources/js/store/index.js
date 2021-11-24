import {createStore} from 'vuex';

export default createStore({
    state: {
        authToken: localStorage.getItem('auth-token'),
        authName: null,
        authEmail: null,
        errors: Array,
    },
    mutations: {
        // 清除auth
        clearAuth (state) {
            state.authToken = null;
            state.authName = null;
            state.authEmail = null;
            localStorage.removeItem('auth-token');
        },
        // 更新authToken
        updateAuthToken (state, api_token) {
            localStorage.setItem('auth-token', api_token);
            state.authToken = localStorage.getItem('auth-token');
        },
        // 更新authName
        updateAuthName (state, userName) {
            state.authName = userName;
        },
        // 更新authEmail
        updateAuthEmail (state, userEmail) {
            state.authEmail = userEmail;
        },
        // 清除errors
        clearErrors (state) {
            state.errors = [];
        },
        // 更新errors
        updateErrors (state, errors) {
            state.errors = errors;
        },
    },
    actions: {},
    modules: {},
});
