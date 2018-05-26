<template>
    <button v-if="active" class="btn btn-success btn-sm" @click="subscribe">Unsubscribe</button>
    <button v-else class="btn btn-outline-success btn-sm" @click="subscribe">Subscribe</button>
</template>

<script>
    export default {
        props:['active'],
        methods:{
            subscribe(){
                axios[
                    (this.active ? 'delete' : 'post')
                    ](location.pathname + '/subscriptions');

                this.active = ! this.active;

            }
        }

    }
</script>

<style scoped>

</style>