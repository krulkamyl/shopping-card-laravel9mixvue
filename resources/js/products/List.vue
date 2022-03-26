<template>
    <div>
        <h1>Product list</h1>
        <div v-if="loading">
            <LoadingSpinner/>
        </div>
        <div v-else>
            <div class="row">
                <div class="col-md-4" v-for="(item, index) in data.data" :key="index">
                    <product-item :item="item"/>
                </div>
            </div>
            <pagination :links="data.links"/>
        </div>
    </div>
</template>

<script>
import LoadingSpinner from "../Shared/LoadingSpinner";
import Pagination from "../Shared/Pagination";
import ProductItem from "./Items/ProductItem";
import { mapState } from "vuex";

export default {
    components: {
        ProductItem,
        LoadingSpinner,
        Pagination
    },
    name: "ProductList",
    data() {
        return {
            paginationIndex: 1,
            loading: true,
            data: []
        }
    },
    computed: {
        ...mapState({
            paginationIndexComputed: 'paginationIndex',
        })
    },
    watch: {
        paginationIndexComputed(newValue, oldValue) {
            this.getData(newValue);
        },
    },
    methods: {
        getData: function(id) {
            this.loading = true;
            axios.get('/product?page='+id).then(
                response => {
                    this.loading = false;
                    this.data = response.data;
                    if(this.$route.query.page != id)
                        this.$router.replace({query: { 'page': id }});
                }
            );
        }
    },
    created() {
        let id = (this.$route.query.page) ? this.$route.query.page : this.paginationIndex;
        this.getData(id);
    }

}
</script>
