<template>
    <div>
        <!--************************************
                    Call To Action Start
            *************************************-->
        <!-- <section class="tg-parallax" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-02.jpg">
            <div class="tg-sectionspace tg-haslayout">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="tg-calltoaction">
                                <div class="tg-pattern"><img src="images/patternw.png" alt="image destination"></div>
                                <h2>Get 10% Off on your Next Travel</h2>
                                <div class="tg-description"><p>Travel between 22 April to 21 May and get existing offers along with a sure 10% cash discount</p></div>
                                <a class="tg-btn" href="javascript:void(0);"><span>Explore Tour</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!--************************************
                Call To Action End
        *************************************-->
        <!--************************************
                Our Guides Start
        *************************************-->
        <section class="tg-sectionspace tg-haslayout">
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
                                <figure><img :src="busStation.first_image" alt="image destination"></figure>
                                <div class="tg-guidecontent">
                                    <div class="tg-guidecontenthead">
                                        <h3>{{ busStation.name }}</h3>
                                        <h4>{{ busStation.address }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--************************************
                Our Guides End
        *************************************-->
        <!--************************************
                Our Partners Start
        *************************************-->
        <section class="tg-parallax tg-parallax3" data-appear-top-offset="600" data-parallax="scroll">
            <div class="tg-sectionspace tg-haslayout">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="tg-ourpartners">
                                <div class="tg-pattern"><img src="images/patternw.png" alt="image destination"></div>
                                <h2>Our Partners</h2>
                                <ul class="tg-partners">
                                    <li><figure><a href="javascript:void(0);"><img src="images/partners/img-01.png" alt="image destinations"></a></figure></li>
                                    <li><figure><a href="javascript:void(0);"><img src="images/partners/img-02.png" alt="image destinations"></a></figure></li>
                                    <li><figure><a href="javascript:void(0);"><img src="images/partners/img-03.png" alt="image destinations"></a></figure></li>
                                    <li><figure><a href="javascript:void(0);"><img src="images/partners/img-04.png" alt="image destinations"></a></figure></li>
                                    <li><figure><a href="javascript:void(0);"><img src="images/partners/img-05.png" alt="image destinations"></a></figure></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    export default {
        mounted() {
            $('.tg-parallax3').parallax({imageSrc: '/images/parallax/bgparallax-03.jpg'});
        },
        updated() {
            this.setSlider();
        },
        computed: {
            ...mapState('bus_station', [
                'busStations'
            ])
        },
        methods: {
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

<style scoped>
    .tg-guidecontenthead h4 {
        color: #b1700c;
    }

    section.tg-sectionspace.tg-haslayout {
        height: 617px;
    }
</style>
