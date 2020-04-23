<template>
    <div>
        <span
            :class="checkStatus"
            :title="__((value ? '' : 'Not ')+'Valid')"
        >
            <i :class="checkStatusIcon"/>
        </span>
    </div>
</template>

<script>
    export default {
        name: 'ValidityStatus',
        props: {
            value: {
                type: Number,
                default: 0
            }
        },


        computed: {
            checkStatus() {
                return {
                    'input-group-text'    : true,
                    'bg-success'          : this.value === 1,
                    'bg-warning'          : this.value === 0,
                    'bg-info'             : this.value === -1,
                    'text-white'          : this.value !== 0
                }
            },
            checkStatusIcon(idx) {
                return {
                    'fas'             : true,
                    'fa-spinner'      : this.value === -1, //check in process status
                    'fa-spin'         : this.value === -1, //check in process status
                    'fa-check-circle' : this.value === 1,
                    'fa-exclamation-triangle' : this.value === 0,
                }
            },
        },
        mounted() {

        }
    }
</script>
