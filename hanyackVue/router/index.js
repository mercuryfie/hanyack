import { createRouter, createWebHistory } from 'vue-router'

// views
import LoginView from '@/views/LoginView.vue';
import MainListView from '@/views/MainListView.vue';
import MyPageView from '@/views/MyPageView.vue';
import orderListDecocView from '@/views/orderListDecocView.vue';

// components
import SafetyMsgComponent from '@/components/SafetyMsgComponent.vue';
import smsVerify from '@/components/PhoneVerificationComponent.vue';

const routes = [
    {
        path: '/',
        redirect: '/main'  // 기본 접속 시 로그인 페이지로 리다이렉트
    },
    {
        path: '/login',
        name: 'LoginView',
        component: LoginView,
    },
    {
        path: '/mainList',
        name: 'MainListView',
        component: MainListView,
    },
    {
        path: '/mypage',
        name: 'MyPageView',
        component: MyPageView,
    },
    {
        path: '/mypage/orderList',
        name: 'orderListDecocView',
        component: orderListDecocView,
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

// 인증 라우터 가드 예시
router.beforeEach((to, from, next) => {
    const isAuthenticated = !!localStorage.getItem('token')  // 토큰 존재하면 인증된 상태
    if (to.meta.requiresAuth && !isAuthenticated) {
        next('/login')
    } else {
        next()
    }
})



export default router
