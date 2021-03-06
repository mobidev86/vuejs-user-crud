/* Layouts */
const AppLayout = () =>
    import ("@views/Layouts/App" /* webpackChunkName: "Layouts/App" */ );
const ErrorLayout = () =>
    import ("@views/Layouts/Error" /* webpackChunkName: "Layouts/Error" */ );

import user from '@routes/modules/user'
import dashboard from '@routes/modules/dashboard'
import errorRoutes from '@routes/modules/error'

export default [{
        path: '/',
        name: 'App',
        component: AppLayout,
        redirect: { name: 'Dashboard' },
        children: [
            ...dashboard,
            ...user,
        ]
    },
    {
        path: '/',
        name: 'Error',
        component: ErrorLayout,
        children: [
            ...errorRoutes,
        ]
    },
    {
        path: '/:pathMatch(.*)*',
        meta: {
            isNotNav: true,
        },
        beforeEnter: (to, from, next) => {
            next({ name: 'Error404', replace: true, query: { 'ref': to.fullPath, 'from': from.fullPath } })
        }
    }
];