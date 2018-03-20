<template>
    <button type="submit" :class="classes" @click="toggle">
        <span class="glyphicon glyphicon-heart"></span>
        <span v-text="favoritesCount"></span>
    </button>
</template>

<script>
    export default {
        props: ['reply'],

        data() {
            return {
                favoritesCount: this.reply.favoritesCount,
                isFavorited: this.reply.isFavorited,
            }
        },

        computed: {
            classes() {
                return ['btn', this.isFavorited ? 'btn-primary btn-sm' : 'btn-default btn-sm'];
            },

            endpoint() {
                return '/replies/' + this.reply.id + '/favorites';
            }
        },

        methods: {
            toggle() {
                this.isFavorited ? this.dislike() : this.like();
            },

            like() {
                axios.post(this.endpoint);
                this.isFavorited = true;
                this.favoritesCount++;
            },

            dislike() {
                axios.delete(this.endpoint);
                this.isFavorited = false;
                this.favoritesCount--;
            }
        }
    }
</script>
