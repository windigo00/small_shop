<template>
    <table class="table table-borderless table-sm table-hover">
        <tbody>
            <tr data-item-id="" class="item" v-for="(it, key) in data" >
                <td class="item_name">
                    <div class="text-truncate name">{{ it.name }}</div>
                </td>
                <td width="2%">{{ it.amount }}h</td>
            </tr>
        </tbody>
        <tfoot>
            <tr class="table-info" v-show="data !== null">
                <td colspan="2" align="right">
                    <strong>{{ getSum() }}h</strong>
                </td>
            </tr>
        </tfoot>
    </table>
</template>

<script>
    export default {
        name: 'TaskList',
        props: {
            date: {
                type: String,
                default: null
            },
            data: {
                type: Array,
                default: null
            },
        },
        data() {
            let ret = {
            };
            return ret;
        },
        methods: {
            getSum() {
                let sum = 0;
                for(var i in this.data) {
                    sum += this.data[i].amount * 1.0;
                }
                return sum;
            },
        },

        created() {
        }
    }
</script>

<style scoped>
    .table td {
        padding: 0;
    }

    .name {
        max-width: 16em;
    }
</style>