import {createStore} from 'vuex';

export default createStore({
    state: {
        authToken: localStorage.getItem('auth-token'),
        authName: null,
        authEmail: null,
        errors: Array,
    },
    mutations: {
        // Clear auth
        clearAuth (state) {
            state.authToken = null;
            state.authName = null;
            state.authEmail = null;
            localStorage.removeItem('auth-token');
        },
        // Update authToken
        updateAuthToken (state, api_token) {
            localStorage.setItem('auth-token', api_token);
            state.authToken = api_token;
        },
        // Update authName
        updateAuthName (state, userName) {
            state.authName = userName;
        },
        // Update authEmail
        updateAuthEmail (state, userEmail) {
            state.authEmail = userEmail;
        },
        // Clear errors
        clearErrors (state) {
            state.errors = [];
        },
        // Update errors
        updateErrors (state, errors) {
            state.errors = errors;
        },
    },
    actions: {},
    modules: {},
});
