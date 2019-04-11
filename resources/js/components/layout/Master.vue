<template>
    <div>
        <loader-component></loader-component>
        <header-mobile-component></header-mobile-component>
        <div id="tg-wrapper" class="tg-wrapper tg-haslayout">
            <header-component></header-component>
            <router-view></router-view>
            <footer-component></footer-component>
        </div>
        <popup-search-component></popup-search-component>
        <popup-login-component :authenticated="authenticated"></popup-login-component>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import Loader from '@layout/Loader.vue'
    import Header from '@layout/Header.vue'
    import HeaderMobile from '@layout/HeaderMobile.vue'
    import Footer from '@layout/Footer.vue'
    import PopupLogin from '@layout/login_popup/Index.vue'
    import PopupSearch from '@layout/PopupSearch.vue'

    export default {
        components: {
            loaderComponent: Loader,
            headerComponent: Header,
            headerMobileComponent: HeaderMobile,
            footerComponent: Footer,
            popupSearchComponent: PopupSearch,
            popupLoginComponent: PopupLogin
        },
        computed: {
            ...mapState('auth', [
                'authenticated'
            ])
        },
        created() {
            this.checkAuthenticated();
        },
        methods: {
            ...mapActions('auth', [
                'checkAuthenticated',
            ])
        }
    }
</script>
