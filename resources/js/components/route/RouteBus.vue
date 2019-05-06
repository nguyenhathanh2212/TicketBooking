<template>
    <div>
        <div v-if="busRoutes.total">
            <div>
                <ul class="list-group list-group-flush">
                    <item-component
                        v-for="(busRoute, index) in busRoutes.data"
                        :key="index"
                        :busRoute="busRoute"></item-component>
                </ul>
            </div>
            <div class="clearfix"></div>
            <paginate-component
                :data="busRoutes"
                :routeName="'route.index'"></paginate-component>
        </div>
        <div v-else>
            <div class="alert alert-info" style="margin-top: 30px" role="alert">
                {{ $t('message.no_data_found') }}
            </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import Paginate from '@plugins/Paginate.vue'
    import Item from '@route/Item.vue'
    import DatePicker from 'vue-bootstrap-datetimepicker'

    export default {
        computed: {
            ...mapState('bus_route', [
                'busRoutes'
            ])
        },
        components: {
            paginateComponent: Paginate,
            itemComponent: Item,
            datePicker: DatePicker
        }
    }
</script>

<style scoped>
    nav.tg-pagination {
        text-align: center;
        padding: 70px 0 0;
        display: flex;
        justify-content: center;
    }
</style>
