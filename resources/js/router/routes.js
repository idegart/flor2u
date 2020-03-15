export default [
    {
        path: '/',
        component: () => import(/* webpackChunkName: "layout-app-base" */ '@layout/AppBaseLayout'),
        children: [
            {
                path: 'weather',
                name: 'weather',
                component: () => import(/* webpackChunkName: "page-weather" */ '@page/Weather')
            },
            {
                path: 'orders',
                name: 'orders',
                component: () => import(/* webpackChunkName: "page-orders" */ '@page/Orders')
            },
            {
                path: 'order/:id',
                name: 'order',
                component: () => import(/* webpackChunkName: "page-order" */ '@page/Order')
            },
        ]
    }
]
