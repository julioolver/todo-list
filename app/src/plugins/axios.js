import Vue from 'vue'
import axios from 'axios'
import Cookie from '@/services/cookie'
// axios.defaults.baseURL = 'https://curso-vue-b051e-default-rtdb.firebaseio.com/'
// as duas formas a baixo podem ser definidias aqui, ou direto no arquivo/componente, com this.$http....
// axios.defaults.headers.common['Authorization'] = 'abc123'
// axios.defaults.headers.get['Accepts'] = 'application/json'

// Vue.prototype.$http = axios
const instance = axios.create({
    baseURL: 'http://todo-list.local/api/v1/',
    headers: {
        "Accept": "application/json",
        "Content-Type": "application/json",
        "Access": "application/json"
        // get: {
        //     "Authorization" : "abc123"
        // }
    }
});

Vue.prototype.$http = instance;

// interceptando requisições
// usado para ver as informações da requisição, podendo também alterar o que está sendo mandado
// por exemplo, se realizar um if(config.method === 'POST'), pode returnar que o config.method === 'PUT'
Vue.prototype.$http.interceptors.request.use(config => {
    const token = Cookie.getToken();

    if (token) {
        config.headers.common['Authorization'] = 'Bearer ' + token
        console.log('axios', config);
    }
    return config;
}, error => Promise.reject(error))

Vue.prototype.$http.interceptors.response.use(res => {
    // const array = []
    // for(let chave in res.data) {
    //     array.push({ id: chave, ...res.data[chave]})
    // }

    // res.data = array
    return res
}, error => Promise.reject(error))

Vue.prototype.$api = axios.create({
    baseURL: 'https://curso-vue-b051e-default-rtdb.firebaseio.com/'
});

// Vue.prototype.$axios = axios;

export default instance; // we need to export this
