
require('./bootstrap');


window.Vue = require('vue');

require('./translation');

import ModalForm from './components/ModalForm';
import Grid from './components/Grid';

const app = new Vue({
    el: '#app',
    components: {
        ModalForm,
    },

    mixins: [
        Grid
    ],

    data() {
        
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


