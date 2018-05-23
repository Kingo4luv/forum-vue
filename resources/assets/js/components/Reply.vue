<template>
    <div id="reply-'+id'" class="card mb-3">
        <div class="card-header">
            <a :href="'/profile/'+data.user.name"
            v-text="data.user.name">

            </a> said <span v-text="ago"></span>


            <div v-if="signedIn" class="float-right">
                 <favorite :reply="data"></favorite>
            </div>


            <!--{{&#45;&#45;<form action="{{route('reply.favorite',['reply_id'=>$reply->id])}}" method="post">&#45;&#45;}}-->
            <!--{{&#45;&#45;{{csrf_field()}}&#45;&#45;}}-->

            <!--{{&#45;&#45;<button class="btn btn-outline-success btn-sm float-right" {{$reply->isFavorited() ? 'disabled' : ''}}>&#45;&#45;}}-->
                <!--{{&#45;&#45;{{$reply->favorites_count}} {{str_plural('Favorite',$reply->favorites_count)}}&#45;&#45;}}-->
                <!--{{&#45;&#45;</button>&#45;&#45;}}-->
            <!--{{&#45;&#45;</form>&#45;&#45;}}-->
        </div>
        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea name="" id=""  class="form-control" v-model="body" ></textarea>
                </div>
                <button  class="btn btn-outline-success btn-sm float-left mr-3" @click="update">Update</button>
                <button  class="btn btn-outline-info btn-sm" @click="editing=false">Cancel</button>
            </div>
            <div v-else v-text="body"></div>
        </div>

        <div class="card-footer" v-if="canUpdate">
            <button  class="btn btn-outline-primary btn-sm float-left mr-3" @click="editing=true">Edit</button>
            <button type="submit" class="btn btn-danger btn-sm" @click="destroy">Delete</button>

        </div>

    </div>
</template>
<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        props:['data'],
        components:{Favorite},

        data(){
            return{
                editing: false,
                id: this.data.id,
                body: this.data.body
            };
        },

        computed:{
          signedIn(){
              return window.App.signedIn;
          },

          canUpdate(){
              return this.authorize(user => this.data.user_id == user.id);

              //return this.data.user_id == window.App.user.id;
          },

          ago(){
              return moment(this.data.created_at).fromNow();
          }


        },
        methods:{
            update(){
                axios.patch('/replies/'+this.data.id,{
                   body: this.body
                });

                this.editing = false
                flash('Your reply has be updated');
            },

            destroy(){
                axios.delete('/replies/'+this.data.id);

                this.$emit('deleted', this.data.id);

                // $(this.$el).fadeOut(300, () =>{
                //     flash('Your reply has been deleted');
                // });

            }
        }

    }
</script>