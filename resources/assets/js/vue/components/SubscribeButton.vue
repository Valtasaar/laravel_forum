<template>
  <button
      :class="classes"
      @click="subscribe"
      :disabled="this.disabled"
      v-text="this.activeButton ? 'Unsubscribe' : 'Subscribe'"
  >
  </button>
</template>

<script>
    export default {
        props: ['active'],

        data() {
            return {
                disabled: false,
                activeButton: this.active
            }
        },

        created() {

        },

        methods: {
            subscribe() {
                this.disabled = true;

                axios[
                    (this.activeButton ? 'delete' : 'post')
                    ](location.pathname + '/subscribes')
                    .then(() => {
                        this.activeButton = !this.activeButton;
                        this.disabled = false;
                    })
            }
        },

        computed: {
            classes() {
                return ['btn', this.activeButton ? 'btn-primary' : 'btn-default']
            }
        }
    }
</script>