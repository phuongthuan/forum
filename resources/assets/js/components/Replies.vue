<template>
    <div>
        <div v-for="(reply, index) in items">
            <reply :data="reply" @deleted="remove(index)"></reply>
            <br>
        </div>
    </div>
</template>

<script>
    import Reply from './Reply.vue';

    export default {
        components: { Reply },

        props: ['data'], //:data

        data() {
            return {
                items: this.data // items = all of the $threads collection.
            }
        },

        methods: {
            remove(index) {
                this.items.splice(index, 1);

                this.$emit('removed'); //Listen event from thread-view Component @removed
                flash('Reply was deleted!');
            }
        }
    }
</script>
