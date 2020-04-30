<script>
    export default {
        name: 'BulkActions',

        data() {
            var items = {};
            this.getItems().map(e => {
                if(e.dataset.id) {
                    items[e.dataset.id] = e.dataset.old ? true : false;
                }
            });
            return {
                items: items
            };
        },

        computed: {
            isBulkSelected() {
                for(var i in this.items) {
                    if (this.items[i] === true) {
                        return true;
                    }
                }
                return false;
            }
        },

        methods: {
            setBulkState(event) {
                event.preventDefault();
                var el = $('input', event.currentTarget)[0];
                this.items[el.dataset.id] = !this.items[el.dataset.id];
            },

            getItems() {
                return $("[name^='bulk_id']").toArray();
            },

            allSelection() {
                Object.keys(this.items).map(e => { this.items[e] = true; });
            },
            noSelection() {
                Object.keys(this.items).map(e => { this.items[e] = false; });
            },
            invertSelection() {
                Object.keys(this.items).map(e => { this.items[e] = !this.items[e]; });
            }

        }
    }
</script>
