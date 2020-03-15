<template>
    <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
            <v-col>
                <v-card
                    class="mx-auto"
                    max-width="400"
                    :loading="loading"
                >
                    <v-img
                        height="250"
                        :src="cityImage"
                    ></v-img>
                    <v-list-item>
                        <v-list-item-content>
                            <v-list-item-title class="headline">
                                <v-select
                                    v-model="city"
                                    :items="selectCities"
                                    :disabled="loading"
                                    label="Город"
                                ></v-select>
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <v-card-text>
                        <v-row align="center" justify="center">
                            <v-col class="display-3 text-center">
                                {{ temp }}&deg;C
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>

    const CITIES = [
        { name: 'Брянск', lat: 53.243562, lon: 34.363407, img: 'https://region.center/source/BRYANSK/2020/02/Bryansk.jpg', },
        { name: 'Москва', lat: 55.755814, lon: 37.617635, img: 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Moscow-City2015.jpg/405px-Moscow-City2015.jpg', },
        { name: 'Санкт-Петербург', lat: 59.939095, lon: 30.315868, img: 'https://img.rg.ru/img/content/176/79/33/iStock-1139409248_d_850.jpg', },
    ]

    export default {
        name: "Weather",

        data: () => ({
            temp: 0,
            loading: false,

            city: 'Брянск',
        }),

        watch: {
            city: {
                handler: function () {
                    this.load()
                },
                immediate: true
            }
        },

        computed: {
            cityData () {
                return CITIES.find(c => c.name === this.city)
            },
            cityImage () {
                return this.cityData && this.cityData.img
            },
            cityCoords () {
                return this.cityData && {
                    lat: this.cityData.lat,
                    lon: this.cityData.lon
                }
            },
            selectCities () {
                return CITIES.map(c => c.name)
            }
        },

        methods: {
            load () {
                let coords = this.cityCoords

                if (!coords) {
                    return
                }

                this.loading = true;

                this.$http.get('/api/weather', { params: coords })
                    .then(({data}) => {
                        this.temp = data.temp
                    })
                    .finally(() => {
                        this.loading = false
                    })
            },
        },
    }
</script>

<style scoped>

</style>
