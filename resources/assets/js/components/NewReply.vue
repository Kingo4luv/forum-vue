<template>
    <div>
        <div v-if="signedIn">
            <div class="form-group">
                <textarea name="body" id=""
                          cols="30" rows="5"
                          class="form-control"
                          placeholder="have something to say?"
                          v-model="body"
                          required>

                </textarea>
            </div>
            <button type="submit"
                    class="btn btn-outline-primary btn-sm"
                    @click="addReply"> Post</button>
        </div>


        <p v-else class="text-center">Please <a href="/login">Sign in</a> to participate in the discussion</p>

    </div>
</template>

<script>
    export default {
        data(){
            return{
                body: ''
            }
        },
        computed:{
          signedIn(){
              return window.App.signedIn;
          }
        },

        methods:{
            addReply() {
                axios.post(location.pathname + '/replies', {body: this.body})
                    .catch(error =>{
                        flash(error.response.data, 'danger');
                    })
                    .then(({data})=>{
                        this.body = '';

                        flash('your reply has been left');

                        this.$emit('created', data);
                    });
            }
        }
    }
</script>

<style scoped>

</style>