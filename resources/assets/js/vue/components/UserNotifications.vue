<template>
  <li class="dropdown" v-if="notifications.length">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <span class="glyphicon glyphicon-bell"></span>
    </a>

    <ul class="dropdown-menu">
      <li v-for="notification in notifications">
        <a :href="notification.data.link"
           v-text="notification.data.message"
           @click="markAsRead(notification)"
        ></a>
      </li>
    </ul>
  </li>
</template>

<script>
    export default {
        props: [],

        data() {
            return {
                notifications: []
            }
        },

        created() {
            axios.get("/profile/" + window.App.user.name + "/notifications")
                .then((response) => {
                    this.notifications = response.data;
                });
        },

        methods: {
            markAsRead(notification) {
                axios.delete('/profile/' + window.App.user.name + '/notifications/' + notification.id)
            }
        },

        computed: {}
    }
</script>