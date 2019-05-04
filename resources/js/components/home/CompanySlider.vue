<template>
    <div>
        <section class="tg-parallax tg-parallax1" data-appear-top-offset="600" data-parallax="scroll">
            <div class="tg-sectionspace tg-haslayout">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="tg-sectiontitle tg-sectiontitleleft">
                                <h2>{{ $t('home.companies') }}</h2>
                                <router-link
                                    :to="{ name: 'company.index' }"
                                    tag="a"
                                    class="tg-btnvtwo">
                                    {{ $t('home.all_companies') }}
                                </router-link>
                            </div>
                            <div id="tg-populartoursslider" class="tg-populartoursslider tg-populartours owl-carousel">
                                <div class="item tg-populartour" v-for="(company, index) in companies.data" :key="index">
                                    <figure>
                                        <router-link :to="{ name: 'company.show', params: { id: company.id }}">
                                            <img :src="company.first_image">
                                        </router-link>
                                    </figure>
                                    <div class="tg-populartourcontent">
                                        <div class="tg-populartourtitle">
                                            <h3>
                                                <router-link :to="{ name: 'company.show', params: { id: company.id }}">
                                                    {{ company.name }}
                                                </router-link>
                                            </h3>
                                        </div>
                                        <div class="tg-description">
                                            <p>{{ company.description }}</p>
                                        </div>
                                        <div class="tg-populartourfoot">
                                            <div class="tg-durationrating">
                                                <rating-component
                                                    :rating="company.rating"></rating-component>
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
    import { mapState, mapActions } from 'vuex'
    import Rating from '../plugins/Rating.vue'

    export default {
        components: {
            ratingComponent: Rating
        },
        mounted() {
            $('.tg-parallax1').parallax({imageSrc: '/images/parallax/bgparallax-01.jpg'});
        },
        updated() {
            this.setSlider();
        },
        computed: {
            ...mapState('company', [
                'companies'
            ])
        },
        methods: {
            getTopCompanies: function () {
                get('company?size=4&page=1')
                    .then(response => {
                        this.companies = response.data.companies.data;
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            },
            setSlider: function () {
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

<style scoped>
    section.tg-parallax.tg-parallax1 {
        height: 720px;
    }

    .tg-populartourcontent .tg-description {
        max-height: 72px;
        overflow: hidden;
    }

    .tg-populartourtitle h3 {
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
</style>
