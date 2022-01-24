import Cookies from '@/services/cookie'
import instance from '@/plugins/axios'
import Vue from 'vue'

export default {
    async redirectIfNotAuthenticated(to, from, next) {
        const token = Cookies.getToken();

        let nextPage;

        if (!token) {
            nextPage = next({ name: 'login' })
        }

        //chegar se o token está válido
        //v1/me
        try {
            const response = await instance.get('me');

            Vue.prototype.$userData = response.data.data;

        } catch (error) {
            console.log(error);
            Cookies.deleteToken();
            nextPage = next({ name: 'login' })
        }

        next(nextPage);
    },

    redirectIfAuthenticated(to, from, next) {
        const token = Cookies.getToken();

        let nextPage;

        if (token) {
            nextPage = next({ name: 'index' })
        }

        next(nextPage);
    }
}