<template>
    <button v-if="isFavorited" type="submit" class="btn btn-success btn-sm  float-sm-right" @click="toggle">
        <i class="far fa-heart"></i>
        <span v-text="favoritesCount"></span>
    </button>
    <button v-else type="submit" class="btn btn-outline-success btn-sm  float-sm-right" @click="toggle">
        <i class="fas fa-heart"></i>
        <span v-text="favoritesCount"></span>
    </button>
</template>

<script>
    export default {
        props: ['reply'],
        data(){
            return{
                favoritesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavorited
            };
        },

        computed:{
          endpoint(){
              return '/replies/'+this.reply.id+'/favorites';
          }
        },
        methods:{
            toggle(){
                return this.isFavorited ? this.destroy() : this.create();
            },
            create(){
                axios.post(this.endpoint);
                this.isFavorited = true;
                this.favoritesCount++;
            },
            destroy(){
                axios.delete('/replies/'+this.reply.id+'/favorites');
                this.isFavorited = false;
                this.favoritesCount--;
            }
        },
    }
</script>

<style scoped>

</style>