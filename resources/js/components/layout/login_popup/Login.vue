<template>
    <div role="tabpanel" class="tab-pane active fade in" id="login">
        <form class="tg-formtheme tg-formlogin" @submit.prevent="handleLogin()">
            <fieldset>
                <div class="form-group">
                    <label>{{ $t('main.email') }} <sup>*</sup></label>
                    <span class="error">{{ errors.first('email') }}</span>
                    <input type="text"
                            v-validate="'required|email'"
                            :data-vv-as="this.$t('main.email')"
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
                           :data-vv-as="this.$t('main.password')"
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
                password: ''
            }
        },
        methods: {
            ...mapActions('auth', [
                'login',
            ]),
            handleLogin: function () {
                this.$validator.validate().then(valid => {
                    if (valid) {
                        this.login({ email: this.email, password: this.password })
                            .then(success => {
                                Swal.fire({
                                    title: 'Success!',
                                    text: this.$t('message.login_success'),
                                    type: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.value) {
                                        this.$emit('closePopupLogin');
                                    }
                                });
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error!',
                                    text: this.$t('message.login_error'),
                                    type: 'error',
                                    confirmButtonText: 'Ok'
                                });
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
