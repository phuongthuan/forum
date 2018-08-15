<script>
    import Replies from '../components/Replies';
    import SubcribeButton from '../components/SubcribeButton'

    export default {

        props: ['numberOfReplies'], // :number-of-replies

        components: {
            Replies,
            SubcribeButton
        },

        data() {
            return {
                repliesCount: this.numberOfReplies
            }
        }
    }
</script>
