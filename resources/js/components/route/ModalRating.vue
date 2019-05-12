<template>
    <div style="text-align: left" class="modal fade modal-rating" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ $t('main.reviews') }}</h4>
                </div>
                <div class="modal-body">
                    <div class="tg-reviewsarea">
                        <form class="tg-formtheme tg-formreviews">
                            <!-- <fieldset class="tg-filterby">
                                <div class="tg-durationrating">
                                    <em>({{ company.ratings_count }} {{ $t('company.reviews') }})</em>
                                    <rating-component
                                        style="display: inline;"
                                        :rating="company.rating"></rating-component>
                                </div>
                                <span class="tg-select">
                                    <select>
                                        <option>Filter by</option>
                                        <option>Rating</option>
                                        <option>New</option>
                                        <option>date</option>
                                    </select>
                                </span>
                            </fieldset> -->
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
                                    </ul>
                                </nav>
                                <hr>
                            </div>
                            <div v-else>
                                <div class="alert alert-info" style="margin-top: 30px" role="alert">
                                    {{ $t('message.no_reviews_yet') }}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <fieldset v-if="authenticated"  class="tg-formleavereview">
                                <div class="tg-leavereviewhead">
                                    <h2>{{ $t('company.leave_your_comment') }}</h2>
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
                                                :star-size="20"
                                                name="rating"
                                                v-validate="'between:1,5'"></star-rating-component>
                                        <br>
                                        <span class="error">{{ errors.first('rating') }}</span>
                                    </div>
                                </div>
                                <div class="tg-reviewformarea">
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
                            <div v-else>
                                <div class="alert alert-warning" style="margin-top: 30px" role="alert">
                                    {{ $t('message.must_login_to_rate') }}
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import Rating from '@plugins/Rating.vue'
    import StarRating from 'vue-star-rating'

    export default {
        props: ['idBusRoute', 'statusModal'],
        data: function() {
            return {
                size: 3,
                page: 1,
                comment: '',
                rating: 0,
            }
        },
        components: {
            ratingComponent: Rating,
            starRatingComponent: StarRating
        },
        computed: {
            ...mapState('auth', ['authenticated']),
            ...mapState('bus_route', ['ratings']),
            checkChange: function () {
                return `${this.page}|${this.size}|${this.company_id}`;
            }
        },
        methods: {
            ...mapActions('bus_route', ['rate', 'setRatings']),
            submitRating: function () {
                this.$validator.validate().then(valid => {
                    if (valid) {
                        this.rate({
                            bus_route_id: this.idBusRoute,
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
                            });
                            this.comment = '';
                            this.rating = 0;
                            this.setRatings({
                                bus_route_id: this.idBusRoute,
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
            },
            formatDateTime: function(dateTime) {
                return moment(dateTime).format(this.$t('main.date_time_format'));
            },
        },
        watch: {
            statusModal: function() {
                if (this.idBusRoute) {
                    $('.modal-rating').modal('show');
                    if (this.idBusRoute) {
                        this.setRatings({
                            bus_route_id: this.idBusRoute,
                            data: {
                                size: this.size,
                                page: this.page
                            }
                        });
                    }
                }
            },
            checkChange: function () {
                if (this.idBusRoute) {
                    this.setRatings({
                        bus_route_id: this.idBusRoute,
                        data: {
                            size: this.size,
                            page: this.page
                        }
                    });
                }
            }
        }
    }
</script>

<style scoped>
    .tg-authorimg img {
        width: 50px;
        height: 50px;
        object-fit: cover;
    }

    .tg-authorinfo h3 {
        font-size: 12px;
        text-transform: unset;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        width: 140px;
    }

    .tg-authorinfo span {
        font-size: 10px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
        width: 140px;
    }

    .tg-reviewhead {
        padding-bottom: 0px;
    }

    .tg-review .tg-author {
        padding: 5px;
    }

    .tg-reviews ul li {
        padding: 10px 0;
    }

    .tg-formtheme .tg-formleavereview {
        padding: 20px 0 0;
    }

    .tg-reviewformarea .form-group textarea {
        height: 100px;
    }

    .tg-leavereviewhead h2 {
        font-size: 20px;
        margin: 0 0 10px;
    }

    .tg-leavereviewhead .tg-durationrating h3 {
        font-size: 14px;
        font-weight: 100;
        line-height: 14px;
        display: inline-block;
    }
    
    .tg-leavereviewhead {
        padding-bottom: 0px;
    }

    .tg-durationrating {
        width: 100%;
    }

    .vue-star-rating {
        display: inline-block !important;
    }

    @media (max-width: 1199px) {
        .tg-durationrating {
            width: 100%;
        }
    }

    .tg-reviewformarea .form-group {
        width: 100%;
    }

    .tg-pagination ul li a {
        width: 30px;
        height: 30px;
        line-height: 30px;
        font-size: 13px;
    }

    .tg-pagination {
        padding: 5px 0px;
        display: flex;
        justify-content: flex-end;
    }

    .modal-body {
        padding: 0px 25px;
    }
</style>
