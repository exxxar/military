<template>
    <div class="single-search-result mb-3 border-bottom pb-3" style="cursor: pointer;">
        <h6 class="text-truncate mb-1">{{item.address}}, {{item.city}}</h6>
        <p class="mb-0">Координаты: <strong>{{item.lat}},{{item.lon}}</strong></p>
        <p class="mb-0">{{item.description}}</p>
<!--        <a
        class="text-truncate mb-2 d-block fz-12 text-decoration-underline" href="#">На карте</a>-->



<!--

        'city',
        'region',
        'address',
        'lat',
        'lon',
        'balance_holder',
        'responsible_person',
        'capacity',
        'description',
        "status",
        "quality",
        "type",
        "facility"-->

    </div>
</template>
<script>


export default {

    props: {
        item: Object,
    },
    data(){
        return {

        }
    }
}
</script>
