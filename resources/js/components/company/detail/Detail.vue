<template>
    <div>
        <div class="tg-themetabs tg-bookingtabs">
            <ul class="tg-themetabnav" role="tablist">
                <li role="presentation" class="active">
                    <a href="#america" aria-controls="america" role="tab" data-toggle="tab">
                        <span>{{ $t('company.route') }}</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#italy" aria-controls="italy" role="tab" data-toggle="tab">
                        <span>{{ $t('company.location') }}</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#london" aria-controls="london" role="tab" data-toggle="tab">
                        <span>{{ $t('company.reviews') }}</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="#australia" aria-controls="australia" role="tab" data-toggle="tab">
                        <span>{{ $t('company.address_phone') }}</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content tg-themetabcontent">
                <route-component></route-component>
                <location-component></location-component>
                <review-component></review-component>
                <contact-component></contact-component>
            </div>
        </div>
    </div>
</template>

<script>
    import Route from '@company/detail/Route.vue'
    import Location from '@company/detail/Location.vue'
    import Review from '@company/detail/Review.vue'
    import Contact from '@company/detail/Contact.vue'

    export default {
        props: {
            company: {
                type: Object,
                required: true
            }
        },
        components: {
            routeComponent: Route,
            contactComponent: Contact,
            locationComponent: Location,
            reviewComponent: Review
        }
    }
</script>
