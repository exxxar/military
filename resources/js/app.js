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

import RequestPeopleForm from './components/OtherForms/RequestPeopleForm'
import SearchInBaseForm from './components/OtherForms/SearchInBaseForm'
import SearchPeopleForm from './components/OtherForms/SearchPeopleForm'
import SearchPeopleOnlineForm from './components/OtherForms/SearchPeopleOnlineForm'
import HAidForm from './components/OtherForms/HAidForm'
import SendMessageForm from './components/OtherForms/SendMessageForm'
import AnnounceForm from './components/OtherForms/AnnounceForm'

import BaseHelpForm from './components/OtherForms/BaseHelpForm'
import FoodAndGoodsForm from './components/OtherForms/FoodAndGoodsForm'
import DeliveryForm from './components/OtherForms/DeliveryForm'
import AssistanceForm from './components/OtherForms/AssistanceForm'
import DriverForm from './components/OtherForms/DriverForm'
import FeederForm from './components/OtherForms/FeederForm'
import AidCenterForm from './components/OtherForms/AidCenterForm'
import WaterForm from './components/OtherForms/WaterForm'
import ClothesForm from './components/OtherForms/ClothesForm'
import FastMenu from './components/Base/FastMenu'
import CardMenu from './components/Base/CardMenu'

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
import FunctionsPage from './pages/Functions'



import router from './routes' // <---
import store from './store'

import VueTheMask from 'vue-the-mask'


const app = createApp({})



app.component('application', App)
app.component('header-component', Header)
app.component('footer-component', Footer)
app.component('side-bar-component', SideBar)
app.component('fast-menu-component', FastMenu)
app.component('card-menu-component', CardMenu)

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
app.component('water-help-form-component', WaterForm)
app.component('clothes-form-component', ClothesForm)
app.component('h-aid-form-component', HAidForm)
app.component('send-message-form-component', SendMessageForm)
app.component('announce-form-component', AnnounceForm)

app.component('request-people-form-component', RequestPeopleForm)
app.component('search-in-base-form-component', SearchInBaseForm)
app.component('search-people-form-component', SearchPeopleForm)
app.component('search-people-online-form-component', SearchPeopleOnlineForm)


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
app.component('functions-page', FunctionsPage)


app.use(VueTheMask)


app.use(store).use(router).mount('#app')
