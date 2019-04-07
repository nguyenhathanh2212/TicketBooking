<template>
    <div>
        <div class="tg-bookinginfo">
            <div class="top-detail">
                <div class="company-slider-wrapper col-md-4">
                    <div class="images-company-slider owl-carousel owl-theme">
                        <div class="item-slider">
                            <img src="http://res.cloudinary.com/thdoan/image/upload/v1498133706/carousel/watch01.jpg">
                        </div>
                        <div class="item-slider">
                            <img src="http://res.cloudinary.com/thdoan/image/upload/v1498133706/carousel/watch01.jpg">
                        </div>
                        <div class="item-slider">
                            <img src="http://res.cloudinary.com/thdoan/image/upload/v1498133706/carousel/watch01.jpg">
                        </div>
                        <div class="item-slider">
                            <img src="http://res.cloudinary.com/thdoan/image/upload/v1498133706/carousel/watch01.jpg">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h2>Switzerland – 5 Days Mountain Hiking Tour</h2>
                    <div class="tg-durationrating">
                        <span class="tg-stars"><span></span></span>
                        <em>(3 Review)</em>
                    </div>
                    <div class="tg-pricearea">
                        <span>From</span>
                        <del>$2,800</del>
                        <h4>$2,500<sub>/ per person</sub></h4>
                    </div>
                    <div class="tg-description">
                        <p>There’s only 5 spot left. Join 19 others at Travelu’s experience this Saturday.</p>
                    </div>
                </div>
            </div>
            <hr>
            <form class="tg-formtheme tg-formbookingdetail">
                <fieldset>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="tg-formicon"><i class="icon-user-check"></i></div>
                            <span class="tg-select">
                                <select class="selectpicker" data-live-search="true" data-width="100%">
                                    <option data-tokens="Number of Rooms">Number of Rooms</option>
                                    <option data-tokens="2">2</option>
                                    <option data-tokens="4">4</option>
                                    <option data-tokens="5">5</option>
                                    <option data-tokens="6">6</option>
                                    <option data-tokens="10">10</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="tg-formicon"><i class="icon-user-check"></i></div>
                            <span class="tg-select">
                                <select class="selectpicker" data-live-search="true" data-width="100%">
                                    <option data-tokens="Number of Rooms">Number of Rooms</option>
                                    <option data-tokens="2">2</option>
                                    <option data-tokens="4">4</option>
                                    <option data-tokens="5">5</option>
                                    <option data-tokens="6">6</option>
                                    <option data-tokens="10">10</option>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <div class="tg-formicon"><i class="icon-users"></i></div>
                            <span class="tg-select choose-date">
                                <input type="text">
                            </span>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-6 col-xs-12 btn-search-block">
                        <div class="form-group">
                            <button type="submit" class="tg-btn tg-btn-lg"><span>proceed boking</span></button>
                        </div>
                    </div>
                </fieldset>
            </form>
            <ul class="tg-tripinfo">
                <li><span class="tg-tourduration">12 Days 11 Nights</span></li>
                <li><span class="tg-tourduration tg-availabilty">Availability May 12</span></li>
                <li><span class="tg-tourduration tg-location">San Francisco</span></li>
                <li><span class="tg-tourduration tg-peoples">24 People in Group</span></li>
            </ul>
            <div class="tg-refundshare">
                <div class="tg-refund">
                    <figure><img src="images/img-03.jpg" alt="image description"></figure>
                    <div class="tg-refundinfo">
                        <h3>100% refundable</h3>
                        <div class="tg-description">
                            <p>Cancel up to 12 days before your trip and get a full refund, including service fees.</p>
                        </div>
                    </div>
                </div>
                <ul class="tg-likeshare">
                    <li class="tg-shareicon">
                        <a href="javascript:void(0);"><i class="icon-share-button-outline"></i>share</a>
                        <ul class="tg-share">
                            <li><a href="javascript:void(0);"><i class="icon-twitter"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="icon-facebook"></i></a></li>
                            <li><a href="javascript:void(0);"><i class="icon-pinterest"></i></a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);"><i class="icon-heart"></i>save to wish list</a></li>
                    <li><a href="javascript:void(0);"><i class="icon-eye"></i>3520</a></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        $('.images-company-slider').owlCarousel({
            items: 1,
            loop: true,
            margin: 2,
            nav: false
        });
    }
}
</script>

<style scoped>
    .images-company-slider {
        margin: 4px;
    }

    .images-company-slider .item-slider {
        display: flex;
        justify-content: center;
        justify-items: center;
    }

    .images-company-slider .item-slider img {
        height: 250px;
        width: auto;
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

    @media (max-width: 1199px) {
        .tg-formbookingdetail fieldset {
            padding: 10;
        }
    }
</style>

