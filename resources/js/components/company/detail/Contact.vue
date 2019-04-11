<template>
    <div role="tabpanel" class="tab-pane tg-itinerary" id="australia">
        <div class="tg-bookingdetail">
            <div class="tg-box">
                <div class="tg-accordion">
                    <div class="tg-panel">
                        <h4>{{ $t('company.address') }}</h4>
                        <div class="tg-panelcontent">
                            <div class="tg-description">
                                <p>{{ company.address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tg-bookingdetail">
            <div class="tg-box">
                <div class="tg-accordion">
                    <div class="tg-panel">
                        <h4>{{ $t('company.phone') }}</h4>
                        <div class="tg-panelcontent">
                            <div class="tg-description">
                                <p>{{ company.phone }}</p>
                            </div>
                        </div>
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
            ...mapState('company', [
                'company'
            ])
        }
    }
</script>
