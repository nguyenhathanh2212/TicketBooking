<template>
    <div class="tg-bookinginfo">
        <div class="top-detail">
            <div class="col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">1. {{ $t('route.choose_seat') }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-7">
                                <date-picker-component v-if="busRoute.route" v-model="date"
                                    :config="{
                                        format: this.$t('main.date_format'),
                                        minDate: getMoment(busRoute.route.start_date),
                                        maxDate: getMoment(busRoute.route.start_date, busRoute.route.number_preset_date)
                                    }"></date-picker-component>
                            </div>
                            <div class="col-md-5 infor-seat">{{ `${numberOfSeat} ${$t('route.seat_empty')}` }}</div>
                        </div>
                        <hr>
                        <div class="row tip-wrapper">
                            <div class="col-md-4 col-xs-4">
                                <span class="seat-tip seat-empty"></span>{{ $t('route.seat_empty') }}
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <span class="seat-tip seat-booked"></span>{{ $t('route.seat_booked') }}
                            </div>
                            <div class="col-md-4 col-xs-4">
                                <span class="seat-tip seat-choice"></span>{{ $t('route.seat_choice') }}
                            </div>
                        </div>
                        <div class="seat-choice-wrapper">
                            <div class="funkyradio" v-for="level in numberLevel" :key="level">
                                <div v-for="column in numberColumn" :key="column">
                                    <div v-for="row in numberRow"
                                         :key="row"
                                         :class="{
                                            'funkyradio-item': true,
                                            'funkyradio-info': !checkSeatChecked(id(level, column, row)),
                                            'funkyradio-danger': checkSeatChecked(id(level, column, row))
                                         }">
                                        <input type="checkbox"
                                               name="checkbox"
                                               v-model="seatChecks[id(level, column, row)]"
                                               :id="id(level, column, row)"
                                               :disabled="checkSeatChecked(id(level, column, row))"/>
                                        <label :for="id(level, column, row)" :title="id(level, column, row)">
                                            <i class="fa fa-paw" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <small v-if="!seatYouBooks.length" class="form-text text-muted error">{{ $t('message.not_select_seat') }}</small>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">2. {{ $t('route.choose_place') }}</div>
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#start-place">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $t('route.start_place') }}
                                </a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#destination-place">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> {{ $t('route.destination_place') }}
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="start-place" class="tab-pane fade in active">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="start_place"
                                              :value="busRoute.route ? busRoute.route.start_station.address : ''"
                                              v-model="placeStart">
                                        <span class="radio-title">{{ $t('route.bus_station') }}</span>
                                        {{ busRoute.route ? busRoute.route.start_station.address : '' }}
                                    </label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio"
                                              name="start_place"
                                              v-model="placeStart">
                                        <span class="radio-title">{{ $t('route.other_place') }}</span>
                                        <input class="another-place"
                                               @click="placeStart = null"
                                               v-model="otherPlaceStart"
                                               name="start_place"
                                               :data-vv-as="this.$t('route.start_place')"
                                               v-validate="{
                                                    required: !placeStart
                                               }"
                                               type="text"/>
                                        <small class="form-text text-muted error">{{ errors.first('start_place') }}</small><br>
                                        <small class="form-text text-muted error">{{ errors.first('destination_place') }}</small>
                                    </label>
                                </div>
                            </div>
                            <div id="destination-place" class="tab-pane fade">
                                <div class="radio">
                                    <label><input type="radio" name="destination_place"
                                          :value="busRoute.route ? busRoute.route.destination_station.address : ''"
                                          v-model="placeDestination"
                                          checked >
                                        <span class="radio-title">{{ $t('route.bus_station') }}</span>
                                        {{ busRoute.route ? busRoute.route.destination_station.address : '' }}
                                    </label>
                                </div>
                                <div class="radio">
                                    <label><input type="radio"
                                              @click="placeDestination = null"
                                              name="destination_place"
                                              v-model="placeDestination">
                                        <span class="radio-title">{{ $t('route.other_place') }}</span>
                                        <input class="another-place"
                                               v-model="otherPlaceDestination"
                                               @click="placeDestination = null"
                                               name="destination_place"
                                               :data-vv-as="this.$t('route.destination_place')"
                                               v-validate="{
                                                    required: !placeDestination
                                               }"
                                               type="text"/>
                                        <small class="form-text text-muted error">{{ errors.first('start_place') }}</small><br>
                                        <small class="form-text text-muted error">{{ errors.first('destination_place') }}</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">3. {{ $t('route.information') }}</div>
                    <div class="panel-body">
                        <div class="form-information">
                            <form>
                                <div class="form-group">
                                    <label for="name">{{ $t('route.name') }}</label>
                                    <input type="text"
                                           name="name"
                                           :data-vv-as="this.$t('route.name')"
                                           class="form-control" id="name"
                                           v-model="name"
                                           v-validate="{
                                                required: true
                                           }"
                                           :placeholder="this.$t('route.enter_name')">
                                    <small class="form-text text-muted error">{{ errors.first('name') }}</small>
                                </div>
                                <div class="form-group">
                                    <label for="phone">{{ $t('route.phone') }}</label>
                                    <input type="text"
                                           class="form-control"
                                           id="phone"
                                           name="phone"
                                           :data-vv-as="this.$t('route.phone')"
                                           v-model="phone"
                                           v-validate="{
                                                required: true,
                                                numeric: true
                                           }"
                                           :placeholder="this.$t('route.enter_phone')">
                                    <small class="form-text text-muted error">{{ errors.first('phone') }}</small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="top-detail">
            <div class="col-md-4 item-block">
                <div class="item-statistic">
                    <div class="col-md-4 col-sm-4 col-xs-4">{{ $t('route.number_of_seats') }}:</div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <span class="display-text">{{ seatYouBooks.length }}</span>
                    </div>
                </div>
                <div class="item-statistic">
                    <div class="col-md-4 col-sm-4 col-xs-4">{{ $t('route.total') }}:</div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <span class="display-text">
                            {{ totalPrice }}đ
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 item-block">
                <div class="item-statistic">
                    <div class="col-md-4 col-sm-4 col-xs-4">{{ $t('route.start_place') }}:</div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <span class="display-text" :title="placeStartValue">{{ placeStartValue }}</span>
                    </div>
                </div>
                <div class="item-statistic">
                    <div class="col-md-4 col-sm-4 col-xs-4">{{ $t('route.destination_place') }}:</div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        <span class="display-text" :title="placeDestinationValue"> {{ placeDestinationValue }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 item-block" style="padding: 18px;">
                <button type="button"
                    class="btn btn-warning btn-md"
                    @click="continueBooking">{{ $t('route.continue') }} <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
            </div>
            <hr>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    import datePicker from 'vue-bootstrap-datetimepicker'

    export default {
        data: function() {
            return {
                date: '',
                numberOfSeat: 0,
                seatIsBookeds: [],
                seatYouBooks: [],
                numberLevel: 0,
                numberRow: 0,
                numberColumn: 0,
                seatChecks: [],
                placeStart: '',
                otherPlaceStart: '',
                placeDestination: '',
                otherPlaceDestination: '',
                name: '',
                phone: ''
            }
        },
        computed: {
            ...mapState('bus_route', ['busRoute']),
            placeStartValue: function () {
                return this.placeStart ? this.placeStart : this.otherPlaceStart;
            },
            placeDestinationValue: function () {
                return this.placeDestination ? this.placeDestination : this.otherPlaceDestination;
            },
            totalPrice: function () {
                return Number(this.busRoute.price * this.seatYouBooks.length).toLocaleString()
            }
        },
        watch: {
            busRoute: function () {
                this.date = this.$route.params.start_date ? this.$route.params.date : this.busRoute.route.start_date;
                this.numberLevel = this.busRoute.bus.number_level;
                this.numberRow = this.busRoute.bus.number_row;
                this.numberColumn = this.busRoute.bus.number_column;
                this.placeStart = this.busRoute.route.start_station.address;
                this.placeDestination = this.busRoute.route.destination_station.address;
            },
            date: function () {
                let seats = this.busRoute.route_tickets[this.date] ? this.busRoute.route_tickets[this.date] : [];
                let count = seats.length;
                this.numberOfSeat = this.busRoute.bus.number_of_seats - count;

                let data = [];

                seats.filter(function (value) {
                    data[value.seat_number] = true;
                })
                this.seatIsBookeds = data;
                this.seatChecks = data.slice(0);
            },
            seatChecks: function () {
                this.seatYouBooks = _.difference(this.getKeys(this.seatChecks), this.getKeys(this.seatIsBookeds));
            }
        },
        methods: {
            id: function(level, column, row) {
                return ((level - 1) * this.numberRow * this.numberColumn) + ((column - 1) * this.numberRow + row);
            },
            getKeys: function(array) {
                let arrayKeys = [];

                array.filter(function (value, index) {
                    if (value) arrayKeys.push(index);
                })

                return arrayKeys
            },
            checkSeatChecked: function (number) {
                let arrayNumberSeat = this.getKeys(this.seatIsBookeds);

                return jQuery.inArray(number, arrayNumberSeat) >= 0 ? true : false;
            },
            continueBooking: function () {
                this.$validator.validate().then(valid => {
                    if (valid && this.seatYouBooks.length) {
                        var params = {
                            check: true,
                            seat_you_books: this.seatYouBooks,
                            destination_place: this.placeDestination ? '' : this.otherPlaceDestination,
                            start_place: this.placeStart ? '' : this.otherPlaceStart,
                            totalPrice: this.totalPrice,
                            phone: this.phone,
                            name: this.name,
                            date: this.date
                        }

                        this.$router.push({
                            name: 'route.booking',
                            params: params
                        })
                    }
                });
            },
            getMoment(date, addDate = 0) {
                return moment(date, this.$t('main.date_format')).add(addDate, 'days');
            }
        },
        components: {
            datePickerComponent: datePicker
        },
    }
</script>

<style scoped>
    .tg-bookinginfo {
        padding-right: 10px;
        padding-left: 10px;
    }

    .seat-choice-wrapper {
        background: #d2d3d4;
        margin: 1px;
    }

    .funkyradio {
        text-align: right;
        padding-top: 10px;
        margin: 1px 0;
        background: #fff;
    }

    .top-detail .col-md-4 {
        padding: 2px;
    }

    .nav-tabs>li {
        width: 50%;
    }

    span.seat-tip {
        display: inline-block;
        width: 15px;
        height: 15px;
        border-radius: 4px;
        margin-right: 8px;
    }

    .tab-content, .form-information {
        text-align: left;
    }

    .seat-booked {
        background: #d9534f;
    }

    .seat-empty {
        background: #D1D3D4;
    }

    .seat-choice {
        background: #5bc0de;
    }

    .tip-wrapper {
        border-bottom: 1px solid #faebcc;
        margin-bottom: 20px;
    }

    span.radio-title {
        color: #333;
        font-size: 15px;
        display: block;
        border-bottom: 1px solid #faebcc;
        margin-bottom: 5px;
    }

    .another-place {
        width: 100%;
    }

    .panel {
        min-height: 310px;
    }

    .item-statistic {
        display: block;
        width: 100%;
        height: 35px;
    }

    .item-statistic .col-md-4 {
        text-align: left;
        color: #333;
        padding-left: 15px;
    }

    .item-statistic .col-md-8 {
        text-align: right;
        color: #fa7550;
    }

    .tg-bookinginfo {
        padding-top: 50px;
        padding-bottom: 50px;
        margin-bottom: 100px;
    }

    .item-block {
        height: 74px;
        background: #f2f2f2;
        border-radius: 5px;
        border: 1px solid #fff;
    }

    .infor-seat {
        line-height: 42px;
    }

    span.display-text {
        clear: both;
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 100%;
    }
</style>
