export default [{
    path: 'users',
    name: 'User',
    redirect: { name: 'UserList' },
    meta: {
        label: 'User',
        icon: 'fas fa-users'
    },
    component: {
        template: '<router-view></router-view>'
    },
    children: [{
            path: '',
            name: 'UserList',
            meta: {
                label: 'List User',
            },
            component: () =>
                import ('@views/Pages/User/Index' /* webpackChunkName: "Pages/User/Index" */ ),
        },
        {
            path: 'create',
            name: 'UserCreate',
            meta: {
                label: 'Add User',
            },
            component: () =>
                import ('@views/Pages/User/Action' /* webpackChunkName: "Pages/User/Action" */ ),
        },
        {
            path: ':uuid/edit',
            name: 'UserEdit',
            meta: {
                label: 'Edit User',
            },
            component: () =>
                import ('@views/Pages/User/Action' /* webpackChunkName: "Pages/User/Action" */ ),
        },
        {
            path: ':uuid',
            name: 'UserShow',
            meta: {
                label: 'User Detail',
            },
            component: () =>
                import ('@views/Pages/User/Show' /* webpackChunkName: "Pages/User/Show" */ ),
        }
    ]
}, ]