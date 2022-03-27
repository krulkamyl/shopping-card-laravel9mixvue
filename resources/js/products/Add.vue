<template>
    <div>
        <h1>{{ headerName }}</h1>
        <div v-if="hasError">
            problem with data download, try again later
        </div>
        <div v-else>
            <div class="mb-3">
                <label for="productName" class="form-label">Name</label>
                <input type="text" class="form-control" :class="{'is-invalid': this.errors.name}" id="productName" v-model="form.name">
                <div class="invalid-feedback">
                    <ul>
                        <li v-for="(item, index) in this.errors.name" :key="index">
                            {{ item }}
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Price</label>
                <input type="number" class="form-control" :class="{'is-invalid': this.errors.price}"id="productPrice" v-model="form.price">
                <div class="invalid-feedback">
                    <ul>
                        <li v-for="(item, index) in this.errors.price" :key="index">
                            {{ item }}
                        </li>
                    </ul>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" @click="submit">Submit</button>

        </div>
    </div>
</template>

<script>
export default {
    name: "Add.vue",
    data() {
        return {
            errors: {
                name: null,
                price: null
            },
            form: {
                name: null,
                price: null
            },
            hasError: false
        }
    },
    computed: {
        headerName() {
            return (this.$route.params.id) ? 'Update product' : 'Add product';
        }
    },
    methods: {
        submit() {
            let self = this;
            this.errors = {name: null, price: null};
            let axiosRequest = axios;
            if (this.$route.params.id) {
                axiosRequest = axios.put(`/product/`+this.$route.params.id, this.form).then(
                    response => {
                        alert('Product was updated!');
                        this.$router.push({path: '/product/'+response.data.id});
                    }
                )
            }
            else {
                axiosRequest = axios.post(`/product`, this.form).then(
                    response => {
                        alert('Product was created!');
                        this.$router.push({path: '/product/'+response.data.id});
                    }
                )
            }
            axiosRequest.catch(function (error) {
                if(error.response.status == 422) {
                    self.errors = error.response.data.errors;
                } else {
                    alert('Problem with request');
                }
            });
        }
    },
    mounted() {
        if (this.$route.params.id) {
            let self = this;
            axios.get(`/product/${this.$route.params.id}`).then(
                response => {
                    this.form = response.data;
                }
            ).catch(function (error) {
                self.hasError = true;
            });
        }

    },
    watch: {
        $route (to, from){
            if (to.name !== from.name) {
                this.errors = {name: null, price: null};
                this.form = {name: null, price: null};
                this.hasError = false;
            }
        }
    }
}
</script>
