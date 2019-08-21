import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

const state = {
    token: window.localStorage.getItem('token'),
    user:window.localStorage.getItem('user')
}

const mutations = {
    LoginStatus(state, n) {
        window.localStorage.removeItem('token');
        window.localStorage.setItem('token', n.meta.access_token);
        window.localStorage.removeItem('user');
        window.localStorage.setItem('user', n.data);
        state.token=n.meta.access_token;
        state.user=n.data;
    }
}

const actions = {
    Login(conext, n) {
        conext.commit('LoginStatus', n);
    }
}

export default new Vuex.Store({
    state,
    mutations,
    actions
})