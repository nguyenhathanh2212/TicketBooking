<template>
    <div>
        <div id="tg-header" class="tg-header tg-haslayout">
            <div class="container-fluid">
                <div class="row">
                    <top-header-component></top-header-component>
                    <div class="tg-navigationarea tg-headerfixed">
                        <strong class="tg-logo" style="line-height: 40px">
                            <router-link
                                    :to="{ name: 'home' }"
                                    tag="a">
                                <span class="strong-text-logo">Ticket </span><img class="logo" src="/images/logo.png">nline
                            </router-link>
                        </strong>
                        <div class="tg-socialsignin">
                            <div class="tg-userbox">
                                <a v-if="!authenticated" id="tg-btnsignin" class="tg-btn" href="#tg-loginsingup"><span>{{ $t('main.login') }}</span></a>
                                <div v-else class="dropdown tg-dropdown tg-drop-custom">
                                    <button class="tg-btndropdown" id="tg-dropdowndashboard" type="button" data-toggle="dropdown">
                                        <img :src="user.avatar" alt="image description">
                                        <span>{{ user.full_name }}</span>
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <ul class="dropdown-menu tg-dropdownusermenu" aria-labelledby="tg-dropdowndashboard">
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
                                        <li><a href="" @click.prevent="logout()" ><i class="icon-lock"></i>{{ $t('profile.logout') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <nav id="tg-nav" class="tg-nav">
                            <div class="navbar-header">
                                <a href="#menu" class="navbar-toggle collapsed">
                                    <span class="sr-only"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </a>
                            </div>
                            <div id="tg-navigation" class="collapse navbar-collapse tg-navigation">
                                <ul>
                                    <li>
                                        <router-link
                                                :to="{ name: 'home' }"
                                                tag="a">
                                            {{ $t('main.home') }}
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link
                                                :to="{ name: 'company.index' }"
                                                tag="a">
                                            {{ $t('main.companies') }}
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link
                                                :to="{ name: 'route.index' }"
                                                tag="a">
                                            {{ $t('main.routes') }}
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link
                                                :to="{ name: 'bus_station' }"
                                                tag="a">
                                            {{ $t('main.station') }}
                                        </router-link>
                                    </li>
                                    <li><a href="javascript:void(0);">pages</a></li>
                                    <li><a href="shop.html">shop</a></li>
                                    <li><a href="blog.html">blog</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import TopHeader from '@layout/TopHeader.vue'

    export default {
        components: {
            topHeaderComponent: TopHeader
        },
        computed: {
            ...mapState('auth', [
                'authenticated',
                'user'
            ])
        },
        methods: {
            ...mapActions('auth', [
                'logout'
            ])
        }
    }
</script>

<style scoped>
    .logo {
        width: 42px;
        height: 42px;
        display: inline-block;
    }

    .tg-logo {
        line-height: 42px;
    }

    .tg-logo a {
        color: #fddf00;
        font-weight: 100;
    }

    .strong-text-logo {
        font-size: 16px;
        color: #62d0fa;
        font-weight: 700;
    }

    .tg-dropdown {
        display: unset;
    }

    .tg-btndropdown span {
        text-transform: unset;
        width: calc(100% - 52px);
        margin-right: 10px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .tg-btndropdown img {
        width: 35px;
        height: 35px;
    }

    a.router-link-exact-active::before {
        height: 6px;
    }

    .tg-drop-custom {
        display: block !important;
    }

    @media (max-width: 990px) {
        #tg-dropdowndashboard {
            max-width: 200px;
        }
    }

    ul.dropdown-menu.tg-dropdownusermenu li a i {
        display: inline-block;
        height: 20px;
        width: 30px;
        text-align: center;
        line-height: 20px;
    }
</style>
