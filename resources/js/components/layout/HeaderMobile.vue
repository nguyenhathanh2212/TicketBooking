<template>
    <div>
        <nav id="menu">
            <ul>
                <li>
                    <router-link
                            :to="{ name: 'home' }"
                            tag="a">
                        {{ $t('main.home') }}
                    </router-link>
                </li>
                <li>
                    <router-link
                            :to="{ name: 'company.index' }"
                            tag="a">
                        {{ $t('main.companies') }}
                    </router-link>
                </li>
                <li>
                    <router-link
                            :to="{ name: 'route.index' }"
                            tag="a">
                        {{ $t('main.routes') }}
                    </router-link>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {

    }
</script>

<style scoped>

</style>
