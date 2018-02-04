<template>
    <button @click="addToBasket(product.id)" class="btn btn-success">Dodaj do koszyka {{ product.price/100 }}</button>
</template>

<script>
    export default {
        props: ['product'],
        methods: {
            addToBasket(id) {
                axios(`add-to-basket/${id}`)
                    .then(result => {
                        this.$store.state.basket = result.data;
                    });
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
