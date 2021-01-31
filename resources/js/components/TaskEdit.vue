<template>
    <div class="modal" tabindex="-1" role="dialog" id="exampleModalCenter">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ date ? date.format('D.M.') : '' }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <autocomplete
                        v-show="autocomplete !== null && autocomplete.length > 0"
                        @update="setName($event)"
                        :value="autocomplete"
                        :route="autocompleteRoute"
                    ></autocomplete>
                    <div class="input-group" v-for="(d, k) in internalData.items" :key="k">
                        <input class="form-control" type="text" placeholder="Title" v-model="d.name" @input="updateAutocomplete(k, $event)">
                        <input class="form-control col-md-2" type="number" placeholder="0" v-model="d.amount">
                        <div class="input-group-append">
                            <button class="btn btn-danger" @click="remove(k)"><i class="fa fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Title" :value="'Sum' | translate" disabled>
                        <input class="form-control col-md-2" type="number" placeholder="0" :value="sum" disabled>
                        <div class="input-group-append">
                            <button class="btn btn-primary" @click="add"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="sendChanges">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import Autocomplete from './Autocomplete';

    export default {
        name: 'TaskEdit',
        props: {
            dayData: {
                type: Array,
                default: null
            },
            date: {
                type: Object,
                default: null
            },
            autocompleteRoute: {
                type: String,
                default: null
            }
        },
        components: {
            Autocomplete
        },
        data() {
            let ret = {
                internalData : {
                    items: [],
                    removedItems: [],
                },
                autocomplete: null,
                autocomplete_key: null
            };
            return ret;
        },
        computed: {
            sum() {
                let s = 0;
                for(var i = 0, max = this.internalData.items.length; i < max; i++)
                {
                    s += this.internalData.items[i].amount * 1.0;
                }
                return s;
            }
        },
        methods: {
            show() {
                $('#exampleModalCenter').modal("show");
            },
            hide() {
                $('#exampleModalCenter').modal("hide");
            },
            add() {
                let tmpId = this.internalData.removedItems.pop();
                tmpId = tmpId === undefined ? null : tmpId;
                this.internalData.items.push({
                    amount: 0,
                    id: tmpId,
                    name: "",
                })
            },
            remove(idx) {
                let item = this.internalData.items.splice(idx, 1).pop();
                if (item.id !== null) {
                    this.internalData.removedItems.push(item.id);
                }
            },
            sendChanges() {
                this.$emit('change', this.internalData);
            },
            updateAutocomplete(key, event) {
                this.autocomplete = event.target.value;
                this.autocomplete_key = key;
            },
            setName(value) {
                if (this.autocomplete_key !== null) {
                    this.internalData.items[this.autocomplete_key].name = value;
                }
            }
        },
        watch: {
            dayData(newVal) {
                if (newVal !== null) {
                    this.internalData.items = newVal.map(e => {
                        return Object.assign({}, e)
                    })
                }
            }
        },

        created() {
        },
        updated() {

        }
    }
</script>

<style scoped>
</style>
