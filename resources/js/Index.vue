<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <router-link class="navbar-brand " to="/">Laravel Card Demo</router-link>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{name: 'product.add'}">Add product</router-link>
                        </li>
                    </ul>

                    <ul class="navbar-nav d-flex">
                        <li class="nav-item">
                            <router-link class="nav-link" :to="{name: 'basket'}">Basket
                                <span v-if="itemsInBasket" class="badge badge-secondary">{{ itemsInBasket }}</span>
                            </router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container">
            <div class="bg-light p-5 rounded">
                <router-view></router-view>
            </div>
        </main>
    </div>
</template>

<script>
    import {
        mapState,
        mapGetters
    } from 'vuex';

    export default {
        data() {
            return {

            };
        },
        computed: {
            ...mapGetters({
                itemsInBasket: 'itemsInBasket'
            })
        },
        methods: {
        }
    }
</script>
