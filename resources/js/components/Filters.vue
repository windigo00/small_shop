<template>
    <form @submit.prevent="doSearch">
    <div v-if="true || items.length">
        <div class="mt-2">
            {{ 'Filter' | translate }}:
            <div class="btn-group btn-group-sm" role="group" :aria-label="'Switch search type' | translate">
                <a href="#" v-if="false" :class="'btn btn'+(!isSimple ? '' : '-outline')+'-primary btn'" @click="switchFilterType(false)" :title="'Switch to complex search' | translate"><i class="fas fa-list"></i></a>
                <a href="#" :class="'btn btn'+( isSimple ? '' : '-outline')+'-primary btn'" @click="switchFilterType(true)"  :title="'Switch to simple fulltext search' | translate"><i class="fas fa-window-minimize"></i></a>
            </div>
        </div>
        <div class="mt-2 form" v-if="true || isSimple">
            <fieldset>
                <div class="input-group">
                    <input class="form-control" name="search">
                </div>
            </fieldset>
        </div>
        <ul class="mt-2 list-group" v-if="false && !isSimple && items && items.length">
            <filter-node
                v-for="(item, k) in items"
                :key="`0_${k}`"
                :level="0"
                :node="item"
                item-class="list-group-item p-1"
                group-class="list-group p-1"
                @remove-filter="$emit('remove-filter', [k, $event])"
                @move-filter="$emit('move-filter', [k, $event])"
            />
        </ul>

        <div class="mt-2">
            <button type="submit" class="btn btn-primary btn-block">{{ 'Search' | translate }}</button>
        </div>
    </div>
    </form>
</template>
<script>
    import FilterNode from './filter/Node';

    export default {
        name: 'Filters',
        components: {
            FilterNode
        },
        props: {
            items: {
                type: Array,
                default: null
            },
            columnsSource: {
                type: String,
                default: null
            }
        },
        data() {
            return {
                isSimple: true,
                columns: window[this.columnsSource],
            };
        },

        methods: {
            switchFilterType(isSimple) {
                this.isSimple = isSimple;
            },

            setFilter(name) {
                this.items.push(name);
                this.$emit('change');
            },
            removeFilter(idx) {
                this.items.splice(idx, 1);
                this.$emit('change');
            },
            /**
             *
             * @param {SubmitEvent} event
             * @returns {undefined}
             */
            doSearch(event) {
                var formData = new FormData(event.target);
                console.log(JSON.stringify(formData));
                for(var pair of formData.entries()) {
                    console.log(pair[0]+ ', '+ pair[1]);
                }
            }
        }
    }
</script>
