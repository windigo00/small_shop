<template>
    <ul class="autocomplete">
        <li v-for="(s, k) in suggestions" :key="k" @click="$emit('update', s)">{{ s }}</li>
    </ul>
</template>
<script>
    import axios from 'axios';

    export default {
        name: 'Autocomplete',
        props: {
            value: {
                type: String,
                default: null
            },
            route: {
                type: String,
                default: null
            }
        },
        data() {
            return {
                suggestions: []
            };
        },
        watch: {
            value(newValue) {
                if (newValue !== undefined && newValue.length > 2) {
                    var that = this;
                    this.axios.get(this.route, {
                        params: {
                            hint: newValue
                        }
                    })
                    .then(function (response) {
                        // handle success
                        that.suggestions = response.data;
                    })
                    .catch(function (error) {
                        // handle error
                        console.log(error);
                    })
                }
            }
        },
        methods: {
        },

        created() {
            this.axios = axios.create({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
    }
</script>

<style scoped>
</style>

