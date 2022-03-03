<template>
    <div class="page-content-wrapper py-3">

        <div class="container mb-3">
            <div class="card">
                <div class="card-body direction-rtl">
                    <!-- Search Form Wrapper -->
                    <div class="search-form-wrapper">
                        <p class="mb-2 fz-12">{{filteredShelters.length}} найдено результатов</p>
                        <!-- Search Form -->
                        <form class="mb-3 pb-4 border-bottom" action="#">
                            <div class="input-group">
                                <input class="form-control form-control-clicked"
                                       type="search"
                                       placeholder="Напишие фрагмент нзвания улицы"
                                       v-model="search"/>

                                <button class="btn btn-dark" type="button" @click=""><i
                                    class="bi bi-search fz-14"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <shelter-map-component
            :shelters="filteredShelters"
            :centerCoords="coords"
            v-if="filteredShelters.length>0"/>

        <shelter-list-component :shelters="filteredShelters" v-on:coords="setCoords"/>


    </div>
</template>
<script>
import {mapGetters} from "vuex";
import {useRoute} from 'vue-router';

export default {
    data() {
        return {
            coords: null,
            search: null,
            regionId: null,
        }
    },

    computed: {
        ...mapGetters([
            'shelterItems'
        ]),

        filteredShelters() {

            if (this.regionId==null)
                return this.shelterItems

            let shelter = this.shelterItems[this.regionId - 1];

            if (!shelter)
                return this.shelterItems

            let shelters = this.shelterItems.filter(item => item.city === shelter.city)

            if (this.search==null)
                return shelters

            return shelters.filter(item=>item.address.toLowerCase().indexOf(this.search.toLowerCase())>=0);
        }

    },
    created() {
        this.$store.dispatch("getShelterItems")
        const route = useRoute();
        this.regionId = route.params.regionId; // read parameter id (it is reactive)


    },
    methods:{
        setCoords(item){
            this.coords = item;
        }
    }
}
</script>
