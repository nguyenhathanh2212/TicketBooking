<template>
    <div id="tg-content" class="tg-content">
        <div class="tg-dashboard">
            <div class="tg-box tg-ediprofile">
                <div class="tg-heading">
                    <h3>{{ $t('profile.edit_profile') }}</h3>
                </div>
                <div class="tg-dashboardcontent">
                    <div class="tg-imgholder">
                        <figure>
                            <figure>
                                <img :src="avatar" class="img-avatar" id="show-avatar" alt="image description">
                            </figure>
                        </figure>
                        <a class="tg-btn btn-change-avatar"
                            @click.prevent="openPopupChangeAvatar"
                            href="#">Change Avatar</a>
                        <input class="file-image-input"
                            @change="getFileAvatar"
                            type="file" name="avatar"
                            accept="image/x-png,image/gif,image/jpeg" />
                    </div>
                    <div class="tg-content">
                        <fieldset>
                            <div class="form-group">
                                <label>{{ $t('profile.first_name') }}</label>
                                <input type="text" name="first_name" v-model="firstName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{{ $t('profile.last_name') }}</label>
                                <input type="text" name="last_name" v-model="lastName" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{{ $t('profile.email') }} <sup>*</sup></label>
                                <input type="email" disabled name="email" v-model="email" class="form-control">
                            </div>
                            <button class="tg-btn" @click="updateProfile"><span>{{ $t('profile.update') }}</span></button>
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
                firstName: '',
                lastName: '',
                email: '',
                avatar: '',
                file: '',
            }
        },
        computed: {
            ...mapState('auth', ['user'])
        },
        mounted() {
            this.firstName = this.user.first_name;
            this.lastName = this.user.last_name;
            this.email = this.user.email;
            this.avatar = this.user.avatar;
        },
        methods: {
            ...mapActions('auth', ['update']),
            updateProfile: function () {
                this.update({
                    first_name: this.firstName,
                    last_name: this.lastName,
                    avatar: this.file.toString('base64'),
                })
                .then(success => {
                    Swal.fire({
                        title: 'Success!',
                        text: this.$t('message.update_profile_success'),
                        type: 'success',
                        confirmButtonText: 'Ok'
                    })
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error!',
                        text: this.$t('message.error_message'),
                        type: 'error',
                        confirmButtonText: 'Ok'
                    })
                });
            },
            openPopupChangeAvatar: function () {
                $('.file-image-input').click();
            },
            getFileAvatar: function(e) {
                this.file = e.target.files[0];
                this.avatar = window.URL.createObjectURL(e.target.files[0]);
            }
        }
    }
</script>

<style scoped>
    .img-avatar {
        width: 87px !important;
        height: 87px !important;
    }

    .file-image-input {
        display: none;
    }
</style>
