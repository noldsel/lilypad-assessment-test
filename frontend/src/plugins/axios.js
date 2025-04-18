// src/plugins/axios.js
import axios from 'axios'


const api = axios.create({
  baseURL: import.meta.env.VITE_API_BASE_URL || 'http://localhost:8080',
  withCredentials: false,
})

export default api
