<template>
  <button :class="classes" @click="toggle" :disabled="signedIn">
    <span class="glyphicon glyphicon-heart"></span>
    <span v-text="count"></span>
  </button>
</template>

<script>
    export default {
        props: ['reply', 'user'],

        data() {
            return {
                count: this.reply.favorites_count,
                active: this.reply.is_favorited
            }
        },

        computed: {
            classes() {
                return [
                    'btn',
                    this.active ? 'btn-primary' : 'btn-default'
                ];
            },

            endpoint() {
                return '/replies/' + this.reply.id + '/favorites'
            },

            signedIn() {
                return !window.App.signedIn;
            }
        },

        methods: {
            toggle() {
                this.active ? this.destroy() : this.create();
            },

            create() {
                axios.post(this.endpoint);

                this.active = true;
                this.count++;
            },

            destroy() {
                axios.delete(this.endpoint);

                this.active = false;
                this.count--;
            }
        }
    }
</script>