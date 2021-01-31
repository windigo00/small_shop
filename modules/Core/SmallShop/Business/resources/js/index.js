
import Vue from 'vue/dist/vue.esm'
import moment from 'moment';

require('../../../../../../resources/js/bootstrap');
import Calendar from '../../../../../../resources/js/components/Calendar';
import ModalForm from '../../../../../../resources/js/components/ModalForm';

moment.locale($(document).find('html').first().attr('lang'));

const app = new Vue({
    el: '#admin_task_calendar',
    components: {
        Calendar,
        ModalForm
    },

    mixins: [],

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
