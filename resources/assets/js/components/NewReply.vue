<template>
    <div v-if="signedIn">
        <div class="form-group">
            <textarea name="body"
                      id="body"
                      class="form-control"
                      placeholder="Have something to say?" rows="5" v-model="body" required></textarea>
        </div>

        <button type="submit" @click="addReply" class="btn btn-default">Leave comment</button>

    </div>

    <div class="col-md-auto" v-else>
        <p class="text-center">Please <a href="/login">Sign In</a> to participate in this discussion.</p>
    </div>

</template>

<script>
    export default {
        computed: {
          signedIn() {
              return window.App.signedIn;
          }
        },

        data() {
            return {
                body: '',
            }
        },

        methods: {
            addReply() {
                axios.post(location.pathname + '/replies', {body: this.body})
                    .then(response => {
                        this.body = '';
                        flash('Your reply has been posted!');
                        this.$emit('created', response.data);
                    })
            }
        }
    }
</script>
