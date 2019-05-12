<template>
    <li class="list-group-item">
        <div class="row">
            <div class="col-md-2 height-item text-sm-center text-xs-center align-center-flex">
                <div>
                    <i class="company-icon fa fa-bus" aria-hidden="true"></i>
                    <span class="company-name">{{ busRoute.route.company_name }}</span>
                </div>
            </div>
            <div class="col-md-4 height-item text-center align-center-flex">
                <div class="col-5 col-md-5 col-sm-5 col-xs-5">
                    <h6>
                        {{ busRoute.route.start_station_name }}
                    </h6>
                    <span class="label label-danger">{{ busRoute.route.start_time_format }}</span>
                </div>
                <div class="col-2 col-md-2 col-sm-2 col-xs-2">
                    <i class="fa fa-long-arrow-right fa-2x"></i>
                </div>
                <div class="col-5 col-md-5 col-sm-5 col-xs-5">
                    <h6>
                        {{ busRoute.route.destination_station_name }}
                    </h6>
                    <span class="label label-success">{{ busRoute.route.destination_time_format }}</span>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-2 col-sm-6 height-item align-center-flex">
                <div class="input-group date-picker-block">
                    <date-picker-component
                        v-model="date"
                        class="date-picker-input"
                        :config="{
                            format: this.$t('main.date_format'),
                            minDate: getMoment(busRoute.route.start_date),
                            maxDate: getMoment(busRoute.route.start_date, busRoute.route.number_preset_date)
                        }"></date-picker-component>
                    <span class="input-group-addon" :title="$t('route.seat_empty')">
                        {{ numberOfSeat }}
                    </span>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 height-item align-center-flex">
                <div>
                    <div class="show-rating-block-button">
                        <div
                            @click="showRatingModal(busRoute.id)">
                            <rating-component
                                :rating="busRoute.rating"></rating-component>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-12 text-center height-item">
                <router-link
                    :to="{ name: 'route.show', params: { id: busRoute.id, date: date } }"
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
            getMoment: function(date, addDate = 0) {
                return moment(date, this.$t('main.date_format')).add(addDate, 'days');
            },
            showRatingModal: function(id) {
                this.$emit('showRatingModal', id);
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

    .height-item {
        min-height: 50px;
        margin: 10px 0px;
    }

    .date-picker-input {
        padding: 0px;
        text-align: center;
        height: 32px;
    }

    .date-picker-block {
        width: 150px;
    }

    .date-picker-block .input-group-addon {
        padding: 6px 9px;
    }

    .show-rating-block-button .tg-stars:before {
	    font-size: 16px;
    }

    .show-rating-block-button .tg-stars span, .tg-stars {
        width: 92px;
    }

    .show-rating-block-button {
        width: 100px;
        height: 22px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    /* @media (max-width: 992px) { */
        .align-center-flex {
            display: flex;
            height: 100%;
            align-items: center;
            justify-content: center;
        }
    /* } */
</style>

