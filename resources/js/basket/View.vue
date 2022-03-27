<template>
    <div>
        <h1>Basket</h1>
        <div class="row" v-for="(item, index) in basket" :key="index">
            <div class="row mb-2">
                <div class="col-4">
                    <v-lazy-image :src="'https://picsum.photos/250?random='+item.id" width="100" class="rounded mx-auto d-block mb-2 mt-2 img-fluid" :alt="item.name"></v-lazy-image>
                </div>
                <div class="col-8">
                    <h2>
                        <router-link :to="{name: 'product.view', params: {'id': item.id }}">{{ item.name }}</router-link>
                    </h2>
                    <p>
                        <strong>Price: </strong> {{ item.price }} PLN
                    </p>
                    <div class="text-end">
                        <button class="btn btn-danger" role="button" @click="removeFromBasket(item.id)">Remove from basket</button>
                    </div>
                </div>
            </div>
            <hr />
        </div>

        <h3>Summary price: {{ summaryPrice }} PLN</h3>
    </div>
</template>

<script>
import VLazyImage from "@hzzt/v-lazy-image";
import { mapState } from "vuex";
export default {

    components: {
        VLazyImage
    },
    name: "BasketView",
    computed: {
        ...mapState({
            basket: state => state.basket.items
        }),
        summaryPrice() {
            return this.$store.getters.basketSummaryPrice();
        }
    },
    methods: {
        removeFromBasket(id) {
            this.$store.dispatch("removeFromBasket", id);
        },
    }
}
</script>
