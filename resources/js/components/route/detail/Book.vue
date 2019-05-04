<template>
    <div>
        <baner-component></baner-component>
        <main id="tg-main" class="tg-main tg-haslayout">
            <div class="container component-booking">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="tg-content" class="tg-content">
                            <div class="tg-tourbookingdetail">
                                <div class="tg-bookinginfo">
                                    <div>
                                        <div class="col-md-7">
                                            aaaaaaaaaaa
                                        </div>
                                        <div class="col-md-5">
                                            <div class="panel panel-danger">
                                                <div class="panel-body" v-if="busRoute.route">
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            {{ $t('route.name') }}:
                                                        </div>
                                                        <div class="col-xs-8">
                                                            {{ name }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            {{ $t('route.phone') }}:
                                                        </div>
                                                        <div class="col-xs-8">
                                                            {{ phone }}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            {{ $t('route.company') }}:
                                                        </div>
                                                        <div class="col-xs-8">
                                                            {{ busRoute.route.company_name }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            {{ $t('company.route') }}:
                                                        </div>
                                                        <div class="col-xs-8">
                                                            {{ busRoute.route.start_station_name }} - {{ busRoute.route.destination_station_name }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            {{ $t('route.start_place') }}:
                                                        </div>
                                                        <div class="col-xs-8">
                                                            {{ startPlace }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            {{ $t('route.destination_place') }}:
                                                        </div>
                                                        <div class="col-xs-8">
                                                            {{ destinationPlace }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            {{ $t('company.start_time') }}:
                                                        </div>
                                                        <div class="col-xs-8">
                                                            {{ busRoute.route.start_time }} - {{ date }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            {{ $t('route.number_of_seats') }}:
                                                        </div>
                                                        <div class="col-xs-8">
                                                            {{ seatYouBooks.length }} ( <span class="label label-info" v-for="(seat, index) in seatYouBooks" :key="index"> {{ seat }} </span> )
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-4">
                                                            {{ $t('route.ticket_price') }}:
                                                        </div>
                                                        <div class="col-xs-8">
                                                            {{ Number(busRoute.price).toLocaleString() }}đ
                                                        </div>
                                                    </div>
                                                    <div class="row alert alert-danger">
                                                        <div class="col-xs-4">
                                                            {{ $t('route.total') }}:
                                                        </div>
                                                        <div class="col-xs-8" style="color: #f00">
                                                            {{ Number(busRoute.price).toLocaleString() }}đ
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
        computed: {
            ...mapState('bus_route', ['busRoute']),
            seatYouBooks: function () {
                return [19, 20];
            },
            destinationPlace: function () {
                return 'B';
            },
            startPlace: function () {
                return 'A';
            },
            totalPrice: function () {
                return 10000;
            },
            phone: function () {
                return '1234576';
            },
            name: function () {
                return 'Thanh';
            },
            date: function () {
                return 'date';
            },
        },
        created() {
            this.setBusRoute(this.$route.params.id);
        },
        components: {
            banerComponent: Banner
        },
        methods: {
            ...mapActions('bus_route', ['setBusRoute'])
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
</style>
