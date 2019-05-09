<template>
    <nav v-if="data.last_page > 1" class="tg-pagination">
        <ul>
            <li class="tg-prevpage" v-if="page > 1">
                <router-link
                    :to="{ name: routeName, query: { ...params, page: page - 1 } }"
                    tag="a"><i class="fa fa-angle-left"></i></router-link>
            </li>
            <template v-for="page in data.last_page">
                <li v-if="page == data.current_page" :key="page" class="tg-active">
                    <router-link
                            :to="{ name: routeName, query: { ...params, page: page } }"
                            tag="a">{{ page }}</router-link>
                </li>
                <li :key="page" v-else-if="page == data.current_page + 1 || page == data.current_page - 1 || page == 1 || page == data.last_page">
                    <router-link
                            :to="{ name: routeName, query: { ...params, page: page } }"
                            tag="a">{{ page }}</router-link>
                </li>
                <li :key="page" v-else-if="page == data.last_page - 1 || page == 2">
                    <span><i class="fa fa-ellipsis-h"></i></span>
                </li>
            </template>
            <li class="tg-nextpage" v-if="page < data.last_page">
                <router-link
                    :to="{ name: routeName, query: { ...params, page: page + 1 } }"
                    tag="a"><i class="fa fa-angle-right"></i></router-link>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: [
            'data',
            'routeName'
        ],
        computed: {
            page: function() {
                return this.$route.query.page ? this.$route.query.page : 1;
            },
            params: function() {
                return this.$route.query;
            },
        }
    }
</script>
