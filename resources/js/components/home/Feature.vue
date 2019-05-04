<template>
    <div>
        <section class="tg-sectionspace tg-zerotoppadding tg-haslayout">
            <div class="container">
                <div class="row">
                    <div class="tg-features">
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="tg-feature">
                                <div class="tg-featuretitle">
                                    <div class="tg-description">
                                        <span class="icon-statistic"><i class="fa fa-bus" aria-hidden="true"></i></span>
                                    </div>
                                    <h2><span>{{ countCompanies }}</span>{{ $t('home.companies') }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="tg-feature">
                                <div class="tg-featuretitle">
                                    <div class="tg-description">
                                        <span class="icon-statistic"><i class="fa fa-road" aria-hidden="true"></i></span>
                                    </div>
                                    <h2><span>{{ countBusRoutes }}</span>{{ $t('home.routes') }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                            <div class="tg-feature">
                                <div class="tg-featuretitle">
                                    <div class="tg-description">
                                        <span class="icon-statistic"><i class="fa fa-university" aria-hidden="true"></i></span>
                                    </div>
                                    <h2><span>{{ countBusStations }}</span>{{ $t('home.link_bus_station') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        computed: {
            ...mapGetters('bus_route', ['countBusRoutes']),
            ...mapGetters('bus_station', ['countBusStations']),
            ...mapGetters('company', ['countCompanies'])
        }
    }
</script>

<style scoped>
    .tg-featuretitle .icon-statistic {
        display: inline-block;
        height: 60px;
        width: 60px;
        line-height: 60px;
        font-size: 35px;
    }

    .tg-featuretitle {
        width: auto;
    }

    .tg-feature {
        display: flex;
        justify-content: center;
    }
</style>
