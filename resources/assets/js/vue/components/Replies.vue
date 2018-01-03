<template>
  <div>
    <div v-for="(reply, index) in items" :key="reply.id">
      <reply :data="reply" @deleted="remove(index)"></reply>
    </div>

    <paginator :data-set="dataSet" @changed="fetch"></paginator>

    <new-reply @created="add"></new-reply>
  </div>
</template>

<script>
    import Reply from './Reply.vue';
    import NewReply from './NewReply.vue';
    import collection from '../mixins/Collection';

    export default {
        components: {Reply, NewReply},

        mixins: [collection],

        props: ['data'],

        data() {
            return {
                dataSet: false,
                items: []
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch(page) {
                axios.get(this.url(page)).then(this.refresh);
            },

            url(page) {
                if (!page) {
                    let query = window.location.search.match(/page=(\d+)/);

                    page = query ? query[1] : 1;
                }

                return location.pathname + '/replies?page= ' + page;
            },

            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;

                window.scrollTo(0,0);
            },

            add(reply) {
                //this.items.push(reply);
                this.fetch();
                this.$emit('added');
                flash('You reply has been posted');
            },

            remove(index) {
                this.items.splice(index, 1);

                this.$emit('removed');

                flash('Reply deleted!');
            }
        }
    }
</script>