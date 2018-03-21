<template>
    <div :id="'reply-' +id" class="card">
        <div class="card-header">
            <div class="level">
                <h6 class="flex">
                    <a :href="'/profiles/' + data.owner.name"
                        v-text="data.owner.name">
                    </a> said <b>{{ data.created_at }} ...</b>
                </h6>

                <!--Favorite Icon-->
                <div v-if="signedIn">
                    <favorite :reply="data"></favorite>
                </div>

            </div>

        </div>


        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button @click="update" type="submit" class="btn btn-primary btn-sm">Update</button>
                <button @click="editing = false" type="submit" class="btn btn-link btn-sm">Cancel</button>
            </div>

            <div v-else v-text="body"></div>

        </div>


        <!--Update form-->
        <div class="card-footer level" v-if="canUpdate">
            <button @click="editing = true" type="submit" class="btn btn-sm mr-1">Edit</button>
            <button @click="destroy" type="submit" class="btn btn-danger btn-sm mr-1">Delete</button>
        </div>

    </div>
</template>


<script>
    import Favorite from './Favorite.vue';

    export default {
        props: ['data'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.data.id,
                body: this.data.body
            }
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            },

            canUpdate() {
                return this.authorize(user => this.data.user_id == user.id);
            }
        },

        methods: {
            update() {
                axios.patch('/replies/' + this.data.id, {
                    body: this.body
                });

                this.editing = false;
                flash('Updated!');
            },

            destroy() {
                axios.delete('/replies/' + this.data.id);

                // Listen event to template like @deleted or @removed...
                // and communicate with parent component Replies.
                this.$emit('deleted', this.data.id);
            }
        }
    }
</script>
