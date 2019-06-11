<template>
    <div v-if="busRoute && busRoute.bus" class="tg-bookinginfo">
        <div class="top-detail">
            <div class="col-md-12" style="padding-top: 0px">
                <div class="panel panel-warning" style="min-height: unset">
                    <div class="panel-heading">{{ $t('route.information') }}</div>
                    <div class="panel-body text-left">
                        <div class="col-md-6" style="border-right: 1px solid #bce8f1">
                            <div>
                                <label class="col-md-5 col-sm-5 col-xs-5">{{ $t('route.driver_name') }}:</label>
                                <label class="col-md-7 col-sm-7 col-xs-7">{{ busRoute.bus.driver_name }}</label>
                            </div>
                            <div>
                                <label class="col-md-5 col-sm-5 col-xs-5">{{ $t('route.lisense_plate') }}:</label>
                                <label class="col-md-7 col-sm-7 col-xs-7">{{ busRoute.bus.lisense_plate }}</label>
                            </div>
                            <div>
                                <label class="col-md-5 col-sm-5 col-xs-5">{{ $t('route.phone') }}:</label>
                                <label class="col-md-7 col-sm-7 col-xs-7">{{ busRoute.phone }}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <label class="col-md-5 col-sm-5 col-xs-5">{{ $t('route.start_station') }}:</label>
                                <label class="col-md-7 col-sm-7 col-xs-7">
                                    {{ busRoute.route.start_station_name }}
                                    <span class="label label-danger">{{ busRoute.route.start_time_format }}</span>
                                </label>
                            </div>
                            <div>
                                <label class="col-md-5 col-sm-5 col-xs-5">{{ $t('route.destination_station') }}:</label>
                                <label class="col-md-7 col-sm-7 col-xs-7">
                                    {{ busRoute.route.destination_station_name }}
                                    <span class="label label-success">{{ busRoute.route.destination_time_format }}</span>
                                </label>
                            </div>
                            <div>
                                <label class="col-md-5 col-sm-5 col-xs-5">{{ $t('company.review') }}:</label>
                                <label class="col-md-7 col-sm-7 col-xs-7">
                                    {{ busRoute.ratings.length }} {{ $t('company.review') }}
                                    <div @click="showRatingModal()">
                                        <rating-component
                                            :rating="busRoute.rating"></rating-component>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <modal-rating-component
                    :statusModal="statusModal"
                    :idBusRoute="busRoute.id"></modal-rating-component>
            </div>
        </div>
        <div class="top-detail">
            <div class="col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">1. {{ $t('route.choose_seat') }}</div>
                    <div class="panel-body panel-body-order panel-body-choice-seat">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <date-picker-component v-if="busRoute.route" v-model="date"
                                :config="{
                                    format: this.$t('main.date_format'),
                                    minDate: getMoment(busRoute.route.start_date),
                                    maxDate: getMoment(busRoute.route.start_date, busRoute.route.number_preset_date)
                                }"></date-picker-component>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 infor-seat">
                            <template v-if="numberOfSeat > 0">
                                {{ numberOfSeat }}/{{ seats }} {{ $t('route.seat_empty') }}
                            </template>
                            <template v-else>
                                <span class="label label-danger">Hết vé</span>
                            </template>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <template v-if="typeBus">
                            <div class="wrapper-book-seat">
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
                                    <div v-if="busRoute.route.reservation == 0" class="cover-booking"></div>
                                    <div class="funkyradio" v-for="level in numberLevel" :key="level">
                                        <div v-for="(mapColumn, column) in map" :key="column">
                                            <div v-for="(mapRow, row) in mapColumn"
                                                v-if="mapRow > 0"
                                                :key="row"
                                                :class="{
                                                    'funkyradio-item': true,
                                                    'funkyradio-info': !checkSeatChecked((seats - seats / level) + mapRow),
                                                    'funkyradio-danger': checkSeatChecked((seats - seats / level) + mapRow)
                                                }">
                                                <input type="checkbox"
                                                    name="checkbox"
                                                    v-model="seatChecks[(seats - seats / level) + mapRow]"
                                                    :id="(seats - seats / level) + mapRow"
                                                    :disabled="checkSeatChecked((seats - seats / level) + mapRow)"/>
                                                <label :for="(seats - seats / level) + mapRow" :title="(seats - seats / level) + mapRow">
                                                    {{ (seats - seats / level) + mapRow }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <small v-if="busRoute.route.reservation == 1 && !seatYouBooks.length" class="form-text text-muted error">{{ $t('message.not_select_seat') }}</small>
                                <span v-if="busRoute.route.reservation == 0" class="form-text text-muted error">{{ $t('message.not_allow_reservation') }}</span>
                            </div>
                        </template>
                        <template v-if="!typeBus || busRoute.route.reservation == 0">
                            <label>
                                <span class="col-md-4" style="text-align: left;">{{ $t('route.quantity') }}</span>
                                <input class="col-md-8 quantity-order"
                                    v-model="quantity"
                                    name="quantity"
                                    :data-vv-as="this.$t('route.quantity')"
                                    v-validate="{
                                        required: true,
                                        numeric: true,
                                        max_value: numberOfSeat
                                    }"
                                    :disabled="numberOfSeat <= 0"
                                    type="text"/>
                                <small class="form-text text-muted error">{{ errors.first('quantity') }}</small>
                            </label>
                        </template>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">2. {{ $t('route.choose_place') }}</div>
                    <div class="panel-body panel-body-order">
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
                    <div class="panel-body panel-body-order">
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
                                <div class="form-group">
                                    <label for="phone">{{ $t('profile.email') }}</label>
                                    <input type="text"
                                        class="form-control"
                                        id="email"
                                        name="email"
                                        :data-vv-as="this.$t('profile.email')"
                                        v-model="email"
                                        v-validate="{
                                            required: true,
                                            email: true
                                        }"
                                        :placeholder="this.$t('route.enter_email')">
                                    <small class="form-text text-muted error">{{ errors.first('email') }}</small>
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
                        <span class="display-text">{{ quantity ? quantity : seatYouBooks.length }}</span>
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
                    :disabled="numberOfSeat <= 0"
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
    import Rating from '@plugins/Rating.vue'
    import ModalRating from '@route/ModalRating.vue'

    export default {
        data: function() {
            return {
                date: '',
                numberOfSeat: 0,
                seatIsBookeds: [],
                seatYouBooks: [],
                seatChecks: [],
                otherPlaceStart: '',
                otherPlaceDestination: '',
                name: '',
                phone: '',
                email: '',
                statusModal: 'false',
                placeStart: '',
                placeDestination: '',
                quantity: ''
            }
        },
        computed: {
            ...mapState('bus_route', ['busRoute']),
            ...mapState('auth', [
                'authenticated',
                'user'
            ]),
            placeStartValue: function () {
                return this.placeStart ? this.placeStart : this.otherPlaceStart;
            },
            placeDestinationValue: function () {
                return this.placeDestination ? this.placeDestination : this.otherPlaceDestination;
            },
            totalPrice: function () {
                var total = this.seatYouBooks.length
                    ? this.busRoute.price * this.seatYouBooks.length
                    : this.busRoute.price * this.quantity;

                return Number(total).toLocaleString()
            },
            typeBus: function () {
                return this.busRoute.bus.type_bus_id;
            },
            numberLevel: function () {
                return this.busRoute.bus.number_of_level;
            },
            map: function () {
                return JSON.parse(this.busRoute.bus.map);
            },
            seats: function () {
                return this.busRoute.bus.seats;
            } 
        },
        watch: {
            date: function () {
                this.setSeatIsBookeds();
            },
            busRoute: function () {
                this.placeStart = this.busRoute.route.start_station.address;
                this.placeDestination = this.busRoute.route.destination_station.address;
                this.date = this.$route.params.date ? this.$route.params.date : this.busRoute.route.start_date;
                let seats = this.busRoute.route_tickets[this.date] ? this.busRoute.route_tickets[this.date] : [];
                let count = 0;

                for (var index = 0; index < seats.length; index ++) {
                    count += seats[index].quantity;
                }

                this.numberOfSeat = this.busRoute.bus.seats - count;
            },
            seatChecks: function () {
                this.seatYouBooks = _.difference(this.getKeys(this.seatChecks), this.getKeys(this.seatIsBookeds));
            }
        },
        methods: {
            showRatingModal: function () {
                this.statusModal = !this.statusModal;
            },
            setSeatIsBookeds: function() {
                let seats = this.busRoute.route_tickets[this.date] ? this.busRoute.route_tickets[this.date] : [];
                let count = 0;

                for (var index = 0; index < seats.length; index ++) {
                    count += seats[index].quantity;
                }
 
                this.numberOfSeat = this.busRoute.bus.seats - count;
                let data = [];
                seats.filter(function (value) {
                    JSON.parse(value.seat_number).filter(function (seat) {
                        data[seat] = true;
                    });
                })
                this.seatIsBookeds = data;
                this.seatChecks = data.slice(0);
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
                if (!this.authenticated) {
                     Swal.fire({
                        title: 'Warning!',
                        text: this.$t('message.must_login_to_book'),
                        type: 'warning',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            jQuery('#tg-loginsingup').addClass('open');
                            jQuery('body').addClass('tg-hidescroll');
                        }
                    });
                } else {
                    this.$validator.validate().then(valid => {
                        if (valid && (this.seatYouBooks.length || this.quantity)) {
                            var params = {
                                check: true,
                                seat_number: this.seatYouBooks,
                                destination_place: this.placeDestination ? '' : this.otherPlaceDestination,
                                start_place: this.placeStart ? '' : this.otherPlaceStart,
                                total_price: this.totalPrice,
                                phone: this.phone,
                                name: this.name,
                                email: this.email,
                                date_away: this.date,
                                quantity: this.quantity ? this.quantity : this.seatYouBooks.length
                            }

                            this.$router.push({
                                name: 'route.booking',
                                params: params
                            })
                        }
                    });
                }
            },
            getMoment(date, addDate = 0) {
                return moment(date, this.$t('main.date_format')).add(addDate, 'days');
            }
        },
        components: {
            datePickerComponent: datePicker,
            ratingComponent: Rating,
            modalRatingComponent: ModalRating
        }
    }
</script>

<style scoped>
    .panel-body-order {
        min-height: 385px;
    }

    span.form-text.text-muted.error {
        font-size: 12px;
    }

    input.quantity-order {
        height: 30px;
    }

    .seat-choice-wrapper {
        position: relative;
    }

    .cover-booking {
        position: absolute;
        background: #fff0;
        z-index: 1;
        width: 100%;
        height: 100%;
    }

    .error {
        height: 15px;
        display: inline-block;
    }

    .tg-bookinginfo {
        padding-right: 10px;
        padding-left: 10px;
    }

    .seat-choice-wrapper {
        background: #fff;
        margin: 1px;
    }

    .funkyradio {
        text-align: right;
        padding: 5px;
        background: #fff;
        display: inline-block;
        width: 320px;
        border-bottom: 1px dashed #d1d3d4;
    }

    .top-detail .col-md-4, .top-detail .col-md-6, .top-detail .col-md-8, .top-detail .col-md-12 {
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
        font-size: 12px;
    }

    .item-statistic .col-md-8 {
        text-align: right;
        color: #fa7550;
        font-size: 12px;
    }

    .tg-bookinginfo {
        padding-top: 50px;
        padding-bottom: 50px;
        margin-bottom: 100px;
    }

    .item-block {
        height: 80px;
        padding: 10px 6px !important;
        background: #f2f2f2;
        border-radius: 5px;
        border: 1px solid #fff;
    }

    .infor-seat {
        height: 42px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    span.display-text {
        clear: both;
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        width: 100%;
    }

    .funkyradio input[type="checkbox"]:empty ~ label {
        line-height: 22px;
        text-indent: 24px;
        text-align: center;
        width: 42px;
        font-size: 10px;
        margin-top: 0em;
        cursor: pointer;
        color: #0c0101 !important;
        margin-bottom: 0px;
    }

    .funkyradio input[type="checkbox"]:checked ~ label:before,
    .funkyradio input[type="checkbox"]:empty ~ label:before {
        width: 20px;
    }

    .seat-choice-wrapper {
        overflow: auto;
    }

    label.col-md-5.col-sm-5.col-xs-5,
    label.col-md-7.col-sm-7.col-xs-7 {
        color: #333;
    }

    input#email {
        text-transform: lowercase;
    }

    span.tg-stars {
        cursor: pointer;
    }

    input.col-md-8.quantity-order:disabled {
        background: #f3f3f2;
    }
</style>
