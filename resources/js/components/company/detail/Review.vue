<template>
    <div role="tabpanel" class="tab-pane tg-reviewtab" id="london">
        <div class="tg-reviewsarea">
            <form class="tg-formtheme tg-formreviews">
                <fieldset class="tg-filterby">
                    <div class="tg-durationrating">
                        <em>({{ company.ratings_count }} {{ $t('company.reviews') }})</em>
                        <rating-component
                            style="display: inline;"
                            :rating="company.rating"></rating-component>
                    </div>
                    <div class="message-require-login">
                        <template v-if="authenticated">
                            <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target=".bd-rating-modal-lg">{{ $t('company.leave_your_comment') }}</button>
                            <div class="modal fade bd-rating-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">{{ $t('company.leave_your_comment') }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <fieldset class="tg-formleavereview">
                                            <div class="tg-leavereviewhead">
                                                <div class="tg-durationrating">
                                                    <h3>{{ $t('company.your_rating') }}</h3>
                                                    <star-rating-component
                                                            v-model="rating"
                                                            :border-width="4"
                                                            border-color="#ffa127"
                                                            :data-vv-as="this.$t('company.your_rating')"
                                                            :rounded-corners="true"
                                                            :star-points="[23,2, 14,17, 0,19, 10,34, 7,50, 23,43, 38,50, 36,34, 46,19, 31,17]"
                                                            :show-rating="false"
                                                            :star-size="30"
                                                            name="rating"
                                                            v-validate="'between:1,5'"></star-rating-component>
                                                    <br>
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
                                                            :data-vv-as="this.$t('company.your_comment')"
                                                            :class="{ 'input-error': errors.first('comment') }"
                                                            :placeholder="this.$t('company.your_comment')"></textarea>
                                                    <span class="error">{{ errors.first('comment') }}</span>
                                                </div>
                                                <div class="form-group">
                                                    <a class="tg-btn" href="" @click.prevent="submitRating()"><span>{{ $t('company.review') }}</span></a>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <span v-else class="alert alert-danger" style="margin-top: 30px" role="alert">
                            {{ $t('message.must_login_to_rate') }}
                        </span>
                    </div>
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
                            <template v-for="pageIndex in ratings.last_page">
                                <li v-if="pageIndex == ratings.current_page" :key="pageIndex" class="tg-active">
                                    <a href="#" @click.prevent="page = pageIndex">{{ pageIndex }}</a>
                                </li>
                                <li :key="pageIndex" v-else-if="pageIndex == ratings.current_page + 1 || pageIndex == ratings.current_page - 1 || pageIndex == 1 || pageIndex == ratings.last_page">
                                    <a href="#" @click.prevent="page = pageIndex">{{ pageIndex }}</a>
                                </li>
                                <li :key="pageIndex" v-else-if="pageIndex == ratings.last_page - 1 || pageIndex == 2">
                                    <span><i class="fa fa-ellipsis-h"></i></span>
                                </li>
                            </template>
                            <li class="tg-nextpage" v-if="page < ratings.last_page">
                                <a href="#" @click.prevent="page++"><i class="fa fa-angle-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div v-else>
                    <div class="clearfix"></div>
                    <div class="alert alert-info" style="margin-top: 30px" role="alert">
                        {{ $t('message.no_reviews_yet') }}
                    </div>
                </div>
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
            starRatingComponent: StarRating
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
                             Swal.fire({
                                title: 'Success!',
                                text: this.$t('message.rating_record'),
                                type: 'success',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.value) {
                                    $('.bd-rating-modal-lg').modal('hide');
                                }
                            });
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
                            Swal.fire({
                                title: 'Error!',
                                text: this.$t('message.error_message'),
                                type: 'error',
                                confirmButtonText: 'Ok'
                            });
                        })
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .tg-leavereviewhead .tg-durationrating h3 {
        display: inline-block;
    }

    .vue-star-rating {
        display: inline-block !important;
    }

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

    .tg-authorinfo span {
        width: 110px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .tg-durationrating span.tg-stars {
        width: 92px;
    }

    .message-require-login span.alert {
        margin-bottom: 0px !important;
        margin-top: 0px !important;
        padding: 1px 8px;
        display: inline-block;
        background: #fff;
        border: unset;
    }

    .message-require-login {
        height: 39px;
        display: inline-block;
        line-height: 39px;
    }

    .tg-formtheme .tg-formleavereview {
        padding: 0px;
    }
</style>
