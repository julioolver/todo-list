import Vue from 'vue'
import axios from 'axios'

// axios.defaults.baseURL = 'https://curso-vue-b051e-default-rtdb.firebaseio.com/'
// as duas formas a baixo podem ser definidias aqui, ou direto no arquivo/componente, com this.$http....
// axios.defaults.headers.common['Authorization'] = 'abc123'
// axios.defaults.headers.get['Accepts'] = 'application/json'
Vue.use({
    install(Vue) {
        // Vue.prototype.$http = axios
        Vue.prototype.$http = axios.create({
            baseURL: 'http://todo-list.local/api/v1/',
            headers: {
                "Authorization" : "Bearer",
                "Accept" : "application/json",
                "Content-Type": "application/json",
                "Access": "application/json"
                // get: {
                //     "Authorization" : "abc123"
                // }
            }
        });

        // interceptando requisições
        // usado para ver as informações da requisição, podendo também alterar o que está sendo mandado
        // por exemplo, se realizar um if(config.method === 'POST'), pode returnar que o config.method === 'PUT'
        Vue.prototype.$http.interceptors.request.use(config => {
            // console.log(config)
            return config
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

        
    }
})