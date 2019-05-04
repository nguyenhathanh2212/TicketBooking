<template>
    <div>
        <div class="tg-bannerholder">
            <div class="tg-slidercontent">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <h1>Experience the Wonder</h1>
                            <h2>People don’t take trips, trips take People</h2>
                            <form class="tg-formtheme tg-formtrip">
                                <fieldset>
                                    <div class="form-group">
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
                                    <div class="form-group">
                                        <button @click="changeSelectOption" class="btn btn-default btn-change"><i class="fa fa-exchange" aria-hidden="true"></i></button>
                                    </div>
                                    <div class="form-group">
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
                                    <div class="form-group block-date-away">
                                        <date-picker-component v-model="date_away"
                                            :config="{
                                                format: this.$t('main.date_format')
                                            }"
                                            :placeholder="this.$t('main.date_away')"></date-picker-component>
                                    </div>
                                    <div class="form-group">
                                        <button class="tg-btn" @click="search()" type="submit"><span>{{ $t('main.search_ticket') }}</span></button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tg-homeslider" class="tg-homeslider owl-carousel tg-haslayout">
                <figure id="vide1" class="item"></figure>
                <figure id="vide2" class="item"></figure>
                <figure id="vide3" class="item"></figure>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import datePicker from 'vue-bootstrap-datetimepicker'

    export default {
        data: function() {
            return {
                provincial_start: '',
                provincial_destination: '',
                date_away: ''
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
        mounted() {
            this.addVide();
            this.addSlider();
            $('.my-selectpicker').selectpicker('refresh');
        },
        components: {
            datePickerComponent: datePicker,
        },
        computed: {
            ...mapState('provincial', ['allProvincials'])
        },
        created() {
            this.setAllProvincials();
        },
        updated() {
            $('.my-selectpicker').selectpicker('refresh');
        },
        methods: {
            ...mapActions('provincial', ['setAllProvincials']),
            changeSelectOption: function() {
                let temp = this.provincial_destination;
                this.provincial_destination = this.provincial_start;
                this.provincial_start = temp;
            },
            addVide: function() {
                $('#vide1').vide({ poster: '/images/slider/img-01.jpg' }, { position: '0% 50%' });
                $('#vide2').vide({ poster: '/images/slider/img-02.jpg' }, { position: '0% 50%' });
                $('#vide3').vide({ poster: '/images/slider/img-03.jpg' }, { position: '0% 50%' });
            },
            addSlider: function() {
                var _tg_homeslider = jQuery('#tg-homeslider');
                _tg_homeslider.owlCarousel({
                    items: 1,
                    loop: true,
                    dots: true,
                    nav: false,
                    autoplay: true,
                    animateIn: 'fadeIn',
                    animateOut: 'fadeOut',
                    navText: [
                        '<i class="icon-chevron-left"></i>',
                        '<i class="icon-chevron-right"></i>',
                    ],
                    navClass: [
                        'tg-btnroundprev',
                        'tg-btnroundnext'
                    ],
                });
                jQuery('.owl-carousel').mouseover(function(){
                    _tg_homeslider.trigger('stop.owl.autoplay');
                });
                jQuery('.owl-carousel').mouseleave(function(){
                    _tg_homeslider.trigger('play.owl.autoplay',[1000]);
                });
            },
            search: function() {
                this.$router.push({
                    name: 'route.index',
                    params: {
                        provincial_start: this.provincial_start,
                        provincial_destination: this.provincial_destination,
                        date_away: this.date_away
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .tg-formtrip fieldset {
        padding: 0px;
    }

    .tg-formtrip .form-group:nth-child(1),
    .tg-formtrip .form-group:nth-child(3),
    .tg-formtrip .form-group:nth-child(4) {
        width: 25%;
        padding-right: 5px;
    }

    .tg-formtrip .form-group:nth-child(2) {
        width: 6%;
    }

    .tg-formtrip .form-group:nth-child(5) {
        width: 19%;
    }

    .block-date-away {
        color: #333;
    }

    .block-date-away input.form-control {
        height: 50px;
    }

    .btn-change {
        height: 50px;
        width: 100%;
        padding: unset;
    }

    .tg-formtrip .tg-btn {
        position: unset;
        width: 100%;
    }

    @media (max-width: 991px) {
        .tg-formtrip .form-group:nth-child(1),
        .tg-formtrip .form-group:nth-child(3) {
            width: 45%;
        }

        .tg-formtrip .form-group:nth-child(2) {
            width: 10%;
        }

        .tg-formtrip .form-group:nth-child(4) {
            width: 55%;
        }

        .tg-formtrip .form-group:nth-child(5) {
            width: 45%;
        }
    }
</style>
