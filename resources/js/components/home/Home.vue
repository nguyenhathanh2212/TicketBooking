<template>
    <div>
        <slider-conponent></slider-conponent>
        <main id="tg-main" class="tg-main tg-haslayout">
            <advanture-conponent></advanture-conponent>
            <feature-conponent></feature-conponent>
            <company-slider-conponent></company-slider-conponent>
            <!-- <destination-conponent></destination-conponent> -->
            <station-conponent></station-conponent>
        </main>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import Slider from '@home/Slider.vue'
    import Advanture from '@home/Advanture.vue'
    import Feature from '@home/Feature.vue'
    import CompanySlider from '@home/CompanySlider.vue'
    import Destination from '@home/Destination.vue'
    import Station from '@home/Station.vue'

    export default {
        components: {
            sliderConponent: Slider,
            advantureConponent: Advanture,
            featureConponent: Feature,
            companySliderConponent: CompanySlider,
            destinationConponent: Destination,
            stationConponent: Station
        },
        methods: {
            ...mapActions('company', [
                'setCompanies'
            ]),
            ...mapActions('bus_station', [
                'setBusStations'
            ]),
            ...mapActions('bus_route', [
                'setBusRoutes'
            ]),
        },
        created() {
            this.setCompanies({
                size: 4,
                page: 1
            });
            this.setBusStations({
                size: 4,
                page: 1
            });
            this.setBusRoutes({
                size: 4,
                page: 1
            });
        }
    }
</script>
