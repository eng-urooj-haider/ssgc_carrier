import { createRouter, createWebHistory } from 'vue-router'
import api from '../axios.js'

const routes = [
  {
    path: '/login',
    component: () => import('@/components/views/Login.vue'),
    meta: { guestOnly: true }
  },
  {
    path: '/register',
    component: () => import('@/components/views/Register.vue'),
    meta: { guestOnly: true }
  },
  {
    path: '/dashboard',
    component: () => import('@/components/views/Dashboard.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/home',
    component: () => import('@/components/views/Home.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/logout',
    component: () => import('@/components/views/Logout.vue')
  },
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
})

// Global navigation guard
router.beforeEach(async (to, from, next) => {
  let user = null

  try {
    const response = await api.get('/user')
    user = response.data.user //  important
  } catch (error) {
    user = null
  }

  // Redirect logged-in user away from login page
  if (to.meta.guestOnly && user) {
    return next(user.is_admin ? '/dashboard' : '/home')
  }

  // Redirect guest trying to access protected page
  if (to.meta.requiresAuth && !user) {
    return next('/login')
  }

  next() // allow navigation if none of the above
})

export default router
