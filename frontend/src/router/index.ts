import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/views/auth/Login.vue'
import Layout from '@/layouts/Layout.vue'
import Home from '@/views/Home.vue'
import { useUserStore } from '@/stores/auth/user.store';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      component: Login,
    },
    {
      path: '/',
      component: Layout,
      children: [
        {
          path: '',
          name: 'home',
          component: Home,
        }
      ],
      meta: { requiresAuth: true }
    }
  ],
});

router.beforeEach(async (to, from, next) => {
  if (to.meta.requiresAuth) {
    const userStore = useUserStore();
    try {
      await userStore.fetchUser();
      if (!userStore.user) {
        next('/login');
      } else if (to.path === '/login' && userStore.user) {
        next('/');
      } else {
        next();
      }
    } catch {
      next('/login');
    }
  } else {
    next();
  }
});

export default router
