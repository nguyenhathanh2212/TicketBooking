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
        <popup-login-component></popup-login-component>
    </div>
</template>

<script>
    import Loader from './Loader.vue'
    import Header from './Header.vue'
    import HeaderMobile from './HeaderMobile.vue'
    import Footer from './Footer.vue'
    import PopupLogin from './PopupLogin.vue'
    import PopupSearch from './PopupSearch.vue'

    export default {
        components: {
            loaderComponent: Loader,
            headerComponent: Header,
            headerMobileComponent: HeaderMobile,
            footerComponent: Footer,
            popupSearchComponent: PopupSearch,
            popupLoginComponent: PopupLogin
        }
    }
</script>
