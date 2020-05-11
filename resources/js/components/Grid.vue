<script>
    import BulkActions from './BulkActions';
    import Filters from './Filters';
    import axios from 'axios';

    export default {
        name: 'Grid',
        components: {
            Filters
        },
        mixins: [
            BulkActions
        ],

        data() {
            return {
                filterItems: [
//                    {
//                        name: 'title1',
//                        operand: '>',
//                        value: 'du1'
//                    },
//                    {
//                        operator: 'and',
//                        name: 'title2',
//                        operand: '<',
//                        value: 'du2'
//                    },
//                    {
//                        operator: 'or',
//                        items: [
//                            {
//                                name: 'price3',
//                                operand: 'like',
//                                value: 'du3'
//                            },
//                            {
//                                operator: 'or',
//                                items: [
//                                    {
//                                        name: 'title4',
//                                        operand: 'like',
//                                        value: 'du4'
//                                    },
//                                    {
//                                        operator: 'and',
//                                        name: 'title5',
//                                        operand: 'like',
//                                        value: 'du5'
//                                    }
//                                ]
//                            },
//                            {
//                                operator: 'and',
//                                name: 'title6',
//                                operand: 'like',
//                                value: 'du6'
//                            }
//                        ]
//                    }
                ]
            };
        },

        computed: {
            filteredCollumns() {
                var names = this.filterItems.map(item => this.gatherNames(item));
//                console.log(names);

                return names.flat().filter((value, index, self) => {
                    return self.indexOf(value) === index;
                });
            }
        },

        methods: {
            removeFilter(e) {
                var tmpItem = e[1];
                var idx = e[0];
                var item = this.filterItems[idx];
                if (!tmpItem && idx !== undefined) {
                    this.filterItems.splice(idx, 1);
                } else {
                    while(Array.isArray(tmpItem)) {
                        idx = tmpItem[0];
                        tmpItem = tmpItem[1];
                        if (tmpItem) {
                            item = item.items[idx];
                        }
                    }
                    item.items.splice(idx, 1);
                }
            },

            moveFilter(e) {

                console.log(e);
            },

            gatherNames(node) {
                var names = [];
                if (node.items) {
                    names = node.items.map(item => this.gatherNames(item)).flat();
                }
                if (node.name) {
                    names.push(node.name);
                }
                return names;
            },
            addFilter(item) {
                this.filterItems.push({
                    operator: 'and',
                    name: item,
                    operand: '>',
                    value: 5
                });//get gefault column settings
            },

            editItem(item) {
                console.log(item);
            },

            confirmAction(event) {
                var form = $('#'+event.formId);
                form[0].dataset.confirmed = true;
                form.modal('hide');
            },

            deleteItem(message, item, formId, event) {
                var deleteRoute = event.currentTarget.getAttribute('route'),
                    that = this,
                    form = $('#'+formId);
                form[0].dataset.formId = formId;
                form[0].dataset.id = item;
                form[0].dataset.confirmed = false;
                form.modal('show')
                    .on('hide.bs.modal', () => {
                        if (form[0].dataset.confirmed) {
                            $('#delete-action-form').attr('action', deleteRoute).submit();
//                            that.showMask();
//                            axios.delete(deleteRoute).then(e => {
//                                that.showSuccess(Vue.filter('translate')(`Item id ${item} was deleted`));
//                                that.hideMask();
//                            }).catch(e => {
//
//                                that.showError(Vue.filter('translate')(`Item id ${item} cannot be deleted`));
//                                that.hideMask();
//                            });
                        }
                    });
            },
        }
    }
</script>
