<template>
    <div class="modal fade" :id="name" tabindex="-1" role="dialog" :aria-labelledby="name+'Label'" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 v-if="title" class="modal-title" :id="name+'Label'">{{ title }}</h5>
                    <button v-if="closeEnabled" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p v-if="message" class="lead">{{ message }}</p>
                    <form @submit.stop="">
                        <slot />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ 'Close' | translate }}</button>
                    <button type="button" class="btn btn-primary" @click="confirm">{{ 'Confirm' | translate }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'ModalForm',
        props: {
            name: {
                type: String,
                default: null
            },
            title: {
                type: String,
                default: null
            },
            message: {
                type: String,
                default: null
            },
            closeEnabled: {
                type: Boolean,
                default: true
            }
        },
        data() {
            return {

            };
        },
        methods: {
            confirm() {
//                let form = $(this.$el).find('form').first();
                this.$emit('confirm');
            },
            show() {
                $('#' + this.name).modal("show");
            },
            hide() {
                $('#' + this.name).modal("hide");
            },
        }
    }
</script>