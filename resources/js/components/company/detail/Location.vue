<template>
    <div role="tabpanel" class="tab-pane tg-locationtab" id="italy">
        <div class="tg-box tg-location">
            <h3>{{ $t('company.address') }}</h3>
            <div class="tg-description">
                <p>{{ company.address }}</p>
            </div>
            <div id="tg-locationmap" class="tg-locationmap tg-map"><GmapMap
                :center="{lat: company.latitude, lng: company.longitude}"
                :zoom="7"
                map-type-id="roadmap"
                style="width: 100%; height: 100%">
                    <GmapMarker
                        :position="{lat: company.latitude, lng: company.longitude}"
                        :clickable="true"
                        :draggable="true"/>
                </GmapMap>
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
