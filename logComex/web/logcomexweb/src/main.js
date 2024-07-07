/**
 * main.js
 *
 * Bootstraps Vuetify and other plugins then mounts the App`
 */

// Plugins
import { registerPlugins } from '@/plugins'

// Components
import App from './App.vue'

// Composables
import { createApp } from 'vue'
import money from 'v-money3'
const app = createApp(App)

registerPlugins(app)
app.use(money)
app.mount('#app')

