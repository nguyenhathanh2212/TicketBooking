<template>
    <div role="tabpanel" class="tab-pane active tg-overviewtab" id="america">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div v-if="routes.total" class="tg-cartproductdetail">
                <table class="table">
                    <tr>
                        <th class="width-30pc">{{ $t('company.route') }}</th>
                        <th class="width-25pc">{{ $t('company.start_time') }}</th>
                        <th class="width-25pc">{{ $t('company.destination_time') }}</th>
                        <th class="width-20pc">{{ $t('company.number_of_bus') }}</th>
                    </tr>
                    <tbody>
                        <tr v-for="(route, index) in routes.data" :key="index">
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
                <nav v-if="routes.last_page > 1" class="tg-pagination">
                    <ul>
                        <li class="tg-prevpage" v-if="page > 1">
                            <a href="#" @click.prevent="page--"><i class="fa fa-angle-left"></i></a>
                        </li>
                        <li v-for="pageIndex in routes.last_page" :key="pageIndex" :class="pageIndex == routes.current_page ? 'tg-active' : ''">
                            <a href="#" @click.prevent="page = pageIndex">{{ pageIndex }}</a>
                        </li>
                        <li class="tg-nextpage" v-if="page < routes.last_page">
                            <a href="#" @click.prevent="page++"><i class="fa fa-angle-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div v-else>
                <div class="alert alert-info" style="margin-top: 30px" role="alert">
                    {{ $t('message.no_data_found') }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    export default {
        created() {
            this.setRoutes({
                page: this.page,
                size: this.size,
                company_id: this.company_id
            })
        },
        data: function() {
            return {
                page: 1,
                size: 5,
                company_id: this.$route.params.id
            }
        },
        watch: {
            checkChange: function() {
                this.setRoutes({
                    page: this.page,
                    size: this.size,
                    company_id: this.company_id
                })
            }
        },
        computed: {
            ...mapState('company', ['company']),
            ...mapState('route', ['routes']),
            checkChange: function () {
                return `${this.page}|${this.size}|${this.company_id}`;
            }
        },
        methods: {
            ...mapActions('route', ['setRoutes'])
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

    .tg-pagination {
        display: flex;
        justify-content: flex-end;
        float: unset;
    }
</style>
