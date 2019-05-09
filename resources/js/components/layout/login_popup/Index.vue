<template>
    <div id="tg-loginsingup" class="tg-loginsingup" data-vide-bg="poster: images/singup-img.jpg" data-vide-options="position: 0% 50%">
        <div class="tg-contentarea tg-themescrollbar">
            <div class="tg-scrollbar">
                <button type="button" class="close">x</button>
                <div class="tg-logincontent">
                    <nav id="tg-loginnav" class="tg-loginnav">
                    </nav>
                    <div class="tg-themetabs">
                        <ul class="tg-navtbs" role="tablist">
                            <li role="presentation" class="active"><a href="#login" data-toggle="tab">{{ $t('main.login') }}</a></li>
                            <li role="presentation"><a href="#register" data-toggle="tab">{{ $t('main.register') }}</a></li>
                        </ul>
                        <div class="tg-tabcontent tab-content">
                            <login-component @closePopupLogin="closePupup"></login-component>
                            <register-component @closePopupRegister="closePupup"></register-component>
                        </div>
                    </div>
                    <div class="tg-shareor"><span>{{ $t('main.or') }}</span></div>
                    <div class="tg-signupwith">
                        <h2>{{ $t('main.login_with') }}</h2>
                        <ul class="tg-sharesocialicon">
                            <li class="tg-facebook"><a href="" @click.prevent="loginSocialAccount('facebook')"><i class="icon-facebook-1"></i><span>Facebook</span></a></li>
                            <li class="tg-googleplus"><a href="" @click.prevent="loginSocialAccount('google')"><i class="icon-google4"></i><span>Google+</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    import Login from './Login.vue'
    import Register from './Register.vue'

    export default {
        props: ['authenticated'],
        components: {
            loginComponent: Login,
            registerComponent: Register
        },
        methods: {
            ...mapActions('auth', ['loginSocial']),
            closePupup: function () {
                if (this.authenticated) {
                    jQuery('#tg-loginsingup').removeClass('open');
                    jQuery('body').removeClass('tg-hidescroll');
                }
            },
            loginSocialAccount: function (provider) {
                const hello = this.hello;
                hello(provider).login({
                    scope: 'email',
                    force: true
                }).then(() => {
                    const authRes = hello(provider).getAuthResponse();
                    console.log(authRes);
                    this.loginSocial({
                        access_token : authRes.access_token,
                        provider: provider
                    }).then(success => {
                        this.closePupup();
                    })
                    .catch(error => {});
                })

            }
        }
    }
</script>
