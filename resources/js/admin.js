
require('./bootstrap');


window.Vue = require('vue');
//require('../../node_modules/flag-icon-css');
Vue.mixin(require('./translation'));

import ModalForm from './components/ModalForm';

const app = new Vue({
    el: '#app',
    components: {
        ModalForm
    },

    data() {
        return {
        };
    },

    mounted() {
        window.addEventListener("beforeunload", () => {
            app.showMask();
        });
    },

    methods: {
        editItem(item) {
            console.log(item);
        },

        deleteItem(message, item, formId) {
            $('#'+formId).modal().show();
//            if (window.confirm(message)) {
//                console.log(item);
//            }
        },

        showMask() {
            $('#mask').show();
        }
    }
});


