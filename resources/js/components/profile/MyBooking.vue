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
                                    <td data-title="action">
                                        <button :disabled="booking.check_cancel" class="tg-btnview">{{ $t('route.cancel') }}</button>
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
            ...mapActions('ticket', ['setAuthBookings']),
            getClassStatus: function(booking) {
                if (booking.status == this.statuses.active) return 'label label-success';

                if (booking.status == this.statuses.cancel) return 'label label-danger';
                
                return 'label label-default'
            }
        },
        watch: {
            '$route' (to, from) {
                console.log(this.authBookings);
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

