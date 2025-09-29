import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/views/auth/Login.vue'
import Layout from '@/layouts/Layout.vue'
import Home from '@/views/Home.vue'
import { useUserStore } from '@/stores/auth/user.store';
import ListProducts from '@/views/products/ListProducts.vue';
import NewProduct from '@/views/products/NewProduct.vue';
import UpdateProduct from '@/views/products/UpdateProduct.vue';
import Signup from '@/views/auth/Signup.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/login',
      name: 'login',
      component: Login,
    },
    {
      path: '/signup',
      name: 'signup',
      component: Signup,
    },
    {
      path: '/',
      component: Layout,
      children: [
        {
          path: '',
          name: 'home',
          component: Home,
        },
        {
          path: 'products',
          name: 'products',
          component: ListProducts
        },
        {
          path: 'products/create',
          name: 'create-product',
          component: NewProduct
        },
        {
          path: 'products/update/:id',
          name: 'update-product',
          component: UpdateProduct
        },
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
