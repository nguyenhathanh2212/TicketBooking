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
                                    <div v-for="(busStation, index) in busStations.data" :key="index" class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                        <div class="item tg-guide">
                                            <figure>
                                                <router-link :to="{ name: 'company.index', query: { station: busStation.id }}">
                                                    <img :src="busStation.first_image" alt="image destination">
                                                </router-link>
                                            </figure>
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
            this.setBusStations({
                size: this.size,
                page: this.page
            });
        },
        components: {
            bannerComponent: Banner,
            paginateComponent: Paginate
        },
        computed: {
            ...mapState('bus_station', [
                'busStations'
            ]),
            size: function() {
                return this.$route.query.size ? this.$route.query.size : 9;
            },
            page: function() {
                return this.$route.query.page ? this.$route.query.page : 1;
            }
        },
        methods: {
        ...mapActions('bus_station', [
                'setBusStations'
            ]),
        },
        watch: {
            size: function() {
                this.setBusStations({
                    size: this.size,
                    page: this.page
                });
            },
            page: function() {
                this.setBusStations({
                    size: this.size,
                    page: this.page
                });
            }
        },
    }
</script>

<style scoped>
    .tg-sectiontitle {
        padding: 0 0 70px;
    }
</style>
