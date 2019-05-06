<template>
    <div role="tabpanel" class="tab-pane tg-reviewtab" id="london">
        <div class="tg-reviewsarea">
            <form class="tg-formtheme tg-formreviews">
                <fieldset class="tg-filterby">
                    <div class="tg-durationrating">
                        <em>({{ company.number_of_review }} {{ $t('company.reviews') }})</em>
                        <rating-component
                            style="display: inline;"
                            :rating="company.rating"></rating-component>
                    </div>
                    <!-- <span class="tg-select">
                        <select>
                            <option>Filter by</option>
                            <option>Rating</option>
                            <option>New</option>
                            <option>date</option>
                        </select>
                    </span> -->
                </fieldset>
                <div v-if="ratings.total">
                    <fieldset class="tg-reviews">
                        <ul>
                            <li v-for="(rating, index) in ratings.data" :key="index">
                                <div class="tg-review">
                                    <div class="tg-author">
                                        <figure class="tg-authorimg">
                                            <img :src="rating.user.avatar">
                                        </figure>
                                        <div class="tg-authorinfo">
                                            <h3>{{ rating.user.email }}</h3>
                                            <span>{{ rating.user.full_name }}</span>
                                            <rating-component
                                                :rating="rating.rating"></rating-component>
                                        </div>
                                    </div>
                                    <div class="tg-reviewcontent">
                                        <div class="tg-reviewhead">
                                            <span class="tg-tourduration">{{ formatDateTime(rating.created_at) }}</span>
                                        </div>
                                        <div class="tg-description">
                                            <p>{{ rating.comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </fieldset>
                    <nav v-if="ratings.last_page > 1" class="tg-pagination">
                        <ul>
                            <li class="tg-prevpage" v-if="page > 1">
                                <a href="#" @click.prevent="page--"><i class="fa fa-angle-left"></i></a>
                            </li>
                            <li v-for="pageIndex in ratings.last_page" :key="pageIndex" :class="pageIndex == ratings.current_page ? 'tg-active' : ''">
                                <a href="#" @click.prevent="page = pageIndex">{{ pageIndex }}</a>
                            </li>
                            <li class="tg-nextpage" v-if="page < ratings.last_page">
                                <a href="#" @click.prevent="page++"><i class="fa fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div v-else>
                    <div class="alert alert-info" style="margin-top: 30px" role="alert">
                        {{ $t('message.no_data_found') }}
                    </div>
                </div>
                <fieldset v-if="authenticated"  class="tg-formleavereview">
                    <div class="tg-leavereviewhead">
                        <h2>{{ $t('company.leave_your_comment') }}</h2>
                        <div class="tg-durationrating">
                            <h3>{{ $t('company.your_rating') }}</h3>
                            <start-rating-component
                                    v-model="rating"
                                    :border-width="4"
                                    border-color="#ffa127"
                                    :rounded-corners="true"
                                    :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]"
                                    :show-rating="false"
                                    :star-size="30"
                                    name="rating"
                                    v-validate="'between:1,5'"></start-rating-component>
                            <span class="error">{{ errors.first('rating') }}</span>
                        </div>
                    </div>
                    <div class="tg-reviewformarea">
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                            <textarea v-model="comment"
                                      name="comment"
                                      v-validate="'required'"
                                      :class="{ 'input-error': errors.first('comment') }"
                                      :placeholder="this.$t('company.your_comment')"></textarea>
                            <span class="error">{{ errors.first('comment') }}</span>
                        </div>
                        <div class="form-group">
                            <a class="tg-btn" href="" @click.prevent="submitRating()"><span>{{ $t('company.review') }}</span></a>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import Rating from '@plugins/Rating.vue'
    import Paginate from '@plugins/Paginate.vue'
    import StarRating from 'vue-star-rating'

    export default {
        components: {
            ratingComponent: Rating,
            paginateComponent: Paginate,
            startRatingComponent: StarRating
        },
        data: function() {
            return {
                size: 5,
                page: 1,
                comment: '',
                rating: 0,
                company_id: this.$route.params.id,
            }
        },
        created() {
            this.setRatings({
                company_id: this.company_id,
                data: {
                    size: this.size,
                    page: this.page
                }
            });
        },
        watch: {
            checkChange: function () {
                this.setRatings({
                    company_id: this.company_id,
                    data: {
                        size: this.size,
                        page: this.page
                    }
                });
            }
        },
        computed: {
            ...mapState('company', ['company', 'ratings']),
            ...mapState('auth', ['authenticated']),
            checkChange: function () {
                return `${this.page}|${this.size}|${this.company_id}`;
            }
        },
        methods: {
            ...mapActions('company', [
                'setRatings',
                'rate'
            ]),
            formatDateTime: function(dateTime) {
                return moment(dateTime).format(this.$t('main.date_time_format'));
            },
            submitRating: function () {
                this.$validator.validate().then(valid => {
                    if (valid) {
                        this.rate({
                            company_id: this.$route.params.id,
                            data: {
                                comment: this.comment,
                                rating: this.rating,
                            }
                        }).then(success => {
                            this.comment = '';
                            this.rating = 0;
                            this.setRatings({
                                company_id: this.$route.params.id,
                                data: {
                                    size: this.size,
                                    page: this.page
                                }
                            });
                            this.$validator.reset();
                        }).catch(error => {

                        })
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .tg-pagination {
        display: flex;
        justify-content: flex-end;
        float: unset;
        padding-top: 20px; 
    }

    .tg-reviewhead {
        padding-bottom: 0px;
    }

    .tg-authorimg img {
        width: 75px;
        height: 75px;
    }

    .tg-authorinfo h3 {
        width: 110px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
</style>
