<template>
    <div id="tg-content" class="tg-content">
        <div class="tg-dashboard">
            <div class="tg-box tg-mybooking">
                <div class="tg-heading">
                    <h3>{{ $t('profile.my_booking') }}</h3>
                </div>
                <div class="tg-dashboardcontent">
                    <div class="tg-content">
                        <table v-if="authBookings && authBookings.total" class="table table-responsive">
                            <tbody>
                                <tr>
                                    <th scope="col">{{ $t('profile.route') }}</th>
                                    <th scope="col">{{ $t('main.date_away') }}</th>
                                    <th scope="col">{{ $t('profile.price') }}</th>
                                    <th scope="col">{{ $t('profile.status') }}</th>
                                    <th scope="col">{{ $t('profile.action') }}</th>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr v-for="(booking, index) in authBookings.data" :key="index">
                                    <td data-title="tour name">
                                        <router-link
                                            tag="a"
                                            :to="{
                                                name: 'ticket.detail',
                                                params: {
                                                    id: booking.id
                                                }
                                            }">
                                            {{ booking.bus_route.route.start_station_name }}<br>
                                            -> {{ booking.bus_route.route.destination_station_name }}
                                        </router-link>
                                    </td>
                                    <td data-title="tour date">{{ booking.date }}</td>
                                    <td data-title="total"><strong>{{ Number(booking.total_price).toLocaleString() }}đ</strong></td>
                                    <td class="tg-status" data-title="status">
                                        <label :class="getClassStatus(booking)">
                                            {{ booking.status_str }}
                                        </label>
                                    </td>
                                    <td data-title="action" style="text-align: center;">
                                        <button
                                            :disabled="!booking.check_cancel"
                                            @click="cancel(booking)" class="btn btn-danger btn-xs">{{ $t('route.cancel') }}</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <paginate-component
            :data="authBookings"
            :routeName="'profile.my_booking'"></paginate-component>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import Paginate from '@plugins/Paginate.vue'
    import axios from 'axios'
    const queryString = require('query-string');

    export default {
        data: function () {
            return {
                statuses: window.Laravel.setting.ticket.status,
            }
        },
        created() {
            var query = this.$route.query;
            query.size = 5;
            this.setAuthBookings(query);
        },
        computed: {
            ...mapState('ticket', ['authBookings'])
        },
        methods: {
            ...mapActions('ticket', ['setAuthBookings', 'cancelTicket']),
            getClassStatus: function(booking) {
                if (booking.status == this.statuses.active) return 'label label-success';

                if (booking.status == this.statuses.cancel) return 'label label-danger';
                
                return 'label label-default'
            },
            cancel: function(booking) {
                Swal.fire({
                    title: 'Warning!',
                    text: this.$t('message.confirm_cancel_ticket'),
                    type: 'warning',
                    confirmButtonText: 'Ok'
                }).then((result) => {
                    if (result.value) {
                        this.refundPayPal(booking.sale_id);
                        this.cancelTicket(booking.id)
                            .then(success => {

                                Swal.fire({
                                    title: 'Success!',
                                    text: this.$t('message.cancel_ticket_success'),
                                    type: 'success',
                                    confirmButtonText: 'Ok'
                                })
                                var query = this.$route.query;
                                query.size = 5;
                                this.setAuthBookings(query);
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error!',
                                    text: this.$t('message.error_message'),
                                    type: 'error',
                                    confirmButtonText: 'Ok'
                                })
                            });
                    }
                });
            },
            refundPayPal: function (saleId) {
                var PAYPAL_OAUTH_API = 'https://api.sandbox.paypal.com/v1/oauth2/token/';
                var PAYPAL_PAYMENTS_API = 'https://api.sandbox.paypal.com/v1/payments/sale/';
                var PAYPAL_CLIENT =process.env.MIX_PAYPAL_CLIENT_ID;
                var PAYPAL_SECRET =process.env.MIX_PAYPAL_SECRET;
                // var basicAuth = (`${ PAYPAL_CLIENT }:${ PAYPAL_SECRET }`);
                var basicAuth = 'QWVwUVFodmxYdmZXYU1vTW8wMUVueWR2RTFrU0pKaUw4SE9QcVlkalhCRnFVeE1oYnh3aXJYLWpSRjQ5Z0t1MzVNeTJlQWRDOUJDUlVzQ2k6RUV6MnRWSGFmMUtnbFhQMF9mNGhoMGxDRmdXbG5nZlRHOHdQLUhlRDBUNVVldmZEanNqVzNUbU5sT1ctbDU4LXpIS0RhUTVHUFNDVGJtWmY';
                var data = queryString.stringify({
                    grant_type: "client_credentials"
                });
                var token = '';
                axios.post(PAYPAL_OAUTH_API, data,
                    {
                        headers: {
                            "Authorization": `Basic ${basicAuth}`,
                            "Accept": "application/json",
                            "Content-Type": "application/x-www-form-urlencoded"
                        }
                    })
                    .then(response => {
                        token = response.data.access_token;
                        axios.post(PAYPAL_PAYMENTS_API + `${saleId}/refund`, {},
                            {
                                headers: {
                                    "Authorization": `Bearer ${token}`,
                                    "Content-Type": "application/json",
                                }
                            })
                            .then(response => {
                            })
                    });
            }
        },
        watch: {
            '$route' (to, from) {
                this.setAuthBookings(this.$route.query);
            }
        },
        components: {
            paginateComponent: Paginate
        },
    }
</script>

<style scoped>
    nav.tg-pagination {
        margin-top: 15px;
        display: flex;
        justify-content: flex-end;
    }
</style>

