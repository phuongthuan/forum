<script>
    import Replies from '../components/Replies.vue';

    export default {

        props: ['numberOfReplies'], // :number-of-replies

        components: { Replies },

        data() {
            return {
                repliesCount: this.numberOfReplies
            }
        }
    }
</script>
