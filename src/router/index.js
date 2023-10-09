import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Listing from '../views/pitch/Listing.vue'
import Show from '../views/pitch/Show.vue'
import Login from '../views/auth/Login.vue'
import Register from '../views/auth/Register.vue'
import AccountHome from '../views/account/AccountHome.vue'
import PitchUpload from '../views/account/pitch/PitchUpload.vue'
import AccountPitches from '../views/account/pitch/AccountPitches.vue'
import AccountSavedPitches from '../views/account/pitch/AccountSavedPitches.vue'
import { useAuthStore } from '../stores/auth'

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
        component: Login,
        meta: { guest: true }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: { guest: true }
    },
    {
        path: '/my-account',
        name: 'account-home',
        component: AccountHome,
        meta: { auth: true }
    },
    {
        path: '/my-account/pitches',
        name: 'account-pitch-index',
        component: AccountPitches,
        meta: { auth: true }
    },
    {
        path: '/my-account/saved-pitches',
        name: 'account-pitches-saved',
        component: AccountSavedPitches,
        meta: { auth: true }
    },
    {
        path: '/my-account/pitches/create',
        name: 'pitch-create',
        component: PitchUpload,
        meta: { auth: true }
    }
  ]
})

router.beforeEach(async (to) => {    
    const authStore = useAuthStore();
    await authStore.getUser()
        .then(() => {
           
        })
        .catch(() => {

        })

    if( to.meta.auth && !authStore.user ) return '/login';
    if ( to.meta.guest && authStore.user ) return '/'
})

export default router
