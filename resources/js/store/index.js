import { createStore } from 'vuex'
import shelters from'./modules/shelters';


export default createStore({
    modules: {
        shelters,
    }
})
