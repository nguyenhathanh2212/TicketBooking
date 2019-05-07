<template>
    <div id="tg-content" class="tg-content">
        <div class="tg-dashboard">
            <div class="tg-box tg-profile">
                <div class="tg-heading">
                    <h3>{{ $t('profile.my_profile') }}</h3>
                    <router-link
                            tag="a"
                            class="tg-btnedit"
                            :to="{ name: 'profile.edit' }">
                        {{ $t('profile.edit_profile') }}
                    </router-link>
                </div>
                <div class="tg-dashboardcontent">
                    <figure><img :src="user.avatar" class="img-avatar" alt="image description"></figure>
                    <div class="tg-content">
                        <ul class="tg-liststyle">
                            <li><span>{{ $t('profile.name') }}:</span></li>
                            <li><span>{{ user.full_name }}</span></li>
                            <li><span>{{ $t('profile.email') }}:</span></li>
                            <li><span>{{ user.email }}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'

    export default {
        computed: {
            ...mapState('auth', ['authenticated', 'user'])
        }
    }
</script>

<style scoped>
    .img-avatar {
        width: 87px !important;
        height: 87px !important;
    }

    .tg-dashboardcontent .tg-liststyle li {
        min-height: 42px;
    }
</style>
