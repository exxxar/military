<template>

    <div class="container">
        <div class="card">
            <div class="card-body direction-rtl">
                <!-- Single Search Result -->
                <shelter-item v-if="shelters"
                              @click="setCenter(item)"
                              :item="item"
                              :key="index"
                              v-for="(item,index) in filteredShelterItems"/>

                <!-- Pagination -->

                <nav aria-label="Page navigation example">
                    <ul class="pagination pagination-two justify-content-center">
                        <li class="page-item"><a class="page-link" href="#first" aria-label="first"
                                                 @click="currentPage=0">
                            <svg class="bi bi-chevron-left" width="16" height="16" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                            </svg>
                        </a></li>
                        <li class="page-item"
                            v-bind:class="{'active':page===currentPage}"
                            v-for="page in preparedPages"><a class="page-link" href="#page"
                                                             @click="changeCurrentPage(page)">{{ page + 1 }}</a>
                        </li>
                        <!--                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">...</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">9</a></li>-->
                        <li class="page-item"><a class="page-link" href="#last" aria-label="Next" @click="last">
                            <svg class="bi bi-chevron-right" width="16" height="16" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                            </svg>
                        </a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</template>
<script>
import {mapGetters} from "vuex"
import ShelterItem from "./ShelterItem";


export default {
    name: "ShelterList",
    props: ["shelters"],
    components: {
        ShelterItem
    },
    data() {
        return {
            search: null,
            currentPage: 0,
            itemOnPage: 30,
        }
    },
    computed: {

        preparedPages: function () {
            let tmp = [];

            for (let i = this.currentPage - (this.currentPage > 1 ? 2 : 3); i < this.currentPage + (this.currentPage > 1 ? 2 : 3); i++)
                if (i >= 0 && i <= Math.round(this.shelters.length / this.itemOnPage))
                    tmp.push(i);

            return tmp;

        },


        filteredShelterItems: function () {
            if (this.search == null)
                return this.shelters.slice(this.currentPage * this.itemOnPage, this.currentPage * this.itemOnPage + this.itemOnPage)
            return this.shelters.filter(item => item.address.toLowerCase().indexOf(this.search.toLowerCase()) >= 0).slice(this.currentPage * this.itemOnPage, this.currentPage * this.itemOnPage + this.itemOnPage)
        }

    },

    methods: {
        setCenter(item) {
            this.$emit("coords", {
                lat: item.lat,
                lon: item.lon
            })
        },

        doSearch() {
            this.coords = [this.filteredShelterItems[0].lat, this.filteredShelterItems[0].lon]
        },

        changeCurrentPage(page) {
            this.currentPage = page
            this.doSearch()
        },
        last() {
            this.currentPage = Math.round(this.shelters.length / this.itemOnPage)
        }
    }
}
</script>
