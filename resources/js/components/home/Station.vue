<template>
    <div>
        <section class="tg-parallax tg-parallax2" data-appear-top-offset="600" data-parallax="scroll">
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
        </section>
        <section class="tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div id="tg-destinationsslider" class="tg-destinationsslider tg-destinations owl-carousel">
                        <div class="item tg-destination custom">
                            <figure>
                                <a href="tourbookingdetail.html"><img src="images/destination/img-04.jpg" alt="image description"></a>
                                <figcaption>
                                    <h2>
                                        <a href="tourbookingdetail.html">Paris <i class="fa fa-long-arrow-right"></i> Paris </a>
                                    </h2>
                                    <div class="tg-description">
                                        <p>in the streets of London</p>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                        <div class="item tg-destination">
                            <figure>
                                <a href="tourbookingdetail.html"><img src="images/destination/img-05.jpg" alt="image description"></a>
                                <figcaption>
                                    <h2><a href="tourbookingdetail.html">Egypt</a></h2>
                                    <div class="tg-description">
                                        <p>in the streets of London</p>
                                    </div>
                                </figcaption>
                            </figure>
                            <figure>
                                <a href="tourbookingdetail.html"><img src="images/destination/img-06.jpg" alt="image description"></a>
                                <figcaption>
                                    <h2><a href="tourbookingdetail.html">London</a></h2>
                                    <div class="tg-description">
                                        <p>in the streets of London</p>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="clearfix"></div>
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
            $('.tg-parallax2').parallax({imageSrc: '/images/parallax/bgparallax-02.jpg'});
            $('.tg-parallax3').parallax({imageSrc: '/images/parallax/bgparallax-03.jpg'});
            this.setSlider();
        },
        computed: {
            ...mapState('bus_station', [
                'busStations'
            ])
        },
        methods: {
            setSlider: function() {
                var _tg_destinationsslider = jQuery('#tg-destinationsslider');
                _tg_destinationsslider.owlCarousel({
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

    /* section.tg-sectionspace.tg-haslayout {
        height: 617px;
    } */
    
    .tg-destination.custom figure figcaption h2 {
        font-size: 20px;
    }
</style>
