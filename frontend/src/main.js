import './assets/main.css'
import '@mdi/font/css/materialdesignicons.css';


import { createApp } from 'vue'
import App from './App.vue'

import vuetify from './plugins/vuetify'

// createApp(App).mount('#app')
createApp(App).use(vuetify).mount('#app')
