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
                                        <template v-for="(company, index) in companies.data" >
                                            <div :key="index" class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                                <div class="tg-trendingtrip">
                                                    <figure>
                                                        <router-link :to="{ name: 'company.show', params: { id: company.id }}">
                                                            <img :src="company.first_image">
                                                            <div class="tg-hover">
                                                                <rating-component
                                                                    :rating="company.rating"></rating-component>
                                                                <span class="tg-tourduration">
                                                                    <em>{{ company.routes_count }} {{ $t('company.route') }}</em></span>
                                                                <span class="tg-locationname"><i class="fa fa-phone" aria-hidden="true"></i> {{ company.phone }}</span>
                                                                <div class="tg-pricearea">
                                                                </div>
                                                            </div>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
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
                console.log(this.companies);
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
    .tg-tourduration:before {
        content: '\ea2a';
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

    .tg-description > p {
        display: block;
        display: -webkit-box;
        height: 46px;
        margin: 0 auto;
        line-height: 23px;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tg-trendingtrip figure img {
        width: 100%;
        display: block;
        object-fit: cover;
        height: 270px;
    }
</style>

