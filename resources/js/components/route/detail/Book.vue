<template>
    <div>
        <baner-component></baner-component>
        <main id="tg-main" class="tg-main tg-haslayout">
            <div class="container component-booking">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="tg-content" class="tg-content">
                            <div class="tg-tourbookingdetail">
                                <div v-if="busRoute.route" class="tg-bookinginfo tg-formtheme tg-formbillingdetail">
                                    <div class="col-md-5 block-info">
                                        <div class="tg-bookingdetail">
                                            <div class="tg-box tg-yourorder">
                                                <div class="tg-heading">
                                                    <h3>{{ $t('route.your_info') }}</h3>
                                                </div>
                                                <div class="tg-widgetpersonprice">
                                                    <div class="tg-widgetcontent">
                                                        <ul v-if="data.check">
                                                            <li class="tg-personprice">
                                                                <div>
                                                                    <span>{{ $t('route.name') }}:</span><em>{{ data.name }}</em><br><br>
                                                                    <span>{{ $t('route.phone') }}:</span><em>{{ data.phone }}</em><br><br>
                                                                    <span>{{ $t('profile.email') }}:</span><em>{{ data.email }}</em>
                                                                </div>
                                                            </li>
                                                            <li><span>{{ $t('route.company') }}:</span><em>{{ busRoute.route.company_name }}</em></li>
                                                            <li>
                                                                <span>{{ $t('company.route') }}:</span>
                                                                <em>{{ busRoute.route.start_station_name }}</em>
                                                                <em>=> {{ busRoute.route.destination_station_name }}</em>
                                                            </li>
                                                            <li><span>{{ $t('route.start_place') }}:</span><em>{{ data.start_place ? data.start_place : busRoute.route.start_station.address }}</em></li>
                                                            <li><span>{{ $t('route.destination_place') }}:</span><em>{{ data.destination_place ? data.destination_place : busRoute.route.destination_station.address }}</em></li>
                                                            <li><span>{{ $t('company.start_time') }}:</span><em>{{ busRoute.route.start_time }} - {{ data.date_away }}</em></li>
                                                            <li>
                                                                <span>{{ $t('route.number_of_seats') }}:</span>
                                                                <em>{{ data.seat_number.length }}
                                                                    ( <template v-for="(seat, index) in data.seat_number">
                                                                        <label class="label label-info" :key="index">{{ seat }}</label>&nbsp;
                                                                    </template>)</em>
                                                            </li>
                                                            <li><span>{{ $t('route.ticket_price') }}:</span><em>{{ Number(busRoute.price).toLocaleString() }}đ</em></li>
                                                            <li class="tg-totalprice">
                                                                <div class="tg-totalpayment"><span>{{ $t('route.total') }}</span><em> {{ Number(busRoute.price * data.seat_number.length).toLocaleString() }}đ</em></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 block-checkout">
                                        <div class="tg-bookingdetail">
                                            <fieldset class="tg-paymentarea">
                                                <div class="tg-heading">
                                                    <h3>{{ $t('route.pay_method') }}</h3>
                                                </div>
                                                <div id="tg-accordion" class="tg-accordion" role="tablist" aria-multiselectable="true">
                                                    <div v-if="busRoute.route.direct_payment == directPayment.allow" class="tg-panel">
                                                        <h4 class="tg-radio">
                                                            <input :disabled="bookingSuccess" type="radio" v-model="paymentMethod" :value="paymentMethodSetting.direct" id="bank-transfer" name="paymenttype">
                                                            <label for="bank-transfer">Direct Bank Transfer</label>
                                                        </h4>
                                                        <div class="tg-panelcontent">
                                                            <div class="tg-description">
                                                                <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Vivamus sagittis lacus vel augue Sed non mauris vitae;erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tg-panel">
                                                        <h4 class="tg-radio">
                                                            <input :disabled="bookingSuccess" type="radio" id="cash" name="paymenttype">
                                                            <label for="cash">Cash On Delivery</label>
                                                        </h4>
                                                        <div class="tg-panelcontent">
                                                            <div class="tg-description">
                                                                <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Vivamus sagittis lacus vel augue Sed non mauris vitae;erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tg-panel">
                                                        <h4 class="tg-radio">
                                                            <input :disabled="bookingSuccess" type="radio" id="paypal" name="paymenttype">
                                                            <label for="paypal">PayPal Express Checkout </label>
                                                            <img src="images/paypal.jpg" alt="image description">
                                                        </h4>
                                                        <div class="tg-panelcontent">
                                                            <div class="tg-description">
                                                                <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Vivamus sagittis lacus vel augue Sed non mauris vitae;erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tg-panel">
                                                        <h4 class="tg-radio">
                                                            <input :disabled="bookingSuccess" type="radio" id="creditcard" name="paymenttype">
                                                            <label for="creditcard"> Credit Card (Stripe)</label>
                                                            <img src="images/visastrip.jpg" alt="image description">
                                                        </h4>
                                                        <div class="tg-panelcontent">
                                                            <div class="tg-description">
                                                                <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Vivamus sagittis lacus vel augue Sed non mauris vitae;erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset v-if="!bookingSuccess">
                                                <button @click="bookingTicket" class="tg-btn" type="submit"><span>place order</span></button>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import Banner from '@plugins/Banner.vue'

    export default {
        data: function() {
            return {
                directPayment: window.Laravel.setting.direct_payment,
                paymentMethodSetting: window.Laravel.setting.ticket.payment_method,
                paymentMethod: window.Laravel.setting.ticket.payment_method.direct,
                bookingSuccess: false
            }
        },
        computed: {
            ...mapState('bus_route', ['busRoute']),
            data: function() {
                return this.$route.params;
            }
        },
        created() {
            this.setBusRoute(this.$route.params.id);

            if (!this.$route.params.check) {
                this.$router.push({
                    name: '404'
                });
            }
        },
        components: {
            banerComponent: Banner
        },
        methods: {
            ...mapActions('bus_route', ['setBusRoute']),
            ...mapActions('ticket', ['createTicket']),
            bookingTicket: function () {
                this.data['payment_method'] = this.paymentMethod;
                this.createTicket(this.data)
                    .then(success => {
                        console.log(success.ticket.id);
                        this.bookingSuccess = true;
                        Swal.fire({
                            title: 'Success!',
                            text: this.$t('message.booking_success'),
                            type: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                this.$router.push({
                                    name: 'ticket.detail',
                                    params: {
                                        id: success.ticket.id
                                    }
                                })
                            }
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            title: 'Error!',
                            text: this.$t('message.booking_error'),
                            type: 'error',
                            confirmButtonText: 'Ok'
                        });
                    });;
            }
        },
        updated() {
            jQuery(function() {
                jQuery('.tg-panelcontent').hide();
                jQuery('.tg-accordion h4:first').addClass('active').next().slideDown('slow');
                jQuery('.tg-accordion h4').on('click',function() {
                    if(jQuery(this).next().is(':hidden')) {
                        jQuery('.tg-accordion h4').removeClass('active').next().slideUp('slow');
                        jQuery(this).toggleClass('active').next().slideDown('slow');
                    }
                });
            });
        }
    }
</script>

<style scoped>
    .panel-body {
        text-align: left;
        font-size: 13px;
        background: #f2faff;
    }

    .panel.panel-info .panel-body .col-xs-8 {
        font-weight: bold;
        color: #333;
    }

    .panel.panel-info .panel-body .col-xs-4 {
        color: #fa7550;
    }

    .row.alert.alert-danger {
        margin-bottom: -15px !important;
        margin-top: 15px;
        border-right: unset;
        border-bottom: unset;
        border-left: unset;
        border-radius: unset;
    }

    .tg-bookinginfo {
        padding-top: 50px;
        padding-bottom: 50px;
        margin-bottom: 100px;
    }
    
    .tg-bookinginfo .block-checkout {
        float: left;
        padding: 0 30px 0 15px;
        border-right: 1px solid #e6e6e6;
    }
    
    .tg-bookinginfo .block-info {
        float: right;
        padding: 0 15px 0 30px;
    }

    .tg-bookingdetail {
        width: 100%;
        border-right: unset;
        padding: 0px;
    }

    .tg-heading {
        margin-bottom: 10px;
    }

    .tg-widgetcontent ul li + li {
        padding: 15px 0 0;
    }

    .tg-formtheme .tg-paymentarea {
        margin-top: 0px;
    }

    .tg-heading h3 {
        float: left;
    }

    em {
        width: 64%;
        text-align: right;
    }
</style>
