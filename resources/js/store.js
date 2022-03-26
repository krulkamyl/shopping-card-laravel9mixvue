export default {
    state: {
        paginationIndex: 1,
        basket: {
            items: []
        }
    },
    mutations: {
        setPaginationIndex(state, payload) {
            state.paginationIndex = payload;
        },
        addToBasket(state, payload) {
            state.basket.items.push(payload);
        },
        removeFromBasket(state, payload)  {
            state.basket.items = state.basket.items.filter(item => item.bookable.id !== payload);
        },
        setBasket(state, payload) {
            state.basket = payload;
        },
    },
    actions: {
        setPaginationIndex(context, payload) {
            context.commit('setPaginationIndex', payload);
            localStorage.setItem('paginationIndex', payload);
        },
        loadStoredState(context) {
            const paginationIndex = localStorage.getItem('paginationIndex');
            if (paginationIndex) {
                context.commit('setPaginationIndex', paginationIndex);
            }

            const basket = localStorage.getItem('basket');
            if (basket) {
                context.commit('setBasket', JSON.parse(basket));
            }
        },
        addToBasket({commit, state}, payload) {
            commit('addToBasket', payload);
            localStorage.setItem('basket', JSON.stringify(state.basket));
        },
        removeFromBasket({commit, state}, payload) {
            commit('removeFromBasket', payload);
            localStorage.setItem('basket', JSON.stringify(state.basket));
        },
        clearBasket({commit, state}, payload) {
            commit("setBasket", {
                items: [

                ]
            });
            localStorage.setItem("basket", JSON.stringify(state.basket));
        },
    },
    getters: {
        itemsInBasket: (state) => state.basket.items.length,
    }
}
