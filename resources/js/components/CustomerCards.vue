<template>
    <div>
        <input type="hidden" name="cards" :value="cards">
        <div
            class="form-group row"
            v-for="(c, k) in cards"
            :key="'card_'+k"
        >
            <label :for="'card_'+k" class="col-md-4 col-form-label text-md-right">{{ __('Card') +` #${k+1}` }}</label>

            <div class="col-md-6">
                <div class="input-group">
                    <masked-input
                        :id="'card_'+k"
                        class="form-control"
                        :value="c"
                        mask="11111-11111"
                        placeholder="12345-67890"
                        @input="updateCard(k, $event)"
                    />
                    <div class="input-group-append">
                        <button
                            v-if="c && k == cards.length-1"
                            class="btn btn-success"
                            type="button"
                            @click="addCard"
                        >
                            <i class="fas fa-plus"/>
                        </button>
                        <button
                            v-if="k < cards.length-1"
                            class="btn btn-danger"
                            type="button"
                            @click="removeCard(k)"
                        >
                            <i class="fas fa-times"/>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import MaskedInput from 'vue-masked-input';
    import Axios from 'axios';

    export default {
        name: "customer-cards",
        components: {
            MaskedInput
        },
        props: {
            'old-cards': {
                type: String,
                default: null
            }
        },

        data() {
            return {
                cards: this.oldCards ? this.oldCards.split(',') : [''],
                validated: []
            };
        },

        mounted() {
        },

        methods: {
            /**
             * Add Card Item
             *
             * @returns {undefined}
             */
            addCard() {
                this.cards.push('');
            },
            /**
             * Remove Card Item
             *
             * @param {int} idx
             * @returns {undefined}
             */
            removeCard(idx) {
                this.cards.splice(idx, 1);
            },

            checkNumber(value) {
                return axios.post(_cardCheckRoute+'/'+encodeURI(value));
            },

            /**
             * Update Card Item
             *
             * @param {int} idx
             * @param {string} value
             * @returns {undefined}
             */
            updateCard(idx, value) {
                if (value && !value.match(/\_+/)) {
                    var that = this;
                    this.checkNumber(value).then(result => { that.validated[idx] = result.data.checked; });
                }
                this.cards.splice(idx, 1, value.replace('_', ''));
            }
        }
    }
</script>

