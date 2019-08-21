import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

const state = {
    token: window.localStorage.getItem('token') == null ? '' : window.localStorage.getItem('token'),
    user: window.localStorage.getItem('user') == null ? '' : JSON.parse(window.localStorage.getItem('user')),
}

const mutations = {
    LoginStatus(state, n) {
        state.token = n.meta.access_token;
        window.localStorage.removeItem('token');
        window.localStorage.setItem('token', n.meta.access_token);

        state.user = n.data;
        window.localStorage.removeItem('user');
        var user = JSON.stringify(n.data);
        window.localStorage.setItem('user', user);

        return state
    }
}

const actions = {
    Login(conext, n) {
        return conext.commit('LoginStatus', n);
    }
}

export default new Vuex.Store({
    state,
    mutations,
    actions
})