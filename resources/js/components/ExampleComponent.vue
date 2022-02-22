<template>
    <h1>{{ title }}</h1>
    <p v-if="test.length>0" v-for="item in test">{{item}}</p>
</template>
<script>
export default {
    setup: () => ({
        title: 'How To Install Vue 3 in Laravel 8 From Scratch',
        test:[1,2,3,4,5,6,7,7,8,88,8,8,8]
    })
}
</script>
