<template>
    <li :class="itemClass">
        <div v-if="node.operator">
            <select :value="node.operator">
                <option v-for="o in ['and','or']" :value="o">{{ o.toUpperCase() }}</option>
            </select>
        </div>
        <div v-if="node.name">
            <div class="btn-group btn-group-sm float-right">
                <button type="button" class="btn btn-default" :title="'Remove' | translate"    @click="$emit('remove-filter')"     ><i class="fas fa-times"      aria-hidden="true"></i></button>
                <button type="button" class="btn btn-default" :title="'Move down' | translate" @click="$emit('move-filter', true)" ><i class="fas fa-caret-down" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-default" :title="'Move up' | translate"   @click="$emit('move-filter', false)"><i class="fas fa-caret-up"   aria-hidden="true"></i></button>
            </div>
            {{ node.name.toUpperCase() }} : <select :value="node.operand">
                <option v-for="o in ['like', '>', '<', '>=', '<=', 'is NULL']" :value="o">{{ o.toUpperCase() }}</option>
            </select> : <input :value="node.value" >
        </div>
        <ul :class="groupClass" v-if="node.items">
            <filter-node
                v-for="(item, k) in node.items"
                :key="`${level}_${k}`"
                :level="level+1" :node="item"
                :item-class="itemClass"
                :group-class="groupClass"
                @remove-filter="$emit('remove-filter', [k, $event])"
                @move-filter="$emit('move-filter', [k, $event])"
            />
        </ul>
    </li>
</template>
<script>
//    import BulkActions from './BulkActions';

    export default {
        name: 'FilterNode',
        props: {
            node: {
                type: Object,
                default: null
            },
            itemClass: {
                type: String,
                default: null
            },
            groupClass: {
                type: String,
                default: null
            },
            level: {
                type: Number,
                default: 0
            }
        },
        methods: {

        },
        data() {

            return {
            };
        }
    }
</script>