<template>
    <div>
        <banner-component></banner-component>
        <main id="tg-main" class="tg-main tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="tg-content" class="tg-content">
                            <div class="tg-listing tg-listingvone">
                                <div class="tg-sectiontitle">
                                    <h2>{{ $t('main.list_bus_station') }}</h2>
                                </div>
                                <div class="clearfix"></div>
                                    <div class="row">
                                        <template v-for="(busStation, index) in busStations.data">
                                            <div :key="index" class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                                <div class="item tg-guide">
                                                    <div class="tg-topdestination">
                                                        <figure>
                                                            <router-link
                                                                    tag="a"
                                                                    class="tg-btnviewall"
                                                                    :to="{ name: 'company.index', query: { station: busStation.id }}">
                                                                View All Tours
                                                            </router-link>
                                                            <router-link
                                                                    tag="a"
                                                                    :to="{ name: 'company.index', query: { station: busStation.id }}">
                                                                <img :src="busStation.first_image" alt="image destination">
                                                            </router-link>
                                                            <figcaption>
                                                                <h2>{{ busStation.provincial.name }}</h2>
                                                                <span class="tg-totaltours">{{ busStation.companies_count }} {{ $t('main.companies') }}</span>
                                                            </figcaption>
                                                        </figure>
                                                    </div>
                                                    <div class="tg-guidecontent">
                                                        <div class="tg-guidecontenthead">
                                                            <router-link :to="{ name: 'company.index', query: { station: busStation.id }}">
                                                                <h3>{{ busStation.name }}</h3>
                                                            </router-link>
                                                            <h4>{{ busStation.address }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                <div class="clearfix"></div>
                                <paginate-component
                                    :data="busStations"
                                    :routeName="'bus_station'"></paginate-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import Banner from '@plugins/Banner.vue'
    import Paginate from '@plugins/Paginate.vue'

    export default {
        created() {
            this.setBusStations(this.$route.query);
        },
        components: {
            bannerComponent: Banner,
            paginateComponent: Paginate
        },
        computed: {
            ...mapState('bus_station', [
                'busStations'
            ])
        },
        methods: {
        ...mapActions('bus_station', [
                'setBusStations'
            ]),
        },
        watch: {
            '$route' (to, from) {
                console.log(this.busStations);
                this.setBusStations(this.$route.query);
            }
        }
    }
</script>

<style scoped>
    .tg-sectiontitle {
        padding: 0 0 70px;
    }

    .tg-topdestination figure a img {
        width: 100%;
        display: block;
        object-fit: cover;
        height: 270px;
    }

    .tg-topdestination figure figcaption h2 {
        width: 73%;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }
</style>
