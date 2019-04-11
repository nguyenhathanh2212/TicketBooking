<template>
    <div>
        <baner-component></baner-component>
        <main id="tg-main" class="tg-main tg-haslayout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div id="tg-content" class="tg-content">
                            <div class="tg-tourbookingdetail">
                                <overview-component></overview-component>
                                <div class="tg-sectionspace tg-haslayout">
                                    <detail-component
                                        :company="company"></detail-component>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex'
    import Banner from '@plugins/Banner.vue'
    import Overview from '@company/detail/Overview.vue'
    import Detail from '@company/detail/Detail.vue'

    export default {
        created() {
            this.setCompany(this.id);
        },
        computed: {
            ...mapState('company', [
                'company'
            ]),
            id() {
                return this.$route.params.id;
            }
        },
        components: {
            banerComponent: Banner,
            overviewComponent: Overview,
            detailComponent: Detail
        },
        methods: {
            ...mapActions('company', [
                'setCompany'
            ]),
        }
    }
</script>
