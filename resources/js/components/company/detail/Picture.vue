<template>
    <div role="tabpanel" class="tab-pane tg-gallerytab" id="picture">
        <div class="tg-gallery">
            <div class="images-company-slider owl-carousel owl-theme">
                <div class="item-slider" v-for="(image, index) in company.list_images" :key="index">
                    <img :src="image.url">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'

    export default {
        computed: {
            ...mapState('company', [
                'company'
            ])
        },
        updated() {
            this.addSlider();
        },
        methods: {
            addSlider: function() {
                $('.images-company-slider').owlCarousel({
                    items: 1,
                    loop: true,
                    dots: false,
                    nav: true,
                    margin:30,
                    autoplay: false,
                    responsiveClass:true,
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
