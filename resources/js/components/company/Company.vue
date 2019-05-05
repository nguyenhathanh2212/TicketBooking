<template>
    <div>
        <banner-component></banner-component>
        <main id="tg-main" class="tg-main tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="tg-content" class="tg-content">
                            <div class="tg-listing tg-listingvone">
                                <div class="tg-sectiontitle">
                                    <h2>{{ $t('company.list_company') }}</h2>
                                </div>
                                <div class="clearfix"></div>
                                <div v-if="companies.total">
                                    <div class="row">
                                        <div v-for="(company, index) in companies.data" :key="index" class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                            <div class="tg-populartour">
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
                                                            <em>({{ company.number_of_review }} Review)</em>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <paginate-component
                                        :data="companies"
                                        :routeName="'company.index'"></paginate-component>
                                </div>
                                <div v-else>
                                    <div class="alert alert-info" style="margin-top: 30px" role="alert">
                                        {{ $t('message.no_data_found') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import Banner from '@plugins/Banner.vue'
    import Rating from '@plugins/Rating.vue'
    import Paginate from '@plugins/Paginate.vue'

    export default {
        created() {
            this.setCompanies(this.query);
        },
        components: {
            bannerComponent: Banner,
            ratingComponent: Rating,
            paginateComponent: Paginate
        },
        watch: {
            query: function() {
                this.setCompanies(this.query);
            }
        },
        computed: {
            ...mapState('company', [
                'companies'
            ]),
            query: function() {
                return this.$route.query;
            }
        },
        methods: {
        ...mapActions('company', [
                'setCompanies'
            ]),
        }
    }
</script>

<style scoped>
  .tg-populartourcontent .tg-description {
    height: 140px;
    overflow-y: scroll;
  }

  .tg-populartourcontent .tg-description::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(255, 255, 255, 0.3);
    background-color: #e8e8e8;
  }

  .tg-populartourcontent .tg-description::-webkit-scrollbar {
    width: 2px;
    background-color: #F5F5F5;
  }

  .tg-populartourcontent .tg-description::-webkit-scrollbar-thumb {
    background-color: #5084b1;
    border-radius: 10px;
  }
</style>

