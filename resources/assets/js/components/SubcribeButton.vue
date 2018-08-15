<template>
    <button :class="classes" @click="subcribe">Subcribe</button>
</template>

<script>
    export default {

        props: ['active'],

        computed: {
          classes() {
              return ['btn', this.active ? 'btn-primary' : 'btn-default'];
          }
        },
        methods: {
            subcribe() {
                let requestType = this.active ? 'delete' : 'post';
                axios[requestType](location.pathname + '/subcriptions');
                this.active = !this.active;
            }
        }
    }
</script>

<style scoped>

</style>