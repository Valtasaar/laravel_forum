<template>
    <div
        :class="'alert-'+level"
        class="alert alert-flash"
        role="alert"
        v-show="show"
        v-text="body"
    >
    </div>
</template>

<script>
    export default {
        props: ['message'],

        data() {
            return {
                body: '',
                level: 'success',
                show: false
            }
        },

        created() {
            if (this.message) {
                this.flash(this.message);
            }

            window.events.$on('flash', (message, type) => this.flash(message, type));
        },

        methods: {
            flash(data) {
                this.body = data.message;
                this.level = data.level;
                this.show = true;

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
