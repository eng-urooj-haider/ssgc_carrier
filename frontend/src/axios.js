// resources/js/axios.js
import axios from 'axios'
import { useLoaderStore } from './stores/loader'  // Correct import of Pinia store

const api = axios.create({
  baseURL: import.meta.env.VITE_BASE_URL,
  withCredentials: true,
  withXSRFToken: true,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    Accept: 'application/json',
  },
})
api.interceptors.request.use(
  (config) => {
    const loader = useLoaderStore()
    loader.showLoader()
    return config
  },
  (error) => {
    const loader = useLoaderStore()
    loader.hideLoader()
    return Promise.reject(error)
  }
)

api.interceptors.response.use(
  (response) => {
    const loader = useLoaderStore()
    loader.hideLoader()
    return response
  },
  (error) => {
    const loader = useLoaderStore()
    loader.hideLoader()
    return Promise.reject(error)
  }
)

export default api
