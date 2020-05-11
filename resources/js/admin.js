
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
        return {
            modalAction: null,
            modalMessage: Vue.filter('translate')('Are You Sure?!?'),
            successMessage: null,
            errorMessage: null,
        };
    },

    mounted() {
        window.addEventListener("beforeunload", () => {
            app.showMask();
        });


    },

    methods: {
        showMask() {
            $('#mask').show();
        },
        hideMask() {
            $('#mask').hide();
        },
        showSuccess(message) {
            this.successMessage = message;
        },
        showError(message) {
            this.errorMessage = message;
        },
    }
});


