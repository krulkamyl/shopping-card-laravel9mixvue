import VueRouter from "vue-router"
import List from "./products/List"
import View from "./products/View"
const routes = [
    {
        path: "/",
        component: List,
        name: "product"
    },
    {
        path: "/product/:id",
        component: View,
        name: "product.view"
    },
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
