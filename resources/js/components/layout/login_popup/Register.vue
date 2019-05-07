<template>
    <div role="tabpanel" class="tab-pane fade" id="register">
        <form class="tg-formtheme tg-formlogin" @submit.prevent="handleRegister()">
            <fieldset>
                <div class="form-group">
                    <label>{{ $t('main.email') }} <sup>*</sup></label>
                    <span class="error">{{ errors.first('email') }}</span>
                    <input type="text"
                           v-validate="'required|email'"
                           name="email"
                           v-model="email"
                           :class="['form-control', { 'input-error': errors.first('email') }]"
                           :data-vv-as="this.$t('main.email')"
                           placeholder="">
                </div>
                <div class="form-group">
                    <label>{{ $t('main.password') }} <sup>*</sup></label>
                    <span class="error">{{ errors.first('password') }}</span>
                    <input type="password"
                           name="password"
                           v-model="password"
                           :class="['form-control', { 'input-error': errors.first('password') }]"
                           :data-vv-as="this.$t('main.password')"
                           v-validate="{ required: true, max: 20, min: 6 }"
                           placeholder=""
                           ref="1">
                </div>
                <div class="form-group">
                    <label>{{ $t('main.confirm_password') }} <sup>*</sup></label>
                    <span class="error">{{ errors.first('confirm_password') }}</span>
                    <input type="password"
                           name="confirm_password"
                           v-model="confirm_password"
                           :class="['form-control', { 'input-error': errors.first('password') }]"
                           :data-vv-as="this.$t('main.confirm_password')"
                           v-validate="{ required: true, confirmed: 1 }"
                           class="form-control"
                           placeholder="">
                </div>
                <button class="tg-btn tg-btn-lg"><span>{{ $t('main.register') }}</span></button>
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
                confirm_password: ''
            }
        },
        methods: {
            ...mapActions('auth', [
                'register'
            ]),
            handleRegister: function() {
                this.$validator.validate().then(valid => {
                    if (valid) {
                        this.register({ email: this.email, password: this.password, confirm_password: this.confirm_password })
                            .then(success => {
                                Swal.fire({
                                    title: 'Success!',
                                    text: this.$t('message.register_success'),
                                    type: 'success',
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.value) {
                                        this.$emit('closePopupRegister');
                                    }
                                });
                            })
                            .catch(error => {
                                Swal.fire({
                                    title: 'Error!',
                                    text: this.$t('message.register_error'),
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
