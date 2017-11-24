<script>
    import Favorite from './Favorite.vue';

    export default {
        props: ['attributes'],

        components: {Favorite},

        data() {
            return {
                editing: false,
                body: this.attributes.body
            }
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.attributes.id, {
                    body: this.body
                });

                this.editing = false;

                flash('Updated!');
            },

            destroy() {
                var obj = this;

                axios.delete('/replies/' + this.attributes.id)
                    .then(function (response) {
                        $(obj.$el).fadeOut(300, () => {
                            flash('Reply deleted!');
                        });
                    })
                    .catch(function (error) {
                        flash('' + error, 'danger');
                    });
            }
        }
    }
</script>