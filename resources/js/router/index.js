import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '@home/Home.vue'
import CompanyIndex from '@company/Index.vue'
import Company from '@company/Company.vue'
import CompanyDetail from '@company/detail/CompanyDetail.vue'
import RouteIndex from '@route/Index.vue'
import Route from '@route/Route.vue'
import RouteDetail from '@route/detail/Index.vue'
import Book from '@route/detail/Book.vue'
import NotFound from '@layout/404.vue'
import BusStation from '@station/Index.vue'

Vue.use(VueRouter);

const router = new VueRouter({
    routes: [
        { path: '/', component: Home, name: 'home' },
        { path: '/company', component: CompanyIndex, name: 'company', children: [
            { path: 'index', component: Company, name: 'company.index' },
            { path: ':id', component: CompanyDetail, name: 'company.show' }
        ] },
        { path: '/route', component: RouteIndex, name: 'route', children: [
            { path: 'index', component: Route, name: 'route.index' },
            { path: ':id', component: RouteDetail, name: 'route.show' },
            { path: ':id/booking', component: Book, name: 'route.booking' }
        ] },
        { path: '/bus-station', component: BusStation, name: 'bus_station'},
        { path: '/*', component: NotFound, name: '404'}
    ],
    scrollBehavior (to, from, savedPosition) {
        return { x: 0, y: 0 }
    }
})

router.beforeResolve((to, from, next) => {
    if (to.name) {
        NProgress.start();
    }
    
    next();
})
  
router.afterEach((to, from) => {
    NProgress.done();
})

export default router
