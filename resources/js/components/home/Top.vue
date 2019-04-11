<template>
    <div>
        <section class="tg-parallax" data-appear-top-offset="600" data-parallax="scroll" data-image-src="images/parallax/bgparallax-01.jpg">
            <div class="tg-sectionspace tg-haslayout">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="tg-sectiontitle tg-sectiontitleleft">
                                <h2>Popular Tours</h2>
                                <a class="tg-btnvtwo" href="javascript:void(0);">All Tours</a>
                            </div>
                            <div id="tg-populartoursslider" class="tg-populartoursslider tg-populartours owl-carousel">
                                <div class="item tg-populartour" v-for="(company, index) in companies" :key="index">
                                    <figure>
                                        <a href=""><img :src="company.first_image" alt="image destinations"></a>
                                        <span class="tg-descount">25% Off</span>
                                    </figure>
                                    <div class="tg-populartourcontent">
                                        <div class="tg-populartourtitle">
                                            <h3><a href="">{{ company.name }}</a></h3>
                                        </div>
                                        <div class="tg-description">
                                            <p>{{ company.description }}</p>
                                        </div>
                                        <div class="tg-populartourfoot">
                                            <div class="tg-durationrating">
                                                <span v-html="getRatingTemplate(company.rating.overview)"></span>
                                                <em>(Over view)</em> <br>
                                            </div>
                                        </div>
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
    import { get } from '../../helpers/api'

    export default {
        data() {
            return {
                companies: [],
                errors: []
            }
        },
        created() {
            this.getTopCompanies();
        },
        updated() {
            this.addSlider();
        },
        methods: {
            getRatingTemplate: function(ratting) {
                ratting = Math.round(ratting);
                var className = {
                    1: 'one',
                    2: 'two',
                    3: 'three',
                    4: 'four',
                    5: 'five'
                }

                return `<span class="tg-stars"><span class="${className[ratting]}"></span></span>`;
            },
            getTopCompanies: function () {
                get('company?size=4&page=1')
                    .then(response => {
                        this.companies = response.data.companies.data;
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            },
            addSlider: function () {
                var _tg_populartoursslider = jQuery('#tg-populartoursslider');
                _tg_populartoursslider.owlCarousel({
                    loop: true,
                    dots: false,
                    nav: true,
                    margin:30,
                    autoplay: false,
                    responsiveClass:true,
                    responsive:{
                        320:{ items:1, },
                        639:{ items:2, },
                        768:{ items:2, },
                        992:{ items:3, },
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
