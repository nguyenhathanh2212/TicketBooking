<template>
    <div class="tg-topbar">
        <nav class="tg-infonav">
            <ul>
                <li>
                    <i><img src="/images/icons/icon-01.png" alt="image destinations"></i>
                    <span>(0511) 3767 679</span>
                </li>
                <li>
                    <i><img src="/images/icons/icon-02.png" alt="image destinations"></i>
                    <span>Tôn Đức Thắng, Hoà Minh, Liên Chiểu, <a href="javascript:void(0);"> Đà Nẵng</a></span>
                </li>
            </ul>
        </nav>
        <div class="tg-addnavcartsearch">
            <nav class="tg-addnav">
                <ul>
                    <!-- <li><a href="aboutus.html">about</a></li>
                    <li><a href="contactus.html">contact</a></li> -->
                </ul>
            </nav>             
            <div class="dropdown dropdown-change-language">
                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">VN
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="#">VN</a></li>
                    <li><a href="#">EN</a></li>
                </ul>
            </div>
            <nav class="tg-cartsearch">
                <ul>
                    <li><a href="#tg-search"><img src="/images/icons/icon-04.png" alt="image destinations"></a></li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
        
    }
</script>

<style scoped>
    .dropdown-change-language {
        display: inline-block;
        height: 40px;
        line-height: 40px;
    }

    .dropdown-change-language ul.dropdown-menu {
        z-index: 1001;
        right: 0px;
        left: unset;
        top: 38px;
        background: #fff;
        padding: 0px;
        border-radius: unset;
        min-width: 100px
    }

    .dropdown-change-language ul.dropdown-menu li {
        line-height: 0px;
        list-style-type: none;
        padding: 2px 0px;
    }

    .dropdown-change-language ul.dropdown-menu li {
        color: #bcbcbc;
    }

    .dropdown-change-language .btn.btn-default.dropdown-toggle {
        color: #909090;
        background-color: #000;
        border-color: #414150;
        border-top: unset;
        border-bottom: unset;
        height: 40px;
    }
</style>
