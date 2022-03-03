<template>
    <div class="container">
        <div class="card">
            <div class="card-body direction-rtl">
                <yandex-map :coords="coords" :zoom="zoom" :settings="settings" style="height: 500px;">
                    <ymap-marker
                        :key="'coords-'+item.id"
                        v-for="item in shelters"
                        :marker-id="'coords-'+item.id"
                        :coords="prepareCoords(item)"
                        :icon="prepareMarker(item)"
                    />
                </yandex-map>
            </div>
        </div>
    </div>
</template>

<script>
import {yandexMap, ymapMarker} from 'vue-yandex-maps'

export default {
    name: "ShelterMap",
    props: ["shelters", "centerCoords"],
    components: {
        yandexMap, ymapMarker
    },
    data() {
        return {
            coords: [0, 0],
            zoom: 12,
            settings: {
                apiKey: '24ee74db-3897-483d-90c2-a9dabac3d8b7',
                lang: 'ru_RU',
                coordorder: 'latlong',
                enterprise: true,
                version: '2.1'
            }
        }
    },

    watch: {
        centerCoords: function (newCoords, oldCoords) {
            this.coords = [newCoords.lat, newCoords.lon]
            this.zoom = 19
        }
    },

    mounted() {
        this.setCenter(this.shelters[0])
    },
    methods: {
        setCenter(item) {
            this.coords = [item.lat, item.lon]
        },
        prepareCoords(item) {
            return [item.lat, item.lon]
        },
        prepareMarker(item) {
            return {

                layout: 'default#imageWithContent',
                imageHref: '/img/marker.png',
                imageSize: [20, 22],
                imageOffset: [0, 0],
                // content: item.id,
                //  contentOffset: [0, 15],
                // contentLayout: '<div style="background: red; padding:3px; width: 50px; color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'

            }
        },
    }
}
</script>
