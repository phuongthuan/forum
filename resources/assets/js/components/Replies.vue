<template>
    <div>
        <div v-for="(reply, index) in items">
            <reply :data="reply" @deleted="remove(index)"></reply>
            <br>
        </div>
        <new-reply :endpoint="endpoint" @created="add"></new-reply>
        <br>
    </div>
</template>

<script>
    import Reply from './Reply.vue';
    import NewReply from './NewReply.vue';

    export default {
        components: { Reply, NewReply },

        props: ['data'], //:data

        data() {
            return {
                items: this.data, // items = all of the $threads collection.
                endpoint: location.pathname + '/replies'
            }
        },

        methods: {
            add(reply) {
                this.items.push(reply);
                this.$emit('created');
            },

            remove(index) {
                this.items.splice(index, 1);

                this.$emit('removed'); //Listen event from thread-view Component @removed
                flash('Reply was deleted!');
            }
        }
    }
</script>
