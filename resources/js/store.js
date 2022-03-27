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
            if (state.basket.items.length < 3)
                state.basket.items.push(payload);
            else
                alert('Basket can contain max 3 products')
        },
        removeFromBasket(state, payload)  {
            console.log(payload);
            state.basket.items = state.basket.items.filter(item => item.id !== payload);
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
        }
    },
    getters: {
        itemsInBasket: (state) => state.basket.items.length,
        inBasketAlready(state) {
            return function(id) {
                return state.basket.items.reduce((result, item) => result || item.id === id, false)
            }
        }
    }
}
