<template>
    <div class="container">
        <!-- Element Heading -->
        <div class="element-heading mt-3">
            <h6>Доступные регионы</h6>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">

                    <div class="form-group">
                        <label class="form-label" for="exampleInputText">Поиск региона</label>
                        <input class="form-control" id="exampleInputText" type="text" placeholder="Фрагмент названия региона" v-model="search">
                    </div>


                <div class="list-group">
                    <a class="list-group-item list-group-item-action" :href="'/shelters/'+item.id" v-for="item in filteredRegions">{{item.city}}</a>
                </div>
            </div>
        </div>
    </div>



</template>
<script>
import {mapGetters} from "vuex";

export default {
    props: ["regions"],
    computed:{
      filteredRegions:function (){
          if (this.search == null)
              return this.regions
          return this.regions.filter(item => item.city.toLowerCase().indexOf(this.search.toLowerCase()) >= 0)
      }
    },
    data(){
        return {
            search: null
        }
    },

}
</script>
