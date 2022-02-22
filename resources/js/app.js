require('./bootstrap')

import { createApp } from 'vue'
import App from './Layout/App'
import Header from './components/Base/Header'
import Footer from './components/Base/Footer'
import SideBar from './components/Base/SideBar'

import router from './routes' // <---

const app = createApp({})

app.component('application', App)
app.component('header-component', Header)
app.component('footer-component', Footer)
app.component('side-bar-component', SideBar)

app.use(router).mount('#app')
