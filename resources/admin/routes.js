import LoginComponent from './views/login';
import LayoutComponent from './views/layout';

import DashboardComponent from './views/dashboard';

import AdminIndexComponent from './views/admin/index';
import AdminCreateComponent from './views/admin/create';
import AdminEditComponent from './views/admin/edit';

import PostIndexComponent from './views/post/index';
import PostCreateComponent from './views/post/create';
import PostEditComponent from './views/post/edit';

import CategoryIndexComponent from './views/category/index';
import CategoryCreateComponent from './views/category/create';
import CategoryEditComponent from './views/category/edit';

export default function routeConfig(router) {
    router.map({
        '/login': {
            name: 'login',
            component: LoginComponent
        },
        '/main': {
            name: 'main',
            component: LayoutComponent,
            subRoutes: {
                '/dashboard': {
                    name: 'dashboard',
                    component: DashboardComponent
                },
                //admin
                '/admin/index': {
                    name: 'admin_index',
                    component: AdminIndexComponent
                },
                '/admin/create': {
                    name: 'admin_create',
                    component: AdminCreateComponent
                },
                '/admin/edit/:id': {
                    name: 'admin_edit',
                    component: AdminEditComponent
                },
                //post
                '/post/index': {
                    name: 'post_index',
                    component: PostIndexComponent
                },
                '/post/create': {
                    name: 'post_create',
                    component: PostCreateComponent
                },
                '/post/edit/:id': {
                    name: 'post_edit',
                    component: PostEditComponent
                },
                //category
                '/category/index': {
                    name: 'category_index',
                    component: CategoryIndexComponent
                },
                '/category/create': {
                    name: 'category_create',
                    component: CategoryCreateComponent
                },
                '/category/edit/:id': {
                    name: 'category_edit',
                    component: CategoryEditComponent
                },
            }
        }
    });

    router.redirect({
        '*': '/login',
        '/main': '/main/dashboard'
    });

    router.beforeEach(function (transition) {
        let token = localStorage.getItem('jwt_token');
        if (!token || token === null) {
            router.go('/login');
        }
        transition.next();
    });

}