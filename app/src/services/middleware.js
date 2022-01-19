import Cookies from '@/services/cookie'

export default {
    redirectIfNotAuthenticated(to, from, next) {
        const token = Cookies.getToken();

        let nextPage;

        if (!token) {
            nextPage = next({name: 'login'})
        }

        //chegar se o token está válido
        //v1/me

        next(nextPage);
    },

    redirectIfAuthenticated(to, from, next) {
        const token = Cookies.getToken();

        let nextPage;

        if (token) {
            nextPage = next({name: 'index'})
        }

        next(nextPage);
    }
}