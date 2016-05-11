import LoginComponent from './views/login';
import LayoutComponent from './views/layout';

import DashboardComponent from './views/dashboard';

import AdminIndexComponent from './views/admin/index';
import AdminCreateComponent from './views/admin/create';
import AdminEditComponent from './views/admin/edit';

import CategoryIndexComponent from './views/category/index';
import CategoryCreateComponent from './views/category/create';
import CategoryEditComponent from './views/category/edit';

import PostIndexComponent from './views/post/index';
import PostCreateComponent from './views/post/create';
import PostEditComponent from './views/post/edit';

import TagIndexComponent from './views/tag/index';
import TagCreateComponent from './views/tag/create';
import TagEditComponent from './views/tag/edit';

import CommentIndexComponent from './views/comment/index';
import CommentCreateComponent from './views/comment/create';
import CommentEditComponent from './views/comment/edit';

import UserIndexComponent from './views/user/index';
import UserCreateComponent from './views/user/create';
import UserEditComponent from './views/user/edit';

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
                //tag
                '/tag/index': {
                    name: 'tag_index',
                    component: TagIndexComponent
                },
                '/tag/create': {
                    name: 'tag_create',
                    component: TagCreateComponent
                },
                '/tag/edit/:id': {
                    name: 'tag_edit',
                    component: TagEditComponent
                },
                //tag
                '/comment/index': {
                    name: 'comment_index',
                    component: CommentIndexComponent
                },
                '/comment/create': {
                    name: 'comment_create',
                    component: CommentCreateComponent
                },
                '/comment/edit/:id': {
                    name: 'comment_edit',
                    component: CommentEditComponent
                },
                //user
                '/user/index': {
                    name: 'user_index',
                    component: UserIndexComponent
                },
                '/user/create': {
                    name: 'user_create',
                    component: UserCreateComponent
                },
                '/user/edit/:id': {
                    name: 'user_edit',
                    component: UserEditComponent
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