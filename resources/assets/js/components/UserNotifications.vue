<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
             <i class="fas fa-bell"></i>
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div v-for="notification in notifications">
                <a class="dropdown-item" href="#" v-text="notification.data.message" @click="markAsRead(notification)"></a>
            </div>
        </div>
    </li>
</template>

<script>
    export default {
        data(){
            return{
                notifications: false
            }
        },

        created(){
            axios.get("/profile/"+ window.App.user.name + "/notifications")
                .then(response => this.notifications = response.data);
        },

        methods:{
            markAsRead(notification){
                axios.delete('/profile/' + window.App.user.name + '/notifications/' + notification.id)
            }
        }
    }
</script>

<style scoped>

</style>