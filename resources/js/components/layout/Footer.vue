<template>
    <div>
        <footer id="tg-footer" class="tg-footer tg-haslayout">
            <div class="tg-fourcolumns">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <div class="tg-footercolumn tg-widget tg-widgettext">
                                <div class="tg-widgettitle">
                                    <h3>About Ticketbooking</h3>
                                </div>
                                <div class="tg-widgetcontent">
                                    <div class="tg-description">
                                        <p>Nunc cursus liero purs ac cogue arcu cursus ut sed vitae pulvinar massaidp nequetiam lore elerisque</p>
                                    </div>
                                    <span>(0511) 3767 679</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <div class="tg-footercolumn tg-widget tg-widgettravelunews">
                                <div class="tg-widgettitle">
                                    <h3>Ticketbooking</h3>
                                </div>
                                <div class="tg-widgetcontent">
                                    <ul>
                                        <template v-for="(company, index) in companies.data">
                                            <li v-if="index < 2" :key="index">
                                                <figure>
                                                    <img class="img-footer" :src="company.first_image" alt="image destinations">
                                                </figure>
                                                <div class="tg-newcontent">
                                                    <h4>
                                                        <router-link :to="{ name: 'company.show', params: { id: company.id }}">
                                                            {{ company.name }}
                                                        </router-link>
                                                    </h4>
                                                </div>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <div class="tg-footercolumn tg-widget tg-widgetdestinations">
                                <div class="tg-widgettitle">
                                    <h3>{{ $t('home.popular_provincial') }}</h3>
                                </div>
                                <div class="tg-widgetcontent">
                                    <ul>
                                        <template v-for="(provincial, index) in popularProvincials">
                                            <li :key="index" v-if="index < 4">
                                                <router-link
                                                    tag="a"
                                                    :to="{
                                                        name: 'company.index',
                                                        query: {
                                                            provincial: provincial.id
                                                        }
                                                    }">
                                                    {{ provincial.name }}
                                                </router-link>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <div class="tg-footercolumn tg-widget tg-widgetnewsletter">
                                <div class="tg-widgettitle">
                                    <h3>Newsletter</h3>
                                </div>
                                <div class="tg-widgetcontent">
                                    <div class="tg-description"><p>Sign up for our mailing list to get latest updates and offers</p></div>
                                    <form class="tg-formtheme tg-formnewsletter">
                                        <fieldset>
                                            <input type="email" name="email" class="form-control" placeholder="Your Email">
                                            <button type="submit"><img src="/images/icons/icon-08.png" alt="image destinations"></button>
                                        </fieldset>
                                    </form>
                                    <span>We respect your privacy</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tg-footerbar">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <p>Copyright &copy; 2017 Travlu. All  rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    export default {
        created() {
            this.setPopularProvincials();
            this.setCompanies({
                size: 4,
                page: 1
            });
        },
        computed: {
            ...mapState('provincial', ['popularProvincials']),
            ...mapState('company', ['companies'])
        },
        methods: {
            ...mapActions('provincial', ['setPopularProvincials']),
            ...mapActions('company', ['setCompanies'])
        }
    }
</script>

<style scoped>
    img.img-footer {
        width: 60px;
        height: 40px;
        object-fit: cover;
    }

    .tg-widgettravelunews .tg-widgetcontent ul li + li {
        padding-top: 8px;
    }
</style>

