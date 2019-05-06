<template>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-2">
                <i class="company-icon fa fa-bus" aria-hidden="true"></i>
                <span class="company-name">{{ busRoute.route.company_name }}</span>
            </div>
            <div class="col-md-4">
                <div class="col-12 text-center">
                    <div class="col-5 col-md-5 col-sm-12">
                        <h6>
                            {{ busRoute.route.start_station_name }} (<span>{{ busRoute.route.start_time_format }}</span>)
                        </h6>
                    </div>
                    <div class="col-2 col-md-2 col-sm-12 text-left">
                        <i class="fa fa-long-arrow-right fa-2x"></i>
                    </div>
                    <div class="col-5 col-md-5 col-sm-12">
                        <h6>
                            {{ busRoute.route.destination_station_name }} (<span>{{ busRoute.route.destination_time_format }}</span>)
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <date-picker-component v-model="date"
                    :config="{
                        format: this.$t('main.date_format'),
                        minDate: getMoment(busRoute.route.start_date),
                        maxDate: getMoment(busRoute.route.start_date, busRoute.route.number_preset_date)
                    }"></date-picker-component>
                <div>{{ `${numberOfSeat} ${$t('route.seat_empty')}` }}</div>
            </div>
            <div class="col-md-2">
                <div>
                    <div class="tg-durationrating">
                        <rating-component
                            :rating="busRoute.rating"></rating-component>
                        <em style="font-size: 12px;"><label class="label label-info">{{ busRoute.rating }}/5</label>({{ busRoute.ratings.length }} {{ $t('main.reviews') }})</em>
                    </div>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <router-link
                    :to="{ name: 'route.show', params: { id: this.busRoute.id, date: date } }"
                    class="btn btn-warning"
                    tag="a">
                    <i class="fa fa-bus" aria-hidden="true"></i> {{ $t('route.choose_seat') }}(<span>{{ Number(busRoute.price).toLocaleString() }}đ</span>)
                </router-link>
            </div>
        </div>
    </li>
</template>

<script>
    var moment = require('moment');

    import Rating from '@plugins/Rating.vue'
    import datePicker from 'vue-bootstrap-datetimepicker'

    export default {
        data: function() {
            return {
                date: this.busRoute.route.start_date
            }
        },
        props: ['busRoute'],
        computed: {
            numberOfSeat: function () {
                let count = this.busRoute.route_tickets[this.date] ? this.busRoute.route_tickets[this.date].length : 0;

                return this.busRoute.bus.number_of_seats - count;
            }
        },
        components: {
            ratingComponent: Rating,
            datePickerComponent: datePicker
        },
        methods: {
            getMoment(date, addDate = 0) {
                return moment(date, this.$t('main.date_format')).add(addDate, 'days');
            }
        }
    }
</script>

<style scoped>
    li.list-group-item {
        border-left: unset;
        border-right: unset;
        border-bottom: unset;
        border-radius: unset;
        padding: 30px 0;
        border-top: 2px solid #ffeee9;
    }

    li.list-group-item:hover {
        background: #ffeee9;
    }

    li.list-group-item > div {
        max-width: 1300px;
        margin: auto;
    }

    .company-icon {
        color: #fa7550;
        font-size: 30px;
        display: inline-block;
        padding-right: 10px;
    }

    label.label.label-info {
        padding: 5px 10px;
        margin-top: 10px;
        font-size: 12px;
        display: inline-block;
    }

    span.company-name {
        font-size: 15px;
        font-weight: bold;
        color: #333;
    }
</style>

