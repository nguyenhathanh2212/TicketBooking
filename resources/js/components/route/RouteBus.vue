<template>
    <div>
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
            :params="{
                size: size,
                page: page
            }"
            :routeName="'route.index'"></paginate-component>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import Paginate from '@plugins/Paginate.vue'
    import Item from '@route/Item.vue'
    import DatePicker from 'vue-bootstrap-datetimepicker'

    export default {
        data: function() {
            return {
                value1: ''
            }
        },
        computed: {
            ...mapState('bus_route', [
                'busRoutes'
            ]),
            size: function() {
                return this.$route.params.size ? this.$route.params.size : 9;
            },
            page: function() {
                return this.$route.params.size ? this.$route.params.page : 1;
            },
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
