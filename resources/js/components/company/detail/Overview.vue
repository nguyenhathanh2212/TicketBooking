<template>
    <div>
        <div class="tg-bookinginfo">
            <div class="top-detail">
                <div class="col-md-4">
                    <div class="images-company">
                            <img :src="company.first_image">
                    </div>
                </div>
                <div class="col-md-8">
                    <h2>{{ company.name }}</h2>
                    <div class="tg-durationrating">
                        <rating-component
                            :rating="company.rating"></rating-component>
                        <em>({{ company.number_of_review }} {{ $t('company.reviews') }})</em>
                    </div>
                    <div class="tg-description">
                        <p>{{ company.description }}</p>
                    </div>
                </div>
            </div>
            <hr>
            <form class="tg-formtheme tg-formbookingdetail">
                <fieldset>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="tg-formicon"><i class="fa fa-map-marker"></i></div>
                            <select-option-component></select-option-component>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="tg-formicon"><i class="fa fa-map-marker"></i></div>
                            <select-option-component></select-option-component>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="tg-formicon"><i class="fa fa-calendar"></i></div>
                            <span class="tg-select choose-date">
                                <date-time-component></date-time-component>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-6 col-xs-12 btn-search-block">
                        <div class="form-group">
                            <button type="submit" class="tg-btn tg-btn-lg"><span>{{ $t('company.search') }}</span></button>
                        </div>
                    </div>
                </fieldset>
            </form>
            <ul class="tg-tripinfo">
                <li><span class="tg-tourduration tg-availabilty">{{ company.phone }}</span></li>
                <li><span class="tg-tourduration tg-location">{{ company.address }}</span></li>
                <li><span class="tg-tourduration tg-peoples">{{ company.routes ? company.routes.length : 0 }} {{ $t('company.route') }}</span></li>
            </ul>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    import Rating from '../../plugins/Rating'
    import DateTime from '../../plugins/DateTime.vue'
    import SelectOption from '../../plugins/SelectOption.vue'

    export default {
        computed: {
            ...mapState('company', [
                'company'
            ])
        },
        components: {
            ratingComponent: Rating,
            selectOptionComponent: SelectOption,
            dateTimeComponent: DateTime
        }
    }
</script>

<style scoped>
    .images-company {
        margin: 3px;
        border: 1px solid #dbdbdb;
        padding: 3px;
        border-radius: 4px;
    }

    .top-detail {
        overflow: auto;
    }

    .tg-formbookingdetail fieldset {
        padding: 10px;
    }

    .choose-date.tg-select::after {
        content: unset;
    }

    .choose-date.tg-select input {
        width: 100%;
    }

    .tg-formbookingdetail .col-md-4.col-sm-6.col-xs-12 .form-group {
        margin-bottom: 20px;
        width: 100%;
    }

    .btn-search-block {
        display: flex;
        justify-content: center;
    }

    .btn-search-block .form-group {
        width: 200px;
    }

    .date-away-input {
        height: 50px;
    }

    @media (max-width: 1199px) {
        .tg-formbookingdetail fieldset {
            padding: 10;
        }
    }
</style>
