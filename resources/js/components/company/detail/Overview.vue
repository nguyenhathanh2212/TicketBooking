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
                            <div class="tg-select">
                                <select class="my-selectpicker" v-model="provincial_start" data-live-search="true" data-width="100%">
                                    <option value="" selected disabled data-hidden="true">{{ $t('main.enter_start') }}</option>
                                    <option v-for="(item, index) in allProvincials"
                                        :key="index"
                                        :value="item.id"
                                        :data-tokens="item.name">{{ item.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="tg-formicon"><i class="fa fa-map-marker"></i></div>
                            <div class="tg-select">
                                <select class="my-selectpicker" v-model="provincial_destination" data-live-search="true" data-width="100%">
                                    <option value="" selected disabled data-hidden="true">{{ $t('main.enter_start') }}</option>
                                    <option v-for="(item, index) in allProvincials"
                                        :key="index"
                                        :value="item.id"
                                        :data-tokens="item.name">{{ item.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="tg-formicon"><i class="fa fa-calendar"></i></div>
                            <span class="tg-select choose-date">
                                <date-picker-component v-model="date_away"
                                    :config="{
                                        format: this.$t('main.date_format')
                                    }"
                                    :placeholder="this.$t('main.date_away')"></date-picker-component>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-6 col-xs-12 btn-search-block">
                        <div class="form-group">
                            <button type="submit" @click="search()" class="tg-btn tg-btn-lg"><span>{{ $t('company.search') }}</span></button>
                        </div>
                    </div>
                </fieldset>
            </form>
            <ul class="tg-tripinfo">
                <li><span class="tg-tourduration tg-Phone">{{ company.phone }}</span></li>
                <li><span class="tg-tourduration tg-location">{{ company.address }}</span></li>
                <li><span class="tg-tourduration tg-route">{{ company.routes ? company.routes.length : 0 }} {{ $t('company.route') }}</span></li>
            </ul>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import Rating from '@plugins/Rating'
    import DateTime from '@plugins/DateTime.vue'
    import datePicker from 'vue-bootstrap-datetimepicker'

    export default {
        data: function() {
            return {
                provincial_start: '',
                provincial_destination: '',
                date_away: ''
            }
        },
        computed: {
            ...mapState('company', ['company']),
            ...mapState('provincial', ['allProvincials'])
        },
        updated() {
            $('.my-selectpicker').selectpicker('refresh');
        },
        components: {
            ratingComponent: Rating,
            dateTimeComponent: DateTime,
            datePickerComponent: datePicker
        },
        methods: {
            ...mapActions('provincial', ['setAllProvincials']),
            search: function() {
                this.$router.push({
                    name: 'route.index',
                    query: {
                        provincial_start: this.provincial_start,
                        provincial_destination: this.provincial_destination,
                        date_away: this.date_away
                    }
                });
            }
        },
        watch: {
            provincial_start: function() {
                this.provincial_destination = this.provincial_start != 1 ? 1 : this.provincial_destination;
            },
            provincial_destination: function() {
                this.provincial_start = this.provincial_destination != 1 ? 1 : this.provincial_start;
            }
        },
        created() {
            this.setAllProvincials();
        },
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
        height: 100%;
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

    .choose-date {
        height: 50px;
    }

    @media (max-width: 1199px) {
        .tg-formbookingdetail fieldset {
            padding: 10px;
        }
    }
</style>
