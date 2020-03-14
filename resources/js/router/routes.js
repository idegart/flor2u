export default [
    {
        path: '/',
        component: () => import(/* webpackChunkName: "layout-app-base" */ '@layout/AppBaseLayout'),
        children: [
            {
                path: 'weather',
                name: 'weather',
                component: () => import(/* webpackChunkName: "page-weather" */ '@page/Weather')
            }
        ]
    }
]
