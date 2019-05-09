<template>
    <div>
        <baner-component></baner-component>
        <main id="tg-main" class="tg-main tg-sectionspace tg-haslayout">
            <div class="container">
                <div class="row">
                    <div id="tg-twocolumns" class="tg-twocolumns">
                        <form class="tg-formtheme tg-formdashboard">
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <aside id="tg-sidebar" class="tg-sidebar">
                                    <div class="tg-widget tg-widgetdashboard">
                                        <div class="tg-widgettitle">
                                            <h3>{{ $t('profile.my_account') }}</h3>
                                        </div>
                                        <div class="tg-widgetcontent">
                                            <ul>
                                                <li>
                                                    <router-link
                                                        tag="a"
                                                        :to="{ name: 'profile.index' }">
                                                        <i class="icon-user"></i><span>{{ $t('profile.dashboard') }}</span>
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link
                                                        tag="a"
                                                        :to="{ name: 'profile.edit' }">
                                                        <i class="icon-pen2"></i><span>{{ $t('profile.edit_profile') }}</span>
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link
                                                        tag="a"
                                                        :to="{ name: 'profile.change_password' }">
                                                        <i class="icon-lock-open3"></i><span>{{ $t('profile.change_password') }}</span>
                                                    </router-link>
                                                </li>
                                                <li><a href="my-booking.html"><i class="icon-basket3"></i><span>{{ $t('profile.my_booking') }}</span></a></li>
                                                <li><a href="#" @click.prevent="logout"><i class="icon-lock"></i><span>{{ $t('profile.logout') }}</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <router-view></router-view>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'

    import Banner from '@plugins/Banner.vue'

    export default {
        components: {
            banerComponent: Banner
        },
        methods: {
            ...mapActions('auth', ['logout'])
        }
    }
</script>

<style scoped>
    li .router-link-exact-active {
        color: #ff7550;
    }

    .tg-widgetcontent li a i {
        display: inline-block;
        height: 20px;
        width: 30px;
        text-align: center;
        line-height: 20px;
    }
</style>
