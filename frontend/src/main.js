import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import axios from 'axios'

// 1. Set the default base URL for your Laravel backend.
// This means in your components you can just type axios.post('/login') 
// instead of axios.post('http://localhost:8000/api/login')
axios.defaults.baseURL = 'http://localhost:8000/api'

// 2. Add the Request Interceptor
axios.interceptors.request.use(
  (config) => {
    // Look for the token we saved during login
    const token = localStorage.getItem('adminToken')
    
    // If the token exists, attach it to the Authorization header
    if (token) {
      config.headers.Authorization = `Bearer ${token}`
    }
    
    return config
  },
  (error) => {
    return Promise.reject(error)
  }
)

// 3. Create and mount the app
const app = createApp(App)

// (Optional) Make axios available globally inside your components using this.$axios
app.config.globalProperties.$axios = axios

app.use(router)
app.mount('#app')