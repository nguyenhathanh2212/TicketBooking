import Home from '../components/home/Home.vue'
import Company from '../components/company/Company.vue'

export const routes = [
    { path: '/', component: Home, name: 'home' },
    { path: '/company/:id', component: Company, name: 'company' },
]
