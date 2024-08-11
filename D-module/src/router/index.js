import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SignUpView from "@/views/SignUpView.vue";
import SignInView from "@/views/SignInView.vue";
import SignOutView from "@/views/SignOutView.vue";
import ProfileView from "@/views/ProfileView.vue";
import ManageGameView from "@/views/ManageGameView.vue";
import GameView from "@/views/GameView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/sign-up',
      name: 'sign-up',
      component: SignUpView
    },
    {
      path: '/sign-in',
      name: 'sign-in',
      component: SignInView
    },
    {
      path: '/sign-out',
      name: 'sign-out',
      component: SignOutView
    },
    {
      path: '/user/:username',
      name: 'user',
      component: ProfileView
    },
    {
      path: '/game/:slug/manage',
      name: 'game-manage',
      component: ManageGameView,
    },
    {
      path: '/game/:slug',
      name: 'game',
      component: GameView,
    }
  ]
})

export default router
