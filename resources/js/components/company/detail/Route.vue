<template>
    <div role="tabpanel" class="tab-pane active tg-overviewtab" id="america">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="tg-cartproductdetail">
                <table class="table">
                    <tr>
                        <th class="width-30pc">{{ $t('company.route') }}</th>
                        <th class="width-25pc">{{ $t('company.start_time') }}</th>
                        <th class="width-25pc">{{ $t('company.destination_time') }}</th>
                        <th class="width-20pc">{{ $t('company.number_of_bus') }}</th>
                    </tr>
                    <tbody>
                        <tr v-for="(route, index) in company.routes" :key="index">
                            <td class="width-30pc">
                                <router-link
                                    :to="{
                                        name: 'route.index',
                                        query: {
                                            route: route.id
                                        }
                                    }"
                                    class="link-to-route">
                                    <div class="tg-tourname">
                                        <div class="tg-populartourcontent">
                                            <div class="tg-populartourtitle">
                                                <span>{{ route.start_station_name }}</span>
                                                <span class="fa fa-long-arrow-right"></span>
                                                <span>{{ route.destination_station_name }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </router-link>
                            </td>
                            <td class="width-25pc">
                                <div>
                                    <span>{{ route.start_time_format }}</span>
                                </div>
                            </td>
                            <td class="width-25pc">
                                <div>
                                    <span>{{ route.destination_time_format }}</span>
                                </div>
                            </td>
                            <td class="width-20pc">{{ route.number_of_buses }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'

    export default {
        computed: {
            ...mapState('company', [
                'company'
            ])
        }
    }
</script>

<style scoped>
    table > tbody {
        border-top: 2px solid #dbdbdb;
    }

    .width-20pc {
        width: 20% !important;
    }

    .width-25pc {
        width: 25% !important;
    }

    .width-30pc {
        width: 30% !important;
    }

    .tg-cartproductdetail table tr td:last-child {
        text-align: unset;
    }

    .tab-content.tg-themetabcontent {
        margin-top: 30px;
    }

    .tab-pane::before {
        content: unset;
    }

    .link-to-route {
        color: #010000;
    }

    .link-to-route:hover {
        color: #ff7550;
    }
</style>
