<template>
    <div>
        <section class="tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div class="tg-ourdestination">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 tg-verticalmiddle">
                            <figure><img src="images/placeholder/placeholder-01.png" alt="image destinations"></figure>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 tg-verticalmiddle">
                            <div class="tg-ourdestinationcontent">
                                <div class="tg-sectiontitle tg-sectiontitleleft">
                                    <h2>{{ $t('home.popular_provincial') }}</h2>
                                </div>
                                <div class="tg-description">
                                    <!-- <p>Những tỉnh thành phổ biến và có nhiều người đi...</p> -->
                                </div>
                                <ul class="tg-destinations">
                                    <li v-for="(provincial, index) in popularProvincials" :key="index">
                                        <router-link
                                            tag="a"
                                            :to="{
                                                name: 'company.index',
                                                query: {
                                                    provincial: provincial.id
                                                }
                                            }">
                                            <h3>{{ provincial.name }}</h3>
                                            <em>({{ provincial.companies_count }})</em>
                                        </router-link>
                                    </li>
                                </ul>
                                <router-link
                                    tag="a"
                                    :to="{
                                        name: 'bus_station'    
                                    }"
                                    class="tg-btn">
                                    <span>{{ $t('home.all_bus_station') }}</span>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="tg-sectionspace tg-zerotoppadding tg-haslayout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="tg-sectionhead">
                            <div class="tg-sectiontitle">
                                <h2>{{ $t('home.bus_station') }}</h2>
                            </div>
                        </div>
                        <div id="tg-guidesslider" class="tg-guidesslider tg-guides owl-carousel">
                            <div class="item tg-guide" v-for="(busStation, index) in busStations.data" :key="index">
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
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex';
    export default {
        created() {
            this.setPopularProvincials();
        },
        updated() {
            this.setSlider();
        },
        computed: {
            ...mapState('provincial', ['popularProvincials']),
            ...mapState('bus_station', [ 'busStations' ])
        },
        methods: {
            ...mapActions('provincial', ['setPopularProvincials']),
            setSlider: function() {
                var _tg_guidesslider = jQuery('#tg-guidesslider');
                _tg_guidesslider.owlCarousel({
                    loop: true,
                    dots: false,
                    nav: true,
                    margin:40,
                    autoplay: false,
                    responsiveClass:true,
                    responsive:{
                        320:{ items:1, },
                        568:{ items:2, },
                        768:{ items:2, },
                        992:{ items:2, },
                        1200:{ items:3, }
                    },
                    navText: [
                        '<i class="icon-chevron-left"></i>',
                        '<i class="icon-chevron-right"></i>',
                    ],
                    navClass: [
                        'tg-btnroundprev',
                        'tg-btnroundnext'
                    ],
                });
            }
        }
    }
</script>
