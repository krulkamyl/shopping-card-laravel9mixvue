<template>
    <div class="card" @click="redirectToRoute(item.id)" role="button">
        <div class="text-center">
            <v-lazy-image :src="'https://picsum.photos/250?random='+item.id" width="250" class="rounded mx-auto d-block mb-2 mt-2 img-fluid" :alt="item.name" >
            </v-lazy-image>
        </div>
        <div class="text-center">
            <h5>{{  item.name }}</h5> <span class="text-success">{{ item.price }} PLN</span>
        </div>
    </div>
</template>

<script>
import VLazyImage from "@hzzt/v-lazy-image";
export default {
    name: "ProductItem",
    components: {
        VLazyImage
    },
    methods: {
      redirectToRoute: function(id) {
          this.$router.push({path: '/product/'+id});
      }
    },
    props: {
        item: Object,
    }
}
</script>
