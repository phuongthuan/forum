<template>
        <ul class="pagination" v-if="shouldPaginate">

            <li class="page-item" v-show="preUrl">
                <a class="page-link" href="#" aria-label="Previous" @click.prevent="page--">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item" v-show="nextUrl">
                <a class="page-link" href="#" aria-label="Next" @click.prevent="page++">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>

        </ul>
</template>

<script>
    export default {
        props: ['dataSet'],

        data() {
            return {
                page: 1,
                preUrl: false,
                nextUrl: false
            }
        },

        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.preUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },

            page() {
                this.currentpage().updateUrl();
            }
        },

        computed: {
            shouldPaginate() {
                return !! this.preUrl || !! this.nextUrl;
            }
        },

        methods: {
            currentpage() {
                this.$emit('changed', this.page); // Hey I pass page to this, let listen me.
                return this;
            },

            updateUrl() {
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
</script>
