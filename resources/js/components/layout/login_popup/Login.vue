<template>
    <div role="tabpanel" class="tab-pane active fade in" id="login">
        <div v-if="messagesError" class="alert alert-danger" role="alert">
            {{ messagesError }}
        </div>
        <div v-if="messagesSuccess" class="alert alert-success" role="alert">
            {{ messagesSuccess }}
        </div>
        <form class="tg-formtheme tg-formlogin" @submit.prevent="handleLogin()">
            <fieldset>
                <div class="form-group">
                    <label>{{ $t('main.email') }} <sup>*</sup></label>
                    <span class="error">{{ errors.first('email') }}</span>
                    <input type="text"
                            v-validate="'required|email'"
                            name="email"
                            v-model="email"
                            :class="['form-control', { 'input-error': errors.first('email') }]"
                            placeholder="">
                </div>
                <div class="form-group">
                    <label>{{ $t('main.password') }} <sup>*</sup></label>
                    <span class="error">{{ errors.first('password') }}</span>
                    <input type="password"
                           name="password"
                           v-validate="{ required: true, max: 20, min: 6 }"
                           v-model="password"
                           :class="['form-control', { 'input-error': errors.first('password') }]"
                           placeholder="">
                </div>
                <div class="form-group">
                    <div class="tg-checkbox">
                    </div>
                    <span><a href="index.htm#">{{ $t('main.lost_password') }}</a></span>
                </div>
                <button class="tg-btn tg-btn-lg"><span>{{ $t('main.login') }}</span></button>
            </fieldset>
        </form>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'

    export default {
        data: function() {
            return {
                email: '',
                password: '',
                messagesError: '',
                messagesSuccess: ''
            }
        },
        methods: {
            ...mapActions('auth', [
                'login',
            ]),
            handleLogin: function () {
                this.$validator.validate().then(valid => {
                    if (valid) {
                        this.login({email: this.email, password: this.password})
                            .then(success => {
                                this.messagesError = '';
                                this.messagesSuccess = this.$t('message.login_success');
                            })
                            .catch(error => {
                                this.messagesSuccess = '';
                                this.messagesError = this.$t('message.login_error');
                            });
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .tg-formlogin input {
        text-transform: unset;
    }
</style>
