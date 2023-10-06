import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Listing from '../views/pitch/Listing.vue'
import Show from '../views/pitch/Show.vue'
import Login from '../views/auth/Login.vue'
import Register from '../views/auth/Register.vue'
import AccountHome from '../views/account/AccountHome.vue'
import PitchUpload from '../views/account/pitch/PitchUpload.vue'
import AccountPitches from '../views/account/pitch/AccountPitches.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/pitches',
      name: 'pitch-listing',
      component: Listing
    },
    {
        path: '/pitches/pitch/:pitchId',
        name: 'pitch-show',
        component: Show
    },
    {
        path: '/login',
        name: 'login',
        component: Login
    },
    {
        path: '/register',
        name: 'register',
        component: Register
    },
    {
        path: '/my-account',
        name: 'account-home',
        component: AccountHome
    },
    {
        path: '/my-account/pitches',
        name: 'account-pitch-index',
        component: AccountPitches
    },
    {
        path: '/my-account/pitches/create',
        name: 'pitch-create',
        component: PitchUpload
    }
  ]
})

export default router
