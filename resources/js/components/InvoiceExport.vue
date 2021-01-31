<template>
    <modal-form
        ref="modal"
        :name="name"
        :title="title"
        :message="message"
        @confirm="queryInvoice"
    >
        <div class="form-group row">
            <label for="staticValue" class="col-md-4 col-form-label">Amount for item</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="staticValue" name="invoice[value]" v-model=invoice.itemValue>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticValue" class="col-md-4 col-form-label">VS</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="staticValue" name="invoice[vs]" v-model=invoice.vs>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticNumber" class="col-md-4 col-form-label">Number of items</label>
            <div class="col-md-8">
                <span class="form-control-plaintext" id="staticNumber">{{ invoice.sum }}</span>
            </div>
        </div>
        <div class="form-group row">
            <label for="staticResult" class="col-md-4 col-form-label">Result</label>
            <div class="col-md-8">
                <span class="form-control-plaintext" id="staticResult">{{ total }}</span>
            </div>
        </div>
    </modal-form>
</template>

<script>
    import Vue from 'vue';
    import moment from 'moment';
    import axios from 'axios';

    import ModalForm from './ModalForm';

    export default {
        name: 'InvoiceExport',
        props: {
            name: {
                type: String,
                default: null
            },
            date: {
                type: Object,
                default: null
            },
            sum: {
                type: Number,
                default: null
            },
        },

        components: {
            ModalForm,
        },

        data() {
            return {
                title: null, //'Exporting invoice',
                message: 'Set variables below',

                invoice: {
                    itemValue: 337.5,
                    vs: '20200006',
                    sum: this.sum
                }
            };
        },

        computed: {
            total() {
                return this.invoice.itemValue * this.sum;
            }
        },

        watch: {
            sum(newVal) {
                this.invoice.sum = newVal;
            }
        },

        methods: {
            show() {
                this.$refs.modal.show();
            },
            hide() {
                this.$refs.modal.hide();
            },
            queryInvoice() {
                let data = {
                    date: this.date,
                    itemValue: this.invoice.itemValue * 1.0,
                    vs: this.invoice.vs,
                    sum: this.sum
                };
                this.$emit('confirm', data);
            }
        }
    }
</script>
