<template>
    <div v-if="links && links.length > 1">
        <nav aria-label="Pagination">
            <ul class="pagination justify-content-center mt-4">
                <li v-for="(link, index) in links" :key="index" class="page-item" :class="{disabled: link.active}" @click="changePagination(splitLink(link.url), link.active)">
                    <a class="page-link" v-html="link.label" role="button"></a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: "Pagination",
    props: {
        links: Array,
    },
    methods: {
        splitLink: function (val) {
            return (val) ? val.split('?page=')[1] : '';
        },
        changePagination: function(id, disabled) {
            if (disabled === false)
                this.$store.dispatch('setPaginationIndex', id);
        }
    },


}
</script>
