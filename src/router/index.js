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
import UserDetails from '../views/account/UserDetails.vue'
import ForgotPassword from '../views/auth/ForgotPassword.vue'
import PasswordReset from '../views/auth/PasswordReset.vue'
import PageNotFound from '../views/PageNotFound.vue'
import Privacy from '../views/Privacy.vue'
import { useAuthStore } from '../stores/auth'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
        path: '/:pathMatch(.*)*',
        name: 'not-found',
        component: PageNotFound
    },
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
        path: '/privacy-policy',
        name: 'privacy',
        component: Privacy,
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
        path: '/forgot-password',
        name: 'forgot-password',
        component: ForgotPassword,
        meta: { guest: true }
    },
    {
        path: '/password-reset/:token',
        name: 'password-reset',
        component: PasswordReset,
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
        name: 'account-pitches',
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
    },
    {
        path: '/my-account/user',
        name: 'user-details',
        component: UserDetails,
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

    if( to.meta.auth && !authStore.user ) return { name: 'login' };
    if ( to.meta.guest && authStore.user ) return { name: 'home' }
})


export default router
