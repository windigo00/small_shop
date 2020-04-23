
require('./bootstrap');

window.Vue = require('vue');
Vue.mixin(require('./translation'));

const app = new Vue({
    el: '#app',
    components: {
    },

    data() {
        return {
        };
    },

    mounted() {
    },

    methods: {
        editItem(item) {
            console.log(item);
        },

        deleteItem(item) {
            console.log(item);
        }
    }
});
