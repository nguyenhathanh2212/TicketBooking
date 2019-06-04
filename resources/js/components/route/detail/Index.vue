<template>
    <div>
        <baner-component></baner-component>
        <main id="tg-main" class="tg-main tg-haslayout">
            <div class="container component-booking">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="tg-content" class="tg-content">
                            <div class="tg-tourbookingdetail">
                                <infor-component></infor-component>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import { mapActions } from 'vuex'
    import Banner from '@plugins/Banner.vue'
    import Infor from '@route/detail/Infor.vue'
    

    export default {
        created() {
            this.setBusRoute(this.$route.params.id)
                .catch(error => {
                    this.$router.push({
                        name: '404'
                    })
                });
        },
        components: {
            banerComponent: Banner,
            inforComponent: Infor
        },
        methods: {
            ...mapActions('bus_route', ['setBusRoute'])
        },
        watch: {
            '$route' (to, from) {
                this.setBusRoute(this.$route.params.id);
            },
        }
    }
</script>

<style scoped>
    .component-booking {
        max-width: 1300px;
    }
</style>
