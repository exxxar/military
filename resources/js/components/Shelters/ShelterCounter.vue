<template>
    <div class="container">
        <div class="card">
            <div class="card-body direction-rtl">
                <div class="row">
                    <div class="col-4">
                        <!-- Single Counter -->
                        <div class="single-counter-wrap text-center">
                            <h4 class="mb-0"><span class="counter">{{ regionsCount }}</span>+</h4><span
                            class="solid-line"></span>
                            <p class="mb-0">Регионов</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <!-- Single Counter -->
                        <div class="single-counter-wrap text-center">
                            <h4 class="mb-0"><span class="counter">{{ shelterCount  }}</span>+</h4><span
                            class="solid-line"></span>
                            <p class="mb-0">Убежищ</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <!-- Single Counter -->
                        <div class="single-counter-wrap text-center">
                            <h4 class="mb-0"><span class="counter">767</span>+</h4><span class="solid-line"></span>
                            <p class="mb-0">Пользователей</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import {mapGetters} from "vuex";

export default {
    props:["shelterCount","regionsCount"]
}
</script>
