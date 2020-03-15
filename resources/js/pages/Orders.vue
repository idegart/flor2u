<template>
    <v-container>
        <v-row>
            <v-col>
                <v-card>
                    <v-card-title>Заказы</v-card-title>
                    <v-data-table
                        :headers="headers"
                        :items="orders"
                        :items-per-page="5"
                        :options.sync="options"
                        :server-items-length="totalOrders"
                        :loading="loading"
                    >

                        <template v-slot:item.id="{ item }">
                            <router-link :to="{name: 'order', params: {id: item.id}}">
                                {{ item.id }}
                            </router-link>
                        </template>

                        <template v-slot:item.price="{ item }">
                            {{ getTotalPrice(item) }}
                        </template>

                        <template v-slot:item.products="{ item }">
                            <ul>
                                <li v-for="product in getItemProducts(item)" :key="product.id">
                                    <b>{{ get(product, 'name') }}</b>
                                    <small>{{ `${get(product, 'pivot.quantity')} x ${get(product, 'pivot.price')}` }}</small>
                                </li>
                            </ul>
                        </template>

                        <template v-slot:item.status="{ item }">
                            <order-status :status="get(item, 'status')" />
                        </template>
                    </v-data-table>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import { get } from 'lodash'
    import OrderStatus from "@component/OrderStatus";
    export default {
        name: "Orders",
        components: {OrderStatus},
        data: () => ({
            orders: [],
            options: {},
            loading: false,
            headers: [
                { text: 'ID', align: 'start', sortable: false, value: 'id', },
                { text: 'Партнер', align: 'start', sortable: false, value: 'partner.name', },
                { text: 'Стоимость', align: 'center', sortable: false, value: 'price', },
                { text: 'Состав', align: 'start', sortable: false, value: 'products', },
                { text: 'Статус', align: 'center', sortable: false, value: 'status', },
            ],
            totalOrders: 0,
        }),

        computed: {
            page () {
                return get(this.options, 'page')
            },
            perPage () {
                return get(this.options, 'itemsPerPage')
            },
        },

        watch: {
            options: {
                handler () {
                    this.load()
                },
                deep: true,
            },
        },

        methods: {
            get,
            load () {
                this.loading = true
                this.$http.get('/api/orders', {params: {
                        page: this.page,
                        per_page: this.perPage,
                    }})
                    .then(({data}) => {
                        this.orders = data.data
                        this.totalOrders = data.meta.total
                    })
                    .finally(() => {
                        this.loading = false
                    })
            },

            getTotalPrice (item) {
                return this.getItemProducts(item).reduce((total, product) => total + get(product, 'pivot.price', 0), 0)
            },

            getItemProducts (item) {
                return get(item, 'products', [])
            }
        },
    }
</script>

<style scoped>

</style>
