<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :data="reply" @deleted="remove(index)"></reply>
        </div>

        <paginator :dataSet = "dataSet" @updated="fetch"></paginator>

        <new-reply @created="add"> </new-reply>
    </div>

</template>

<script>
    import Reply from './Reply.vue';
    import NewReply from './NewReply.vue';

    export default {

        components: {Reply, NewReply},


        data() {
            return {
                items: [],
                dataSet: false
            }
        },

        created(){
          this.fetch();
        },

        methods: {

            fetch(page){
              axios.get(this.url(page))
                    .then(this.refresh);
            },

            url(page){
                if(! page){
                    let query = location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }
                return `${location.pathname}/replies?page=${page}`;
            },

            refresh({data}){
                this.dataSet = data;
                this.items = data.data;

                window.scrollTo(0,0);
            },
            add(reply){
                this.items.push(reply);
                this.$emit('added');

                flash('Reply has been left');


            },

            remove(index){
                this.items.splice(index, 1);
                this.$emit('removed');
                flash('Reply deleted');

            }

        }
    }
</script>