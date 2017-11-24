<template>
    <div v-bind:class="[alertClass]" class="alert alert-flash" role="alert" v-show="show">
        {{ body }}
    </div>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: '',
                show: false,
                alertClass: 'alert-success'
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', (message, type) => this.flash(message, type));
        },

        methods: {
            flash(message, type) {
                this.body = message;
                this.show = true;
                if (type) {
                    this.alertClass = 'alert-' + type;
                }

                this.hide();
            },

            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 3000)
            }
        }
    }
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        bottom: 25px;
    }
</style>
