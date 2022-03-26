import VueRouter from "vue-router"
import List from "./products/List"
const routes = [
    {
        path: "/",
        component: List,
        name: "product"
    }
];

const router = new VueRouter({
    routes,
    mode: 'history'
});

export default router;
