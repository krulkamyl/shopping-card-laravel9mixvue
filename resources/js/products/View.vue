<template>
    <div>
        <h1>Product view</h1>
        <div v-if="loading">
            <LoadingSpinner/>
        </div>
        <div v-else-if="hasError">
            problem with data download, try again later
        </div>
        <div v-else>
            <div class="row" v-if="data">
                <div class="col-4">
                    <v-lazy-image src="https://picsum.photos/250" width="250" class="rounded mx-auto d-block mb-2 mt-2 img-fluid" :alt="data.name" ></v-lazy-image>
                </div>
                <div class="col-8">
                    <div class="text-end">
                        <router-link class="btn btn-secondary" :to="{name: 'product.view.edit', params: {'id': data.id }}" role="button">Edit</router-link>
                        <button class="btn btn-danger" role="button" @click="removeProduct">Remove</button>
                    </div>

                    <h2>{{ data.name }}</h2>
                    <p>
                        <strong>Price: </strong> {{ data.price }} PLN
                    </p>
                    <p class="mt-3">&nbsp;</p>

                    <div class="text-center">
                        <button class="btn btn-success" role="button" @click="addToBasket" v-if="!inBasketAlready">Add to basket</button>
                        <button class="btn btn-danger" role="button" @click="removeFromBasket" v-else>Remove from basket</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LoadingSpinner from "../Shared/LoadingSpinner";
import { mapState } from "vuex";
import VLazyImage from "@hzzt/v-lazy-image";

export default {
    components: {
        LoadingSpinner,
        VLazyImage
    },
    name: "ProductView",
    data() {
        return {
            loading: true,
            hasError: false,
            data: null
        }
    },
    computed: {
        ...mapState({
            paginationIndexComputed: 'paginationIndex',
        }),
        inBasketAlready() {
            if (this.data === null) {
                return false;
            }
            return this.$store.getters.inBasketAlready(this.data.id);
        }
    },
    watch: {
        paginationIndexComputed(newValue, oldValue) {
            this.getData(newValue);
        },
    },
    methods: {
        addToBasket() {
            this.$store.dispatch("addToBasket", this.data);
        },
        removeFromBasket() {
            this.$store.dispatch("removeFromBasket", this.data.id);
        },
        removeProduct() {
            if (confirm('Did you want delete this product?')) {
                    let self = this;
                    axios.delete(`/product/${this.data.id}`).then(
                        response => {
                            alert('Product was deleted!');
                            this.$router.push({path: '/'});
                        }
                    );
            }
        }
    },
    created() {
        let self = this;
        axios.get(`/product/${this.$route.params.id}`).then(
            response => {
                this.loading = false;
                this.data = response.data;
            }
        ).catch(function (error) {
            self.loading = false;
            self.hasError = true;
        });
    }

}
</script>
