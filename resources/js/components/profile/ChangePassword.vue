<template>
    <div id="tg-content" class="tg-content">
        <div class="tg-dashboard">
            <div class="tg-box tg-changepassword">
                <div class="tg-heading">
                    <h3>{{ $t('profile.change_password') }}</h3>
                </div>
                <div class="tg-dashboardcontent">
                    <div class="tg-content">
                        <fieldset>
                            <div class="form-group">
                                <label>{{ $t('profile.old_password') }}<sup v-if="!!this.user.password">*</sup></label>
                                <input type="password"
                                       name="old_password"
                                       v-model="oldPassword"
                                       :class="['form-control', { 'input-error': errors.first('old_password') }]"
                                       placeholder=""
                                       :data-vv-as="this.$t('profile.old_password')"
                                       v-validate="{
                                           required: !!this.user.password,
                                           max: 20,
                                           min: 6
                                       }">
                                <small class="form-text text-muted error"
                                       :title="errors.first('old_password')">{{ message.password ? message.old_password : errors.first('old_password') }}</small>
                            </div>
                            <div class="form-group">
                                <label>{{ $t('profile.new_password') }}<sup>*</sup></label>
                                <input type="password"
                                       name="new_password"
                                       v-model="password"
                                       :class="['form-control', { 'input-error': errors.first('new_password') }]"
                                       placeholder=""
                                       :data-vv-as="this.$t('profile.new_password')"
                                       v-validate="{
                                           required: true,
                                           max: 20,
                                           min: 6
                                       }"
                                       ref="1">
                                <small class="form-text text-muted error"
                                       :title="errors.first('new_password')">{{ message.password ? message.password : errors.first('new_password') }}</small>
                            </div>
                            <div class="form-group">
                                <label>{{ $t('profile.confirm_password') }}<sup>*</sup></label>
                                <input type="password"
                                       name="confirm_password"
                                       v-model="confirmPassword"
                                       :class="['form-control', { 'input-error': errors.first('confirm_password') }]"
                                       placeholder=""
                                       :data-vv-as="this.$t('profile.confirm_password')"
                                       v-validate="{
                                           required: true,
                                           max: 20,
                                           min: 6,
                                           confirmed: 1
                                       }">
                                <small class="form-text text-muted error"
                                       :title="errors.first('confirm_password')">{{ message.oldPassword ? message.oldPassword : errors.first('confirm_password') }}</small>
                            </div>
                            <button class="tg-btn" @click="updatePassword"><span>{{ $t('profile.update') }}</span></button>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'

    export default {
        data: function () {
            return {
                oldPassword: '',
                password: '',
                confirmPassword: '',
                message: {
                    oldPassword: '',
                    password: '',
                    confirmPassword: ''
                }
            }
        },
        computed: {
            ...mapState('auth', ['user'])
        },
        methods: {
            ...mapActions('auth', ['update']),
            updatePassword: function () {
                this.$validator.validate().then(valid => {
                    if (valid) {
                        this.update({
                            is_change_password: true,
                            password: this.password,
                            old_password: this.oldPassword,
                            confirm_password: this.confirmPassword
                        }).
                        then(success => {
                            this.oldPassword = '';
                            this.password = '';
                            this.confirmPassword = '';
                            this.$validator.reset();
                            this.message = {
                                oldPassword: '',
                                password: '',
                                confirmPassword: ''
                            }
                            Swal.fire({
                                title: 'Success!',
                                text: this.$t('message.update_password_success'),
                                type: 'success',
                                confirmButtonText: 'Ok'
                            })
                        })
                        .catch(error => {
                            var serverErrors = error.response.data.errors;
                            this.message = {
                                oldPassword: serverErrors.old_password ? serverErrors.old_password[0] : '',
                                password: serverErrors.password ? serverErrors.password[0] : '',
                                confirmPassword: serverErrors.confirm_password ? serverErrors.confirm_password[0] : ''
                            }
                            Swal.fire({
                                title: 'Error!',
                                text: this.$t('message.error_message'),
                                type: 'error',
                                confirmButtonText: 'Ok'
                            })
                        });
                    }
                });
            }
        }
    }
</script>

<style scoped>
    small.form-text.text-muted {
        display: block;
        height: 25px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>