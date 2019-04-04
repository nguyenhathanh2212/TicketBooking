<template>
    <div>
        <slider-conponent></slider-conponent>
        <main id="tg-main" class="tg-main tg-haslayout">
            <advanture-conponent></advanture-conponent>
            <feature-conponent></feature-conponent>
            <top-conponent></top-conponent>
            <destination-conponent></destination-conponent>
            <end-conponent></end-conponent>
        </main>
    </div>
</template>

<script>
    import Slider from './Slider.vue'
    import Advanture from './Advanture.vue'
    import Feature from './Feature.vue'
    import Top from './Top.vue'
    import Destination from './Destination.vue'
    import End from './End.vue'

    export default {
        components: {
            sliderConponent: Slider,
            advantureConponent: Advanture,
            featureConponent: Feature,
            topConponent: Top,
            destinationConponent: Destination,
            endConponent: End,
        }
    }
</script>
