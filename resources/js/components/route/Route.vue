<template>
    <div>
        <baner-component></baner-component>
		<main id="tg-main" class="tg-main tg-haslayout tg-sectionspace">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div id="tg-content" class="tg-content">
                        <div class="tg-tourbookingdetail">
                            <div class="container">
                                <div class="tg-bookinginfo">
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
                                                    <button type="submit" @click="search()"  class="tg-btn tg-btn-lg"><span>{{ $t('main.search_ticket') }}</span></button>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                            <div class="tg-sectionspace tg-haslayout">
                                <route-bus-component></route-bus-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</main>
    </div>
</template>

<script>
    import { mapActions, mapState } from 'vuex'
    import Banner from '@plugins/Banner.vue'
    import RouteBus from '@route/RouteBus.vue'
    import datePicker from 'vue-bootstrap-datetimepicker'

    export default {
        data: function() {
            return {
                provincial_start: this.$route.params.provincial_start ? this.$route.params.provincial_start : '',
                provincial_destination: this.$route.params.provincial_destination ? this.$route.params.provincial_destination : '',
                date_away: this.$route.params.date_away ? this.$route.params.date_away : ''
            }
        },
        components: {
            banerComponent: Banner,
            routeBusComponent: RouteBus,
            datePickerComponent: datePicker
        },
        watch: {
            checkChange: function() {
                this.setBusRoutes({
                    size: this.size,
                    page: this.page,
                    provincial_start: this.provincial_start,
                    provincial_destination: this.provincial_start,
                    date_away: this.date_away
                });
            },
            provincial_start: function() {
                this.provincial_destination = this.provincial_start != 1 ? 1 : this.provincial_destination;
            },
            provincial_destination: function() {
                this.provincial_start = this.provincial_destination != 1 ? 1 : this.provincial_start;
            }
        },
        created() {
            this.setBusRoutes({
                size: this.size,
                page: this.page
            });
            this.setAllProvincials();
        },
        updated() {
            $('.my-selectpicker').selectpicker('refresh');
        },
        mounted() {
            $('.my-selectpicker').selectpicker('refresh');
        },
        methods: {
            ...mapActions('bus_route', [
                'setBusRoutes'
            ]),
            ...mapActions('provincial', ['setAllProvincials']),
            search: function() {
                this.setBusRoutes({
                    size: this.size,
                    page: this.page,
                    provincial_start: this.provincial_start,
                    provincial_destination: this.provincial_destination,
                    date_away: this.date_away
                });
            },
        },
        computed: {
            ...mapState('provincial', ['allProvincials']),
            size: function () {
                return this.$route.query.size ? this.$route.query.size : 9;
            },
            page: function () {
                return this.$route.query.page ? this.$route.query.page : 1;
            },
            checkChange: function () {
                return `${this.size}|${this.page}`;
            }
        }
    }
</script>

<style scoped>
    .tg-sectionspace {
        padding-top: 0px !important;
    }

    .tg-sectionspace.tg-haslayout {
        float: unset;
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

    .choose-date input.form-control {
        height: 50px;
    }

    .tg-bookinginfo {
        padding-top: 20px !important;
        padding-bottom: 30px;
        margin-top: -55px !important;
        margin-bottom: 30px;
    }

    .tg-formbookingdetail {
        padding-bottom: 0px !important;
    }

    @media (max-width: 1199px) {
        .tg-formbookingdetail fieldset {
            padding: 10px;
        }
    }
</style>

