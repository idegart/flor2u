<template>
    <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
            <v-col>
                <v-card
                    class="mx-auto"
                    max-width="400"
                    :loading="loading"
                >
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title class="headline">
                                Редактировать заказ #{{ id }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-card-text>
                        <v-form
                            v-if="order"
                            ref="form"
                            v-model="valid"
                            lazy-validation
                        >
                            <v-text-field
                                v-model="order.client_email"
                                :rules="rules.clientEmail"
                                label="E-mail клиента"
                                required
                            ></v-text-field>

                            <v-select
                                v-model="order.partner_id"
                                :items="partners"
                                :rules="rules.partner"
                                label="Партнер"
                                item-value="id"
                                item-text="name"
                                required
                            ></v-select>

                            <v-select
                                v-model="order.status"
                                :items="statuses"
                                :rules="rules.status"
                                label="Партнер"
                                required
                            ></v-select>
                        </v-form>
                    </v-card-text>

                    <v-divider class="mx-4"></v-divider>

                    <v-card-title>Товары</v-card-title>

                    <v-list-item v-for="product in getItemProducts()" :key="product.id">
                        <v-list-item-title>{{ product.name }}</v-list-item-title>
                        <v-list-item-subtitle>{{ `${get(product, 'pivot.quantity')} x ${get(product, 'pivot.price')}` }}</v-list-item-subtitle>
                    </v-list-item>

                    <v-card-title>
                        Итого:
                        <v-spacer></v-spacer>
                        {{ getTotalPrice() }}
                    </v-card-title>

                    <v-divider class="mx-4"></v-divider>

                    <v-card-actions>
                        <v-btn @click="update"
                               :disabled="loading || !valid"
                               :loading="saveLoading"
                               color="success" text>
                            Сохранить
                        </v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
    import {get} from "lodash";
    import {createNamespacedHelpers} from 'vuex'
    const {mapState, mapActions} = createNamespacedHelpers('partners');

    export default {
        name: "Order",

        props: {
            id: {
                type: Number | String,
                required: true,
            },
        },

        data: () => ({
            loading: false,
            saveLoading: false,

            order: null,

            valid: false,

            rules: {
                clientEmail: [
                    v => !!v || 'Обязательное поле',
                    v => /.+@.+\..+/.test(v) || 'E-mail не валиден',
                ],
                partner: [
                    v => !!v || 'Обязательное поле',
                ],
                status: [
                    v => (!!v || v === 0) || 'Обязательное поле',
                ],
            },

            statuses: [
                { value: 0, text: 'Новый' },
                { value: 10, text: 'Подтвержден' },
                { value: 20, text: 'Завершен' },
            ],
        }),

        computed: {
            ...mapState(['partners'])
        },

        methods: {
            get,

            ...mapActions({
                initializePartners: 'initialize'
            }),

            load () {
                this.loading = true;
                this.$http.get(`/api/orders/${this.id}`)
                    .then(({data}) => {
                        this.order = data.data
                    })
                    .finally(() => {
                        this.loading = false
                    })
            },

            update () {
                if (!this.valid) {
                    return
                }

                console.log(this.order)

                this.saveLoading = true;
                this.$http.post(`/api/orders/${this.id}`, {
                    status: this.order.status,
                    partner_id: this.order.partner_id,
                    client_email: this.order.client_email,
                })
                    .finally(() => {
                        this.saveLoading = false
                    })
            },

            getTotalPrice () {
                return this.getItemProducts().reduce((total, product) => total + get(product, 'pivot.price', 0), 0)
            },

            getItemProducts () {
                return get(this.order, 'products', [])
            }
        },

        mounted() {
            this.initializePartners();
            this.load()
        }
    }
</script>

<style scoped>

</style>
