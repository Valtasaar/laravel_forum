<template>
  <div>
    <div v-if="signedIn">
      <div class="form-group">
        <textarea name="body"
                  id="body"
                  class="form-control"
                  rows="5"
                  placeholder="Have something to say?"
                  required
                  v-model="body"
        >
        </textarea>
      </div>

      <button class="btn btn-default" type="submit" @click="addReply">Post</button>
    </div>

    <p class="text-center" v-else>Please <a href="/login">sign in</a> to participate in this discussion</p>
  </div>
</template>

<script>
    export default {
        props: [],

        data() {
            return {
                body: ''
            }
        },

        created() {

        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', {body: this.body})
                    .catch(error => {
                        flash(error.response.data, 'danger');
                    })
                    .then(({data}) => {
                        this.body = '';

                        this.$emit('created', data);
                    })
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        }
    }
</script>