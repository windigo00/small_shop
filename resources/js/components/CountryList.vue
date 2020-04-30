<template>
    <span>
        <input type="hidden" :name="name" :value="currentValue">
        <button
            class="form-control btn btn-light btn-block dropdown-toggle text-left"
            type="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
        >
            {{ currentValue ? list[currentValue] : 'Select country' | translate }}
        </button>
        <div class="dropdown-menu dropdown-menu-right">
            <form>
                <input
                    type="search"
                    class="form-control"
                    :placeholder="'Select country'|translate"
                    autofocus="autofocus"
                    @input="searchTerm = $event.target.value"
                >
            </form>
            <ul
                v-if="filteredItems.length"
                class="list-group"
            >
                <li
                    v-for="(country, k) in filteredItems"
                    :value="k"
                    class="list-group-item"
                    @click="setCountry(k)"
                >
                    {{ country }}
                </li>
            </ul>
            <div v-else class="dropdown-header">
                {{ 'No results for selection' | translate }}
            </div>
        </div>
    </span>
</template>

<script>
    export default {
        name: 'CountryList',
        props: {
            name: {
                type: String,
                default: null
            },
            value: {
                type: String,
                default: null
            },
            hasError: {
                type: String,
                default: '0'
            },
            list: {
                type: Object,
                default: null
            }
        },

        data() {
            return {
                searchTerm: '',
                keys: Object.keys(this.list),
                values: Object.values(this.list),
                filteredKeys: [],
                currentValue: this.value
            }
        },

        computed: {
            filteredItems() {
                var regex = new RegExp(`.*${this.searchTerm}.*`, 'i');
                this.filteredKeys = [];
                var that = this;
                return this.values.filter((i, k) => {
                    var ret = i.match(regex);
                    if (ret) {
                        that.filteredKeys.push(k);
                    }
                    return ret;
                });
            }
        },

        mounted() {

        },

        methods: {
            setCountry(key) {
                this.currentValue = this.keys[this.filteredKeys[key]];
                this.$emit('change', this.currentValue);
            }
        }
    }
</script>

<style scoped>
    .dropdown-menu {

    }
    .list-group {
        max-height: 10em;
        overflow-y: auto;
    }
</style>