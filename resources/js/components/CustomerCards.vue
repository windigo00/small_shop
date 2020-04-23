<template>
    <div>
        <input type="hidden" name="card_ids" :value="card_ids">
        <div
            class="form-group row"
            v-for="(c, k) in cards"
            :key="'card_'+k"
        >
            <label :for="'card_'+k" class="col-md-4 col-form-label text-md-right">{{ __('Card') +` #${k+1}` }}</label>

            <div class="col-md-6">
                <div class="input-group">
                    <validity-status
                        class="input-group-prepend"
                        :value="validated[k]"
                        v-show="c"
                    />
                    <masked-input
                        :id="'card_'+k"
                        class="form-control"
                        :value="c"
                        mask="11111-11111"
                        placeholder="12345-67890"
                        :disabled="validated[k] === -1"
                        @input="updateCard(k, $event)"
                    />
                    <div
                        v-if="(isFilled(c) && k == cards.length-1) || k < cards.length-1"
                        class="input-group-append"
                    >
                        <button
                            v-if="isFilled(c) && k == cards.length-1 && validated[k] === 1"
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
    import ValidityStatus from './Validitystatus';

    export default {
        name: "CustomerCards",
        components: {
            MaskedInput,
            ValidityStatus
        },
        props: {
            oldCards: {
                type: String,
                default: null
            },
            oldCardIds: {
                type: String,
                default: null
            }
        },

        data() {
            var cards = this.oldCards ? this.oldCards.split(',') : [''];
            var card_ids = this.oldCardIds ? this.oldCardIds.split(',') : [null];
            var valid = cards.map((e, i) => card_ids[i] ? 1 : 0);
            return {
                cards: cards,
                card_ids: card_ids,
                validated: valid
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
                this.validated.push(0);
            },
            /**
             * Remove Card Item
             *
             * @param {int} idx
             * @returns {undefined}
             */
            removeCard(idx) {
                this.cards.splice(idx, 1);
                this.validated.splice(idx, 1);
            },
            /**
             * @see window._cardCheckRoute
             *
             *
             * @param {type} value
             * @returns {unresolved}
             */
            checkNumber(value) {
                return axios.post(_cardCheckRoute+'/'+encodeURI(value));
            },

            isFilled(value) {
                return value && !value.match(/\_+/);
            },

            /**
             * Update Card Item
             *
             * @param {int} idx
             * @param {string} value
             * @returns {undefined}
             */
            updateCard(idx, value) {
                // invalidate card if changed
                if (this.validated[idx] && !this.isFilled(value)) {
                    this.validated.splice(idx, 1, 0);
                }
                //check card on server
                if (value && this.isFilled(value)) {
                    var that = this;
                    that.validated[idx] = -1;
                    this.checkNumber(value).then(result => {
                        that.validated.splice(idx, 1, (result.data.checked ? 1 : 0));
                        that.card_ids.splice(idx, 1, (result.data.checked ? result.data.card_id : null));
                    });
                }
                //update hidden input value
                this.cards.splice(idx, 1, value);
            }
        }
    }
</script>
