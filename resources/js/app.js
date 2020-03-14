require('./bootstrap');

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import vuetify from "@plugin/vuetify";
import router from "./router";

require("@plugin/axios")

const app = new Vue({
    el: '#app',
    vuetify,
    router,
});
