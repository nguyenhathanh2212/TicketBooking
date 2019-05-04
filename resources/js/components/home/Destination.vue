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
                                    <h2>Popular Tours</h2>
                                </div>
                                <div class="tg-description"><p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam consectetuer adipiscing elit, sed diam nonummy nibh...</p></div>
                                <ul class="tg-destinations">
                                    <li>
                                        <a href="tourcatagory.html">
                                            <h3>Europe</h3>
                                            <em>(05)</em>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tourcatagory.html">
                                            <h3>Africa</h3>
                                            <em>(15)</em>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tourcatagory.html">
                                            <h3>Asia</h3>
                                            <em>(12)</em>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tourcatagory.html">
                                            <h3>Oceania</h3>
                                            <em>(02)</em>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tourcatagory.html">
                                            <h3>North America</h3>
                                            <em>(08)</em>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="tourcatagory.html">
                                            <h3>South America</h3>
                                            <em>(27)</em>
                                        </a>
                                    </li>
                                </ul>
                                <a class="tg-btn" href="tourcatagory.html"><span>all destinations</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="tg-sectionspace tg-zerotoppadding tg-haslayout">
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
    </div>
</template>

<script>
    export default {
        mounted() {
            this.setSlider();
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
    .tg-destination.custom figure figcaption h2 {
        font-size: 20px;
    }
</style>
