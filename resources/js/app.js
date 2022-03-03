require('./bootstrap')


import {createApp} from 'vue'
import App from './Layout/App'
import Header from './components/Base/Header'
import Footer from './components/Base/Footer'
import SideBar from './components/Base/SideBar'

import ShelterList from './components/Shelters/ShelterList'
import ShelterMap from './components/Shelters/ShelterMap'
import ShelterCounter from './components/Shelters/ShelterCounter'
import ShelterRegions from './components/Shelters/ShelterRegions'
import ShelterFrom from './components/Shelters/AddNewShelterForm'

import BaseHelpForm from './components/OtherForms/BaseHelpForm'
import FoodAndGoodsForm from './components/OtherForms/FoodAndGoodsForm'
import DeliveryForm from './components/OtherForms/DeliveryForm'
import AssistanceForm from './components/OtherForms/AssistanceForm'
import DriverForm from './components/OtherForms/DriverForm'
import FeederForm from './components/OtherForms/FeederForm'
import AidCenterForm from './components/OtherForms/AidCenterForm'

import AboutPage from './pages/About'
import HomePage from './pages/Home'
import AidCentersPage from './pages/AidCenters'
import AssistancePage from './pages/Assistances'
import HelpPage from './pages/Help'
import RegionsPage from './pages/Regions'
import SheltersPage from './pages/Shelters'
import SignUpPage from './pages/SignUp'
import SignInPage from './pages/SignIn'
import Screen from './pages/Screen'


import router from './routes' // <---
import store from './store'

import VueTheMask from 'vue-the-mask'


const app = createApp({})

app.component('application', App)
app.component('header-component', Header)
app.component('footer-component', Footer)
app.component('side-bar-component', SideBar)

app.component('shelter-list-component', ShelterList)
app.component('shelter-map-component', ShelterMap)
app.component('shelter-counter-component', ShelterCounter)
app.component('shelter-regions-component', ShelterRegions)
app.component('shelter-form-component', ShelterFrom)

app.component('base-help-form-component', BaseHelpForm)
app.component('food-and-goods-form-component', FoodAndGoodsForm)
app.component('delivery-form-component', DeliveryForm)
app.component('assistance-form-component', AssistanceForm)
app.component('driver-form-component', DriverForm)
app.component('feeder-form-component', FeederForm)
app.component('aid-center-form-component', AidCenterForm)


app.component('about-page', AboutPage)
app.component('home-page', HomePage)
app.component('aid-centers-page', AidCentersPage)
app.component('assistance-page', AssistancePage)
app.component('help-page', HelpPage)
app.component('shelters-page', SheltersPage)
app.component('regions-page', RegionsPage)
app.component('sign-in-page', SignInPage)
app.component('sign-up-page', SignUpPage)
app.component('screen-page', Screen)


app.use(VueTheMask)

app.use(store).use(router).mount('#app')
