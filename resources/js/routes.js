import VueRouter from "vue-router"
import List from "./products/List"
import View from "./products/View"
import BasketView from "./basket/View"
import Add from "./products/Add";
const routes = [
    {
        path: "/",
        component: List,
        name: "product"
    },
    {
        path: "/add",
        component: Add,
        name: "product.add"
    },
    {
        path: "/product/:id",
        component: View,
        name: "product.view"
    },
    {
        path: "/product/:id/edit",
        component: Add,
        name: "product.view.edit"
    },
    {
        path: "/basket",
        component: BasketView,
        name: "basket"
    },
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
