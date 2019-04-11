<template>
    <div>
        <div class="tg-themetabs tg-bookingtabs">
            <ul class="tg-themetabnav" role="tablist">
                <li role="presentation" class="active">
                    <a href="#america" aria-controls="america" role="tab" data-toggle="tab">
                        <span>Overview</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#australia" aria-controls="australia" role="tab" data-toggle="tab">
                        <span>Itinerary</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#italy" aria-controls="italy" role="tab" data-toggle="tab">
                        <span>location</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#london" aria-controls="london" role="tab" data-toggle="tab">
                        <span>Reviews</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content tg-themetabcontent">
                <over-view-component></over-view-component>
                <route-component></route-component>
                <location-component></location-component>
                <review-component></review-component>
            </div>
        </div>
    </div>
</template>

<script>
    import Overview from './Overview.vue'
    import Route from './Route.vue'
    import Location from './Location.vue'
    import Review from './Review.vue'

    export default {
        props: {
            company: {
                type: Object,
                required: true
            }
        },
        components: {
            overViewComponent: Overview,
            routeComponent: Route,
            locationComponent: Location,
            reviewComponent: Review
        }
    }
</script>
