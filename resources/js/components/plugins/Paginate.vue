<template>
    <nav v-if="data.last_page > 1" class="tg-pagination">
        <ul>
            <li class="tg-prevpage" v-if="page > 1">
                <router-link
                    :to="{ name: routeName, query: { ...params, page: page - 1 } }"
                    tag="a"><i class="fa fa-angle-left"></i></router-link>
            </li>
            <li v-for="page in data.last_page" :key="page" :class="page == data.current_page ? 'tg-active' : ''">
                <router-link
                    :to="{ name: routeName, query: { ...params, page: page } }"
                    tag="a">{{ page }}</router-link>
            </li>
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
