<template>
    <div>
        <div class="container-fluid">
            <h3>{{ internalDate.format('LL') }}</h3>
            <div class="btn-group btn-group-lg">
                <a class="btn btn-primary" @click="goPrev">{{ 'Prev' | translate }}</a>
                <a class="btn btn-primary" @click="goNow">{{ 'Today' | translate }}</a>
                <a class="btn btn-primary" @click="goNext">{{ 'Next' | translate }}</a>
            </div>
            <div class="btn-group btn-group-lg">
                <a class="btn btn-primary" @click="exportTimesheet" :title="'Export timesheet' | translate"><i class="fa fa-file-excel"></i></a>
                <a class="btn btn-primary" @click="exportInvoice" :title="'Export invoice' | translate"><i class="fa fa-file-pdf"></i></a>
            </div>

            <div class="btn btn-lg btn-success">{{ sum }}</div>
        </div>
        <hr>
        <div class="container-fluid">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th v-for="day in 7"
                            :class="{'bg-light': [6,7].includes(day)}"
                            :style="{'width': ![6,7].includes(day) ? '20%' : 'auto'}"
                        >
                            {{ moment().weekday(day-1).format('dddd') | translate }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(week, wk) in days">
                        <td v-for="(day, dk) in week"
                            :class="{'day-cell': true, 'bg-light': !day.isCurrentMonth || day.isWeekend}"
                        >
                            <span class="date badge-group">
                                <span
                                    :class="{'badge': true, 'text-white':true, 'badge-info': day.isCurrentMonth && !day.isWeekend, 'badge-secondary': !day.isCurrentMonth || day.isWeekend}"
                                >{{ day.date.format('D.M.') }}</span>
                                <span class="badge badge-primary"
                                      :key="wk +'_'+ dk"
                                      v-if="day.isCurrentMonth && !day.isWeekend"
                                      @click="setEditDay(day)"
                                ><i class="fa fa-pen"></i></span>
                            </span>
                            <component
                                class="day-cmp"
                                :is="dayComponent"
                                v-if="day.isCurrentMonth && !day.isWeekend"
                                :date="day.datef"
                                :data="internalData[day.datef]"
                            >
                            </component>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <task-edit
            :day-data="editData"
            :date="editDay ? editDay.date : null"
            ref="modal"
            @change="updateData"
            :autocomplete-route="route_links.hints"
        ></task-edit>
        <invoice-export
            ref="exportModal"
            name="exportModal"
            :date="internalDate"
            :sum="sum"
            @confirm="downloadInvoice($event)"
        ></invoice-export>
    </div>
</template>

<script>
    import Vue from 'vue';
    import moment from 'moment';
    import axios from 'axios';

    import TaskList from './TaskList';
    import TaskEdit from './TaskEdit';
    import InvoiceExport from './InvoiceExport';

    export default {
        name: 'Calendar',
        props: {
            name: {
                type: String,
                default: null
            },
            title: {
                type: String,
                default: null
            },
            date: {
                type: String,
                default: null
            },
            month: {
                type: String,
                default: null
            },
            pageType: {
                type: String,
                default: 'month'
            },
            dayComponent: {
                type: Vue.Component
            },
            routes: {
                type: String,
                default: null
            },
        },
        components: {
            TaskList,
            TaskEdit,
            InvoiceExport,
        },

        data() {
            let ret = {
                route_links: JSON.parse(this.routes),
                moment: moment,
                today: moment(this.date),
                internalDate: moment(this.month),
                internalData: {},
                days: [],

                editDay: null,
                editData: [],
            };
            ret.currentMonth = ret.internalDate.month();
            return ret;
        },
        computed: {
            sum() {
                let s = 0;

                for(var datef in this.internalData) {
                    for(var i = 0, max = this.internalData[datef].length; i < max; i++)
                    {
                        s += this.internalData[datef][i].amount * 1.0;
                    }
                }
                return s;
            }
        },
        methods: {
            isThis(date,month) {
                return date.month() === month;
            },

            updateData(data) {
                let url = this.route_links.update;
                var that = this;
                data.editDate = this.editDay.datef;

                this.axios.put(url, data)
                .then(function (response) {
                    // handle success
                    that.$refs.modal.hide();
                    that.updateDates();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
            },
            confirm() {
                this.$emit('confirm', { formId: this.$el.dataset.formId, id: this.$el.dataset.id });
            },

            setEditDay(day) {
                this.editData = this.internalData.hasOwnProperty(day.datef) ? this.internalData[day.datef] : [];
                this.editDay = day;
                this.$refs.modal.show();
            },

            goPrev() {
                this.internalDate.subtract(1, this.pageType);
                this.updateDates();
            },
            goNow() {
                this.internalDate = moment(this.month);
                this.updateDates();
            },
            goNext() {
                this.internalDate.add(1, this.pageType);
                this.updateDates();
            },

            updateDates() {
                this.fetchData(this.internalDate.format('YYYYMMDD'));
                this.start = this.internalDate.clone().startOf(this.pageType).startOf('week');
                this.end = this.internalDate.clone().endOf(this.pageType);
                this.currentMonth = this.internalDate.month();
                this.generateDays();
//                this.$forceUpdate();
            },

            generateDays() {
                var days = moment.duration(this.end.diff(this.start)).asDays(),
                    weeks = days / 7,
                    s = this.start.clone(),
                    out = [];

                for(var w = 0; w < weeks; w++) {
                    var ww = [];
                    for(var d = 0; d < 7; d++, s.add(1, 'days')) {
                        ww.push({
                            date: s.clone(),
                            datef: s.format('YYYYMMDD'),
                            isWeekend: [6,0].includes(s.day()),
                            isCurrentMonth: this.isThis(s, this.currentMonth),
                            isToday: s.isSame(this.today, 'day')
                        });
                    }
                    out.push(ww);
                }
                this.days = out;
            },

            fetchData(date) {
                this.$root.showMask();
                var that = this;
                this.axios.post(this.route_links.list.replace(/\_\_/, date))
                .then(function (response) {
                    // handle success
                    that.internalData = response.data.data;
                    that.$root.hideMask();
                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                    that.$root.hideMask();
                })
            },
            exportTimesheet(){
                var date = this.internalDate.format('YYYYMMDD');
                window.location.href = this.route_links.exports.timesheet.replace(/\_\_/, date);
            },
            exportInvoice(){
                this.$refs.exportModal.show();
            },
            downloadInvoice(data) {
                this.$root.showMask();
//                var that = this;
                var date = this.internalDate.format('YYYYMMDD');
                window.open(this.route_links.exports.invoice.replace(/\_\_/, date) + '?' + this.serializeData(data), '_blank');
//                this.axios.post(, data)
//                .then(function (response) {
//                    // handle success
//                    console.log(response);
////                    that.internalData = response.data.data;
//                    that.$root.hideMask();
//                })
//                .catch(function (error) {
//                    // handle error
//                    console.log(error);
//                    that.$root.hideMask();
//                })
            },
            serializeData(data) {
                var str = "";
                for (var key in data) {
                    if (str != "") {
                        str += "&";
                    }
                    str += key + "=" + encodeURIComponent(data[key]);
                }
                return str;
            }
        },

        created() {
            this.axios = axios.create({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            this.updateDates();
        },
        updated() {
        },
        mounted() {
            this.fetchData(this.internalDate.format('YYYYMMDD'));

        },
    }
</script>

<style scoped>
    .day-cell {
        position: relative;
        padding: 2em 1em 1em !important;
    }
    .date {
        position: absolute;
        top: 0;
        left: 0;
    }
    .badge-group {
        margin: 0;
        white-space: nowrap;
    }
    .badge-group .badge {
        font-size: 90%;
        border-radius: 0;
        margin: 0;
        float: left;
        padding: 0.6em;
        line-height: 1.15;
    }
    .badge-group .badge:last-child {
        border-radius: 0 0 0.45rem 0;
    }
</style>