import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex)

const state = {
    token: window.localStorage.getItem('token') == null ? '' : window.localStorage.getItem('token'),
    user: window.localStorage.getItem('user') == null ? '' : JSON.parse(window.localStorage.getItem('user')),
}

const mutations = {
    // LoginStatus(state, n) {
    //     if (n == null) {
    //         window.localStorage.removeItem('token');
    //         window.localStorage.removeItem('user');
    //         state.token = null;
    //         state.user = null;
    //     } else {
    //         state.token = n.meta.access_token;
    //         window.localStorage.removeItem('token');
    //         window.localStorage.setItem('token', n.meta.access_token);

    //         state.user = n.data;
    //         window.localStorage.removeItem('user');
    //         var user = JSON.stringify(n.data);
    //         window.localStorage.setItem('user', user);
    //     }

    //     return state
    // }
    TokenMutation(state, n) {
        state.token = n;
        window.localStorage.removeItem('token');
        window.localStorage.setItem('token', n);
    }
}

const actions = {
    DispachToken(conext, n) {
        return conext.commit('TokenMutation',n)
    }
}

export default new Vuex.Store({
    state,
    mutations,
    actions
})