<template>
    <div class="page-content-wrapper py-3">
<!--        <shelter-map-component/>-->
        <shelter-counter-component
            :shelterCount="shelterItemsCount"
            :regionsCount="shelterRegionsCount"
        />
<!--        <shelter-list-component/>-->

        <shelter-regions-component :regions="shelterRegions"/>
    </div>
</template>
<script>
import {mapGetters} from "vuex";

export default {
    computed: {
        ...mapGetters([
            'shelterItemsCount', 'shelterRegionsCount','shelterRegions'
        ]),
    },
    created() {
        this.$store.dispatch("getShelterItems")
        this.$store.dispatch("getShelterRegions")
    }
}
</script>
