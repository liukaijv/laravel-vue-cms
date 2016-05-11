<style>
    .nav > li > a.v-link-active {
        color: #fff;
    }

    body.mini-navbar .nav-header {
        background: none;
    }
</style>
<template>
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <img :src="admin.image" class="img-circle" width="60">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{admin.name}}</strong>
                                <b class="caret"></b>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a v-link="{name: 'admin_edit', params: {id: admin.id}}">个人资料</a></li>
                            <li class="divider"></li>
                            <li><a @click.prevent="logout">退出</a></li>
                        </ul>
                    </div>
                    <!--  <div class="logo-element">
                         LV
                     </div> -->
                </li>
            </ul>
            <ul class="nav" v-menu>
                <li class="active">
                    <a v-link="{name:'dashboard'}">
                        <i class="fa fa-th"></i>
                        <span class="nav-label">首页</span>
                    </a>
                </li>
                <li>
                    <a>
                        <i class="fa fa-sitemap"></i>
                        <span class="nav-label">分类</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a v-link="{name:'category_index'}">分类列表</a></li>
                        <li><a v-link="{name:'category_create'}">分类添加</a></li>
                    </ul>
                </li>
                <li>
                    <a>
                        <i class="fa fa-files-o"></i>
                        <span class="nav-label">文章</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a v-link="{name:'post_index'}">文章列表</a></li>
                        <li><a v-link="{name:'post_create'}">文章添加</a></li>
                    </ul>
                </li>
                <li>
                    <a>
                        <i class="fa fa-tag"></i>
                        <span class="nav-label">标签</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a v-link="{name:'tag_index'}">标签列表</a></li>
                        <li><a v-link="{name:'tag_create'}">标签添加</a></li>
                    </ul>
                </li>
                <li>
                    <a>
                        <i class="fa fa-comment"></i>
                        <span class="nav-label">评论</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a v-link="{name:'comment_index'}">评论列表</a></li>
                    </ul>
                </li>
                <li>
                    <a>
                        <i class="fa fa-group"></i>
                        <span class="nav-label">用户</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a v-link="{name:'user_index'}">用户列表</a></li>
                        <li><a v-link="{name:'user_create'}">用户添加</a></li>
                    </ul>
                </li>
                <li>
                    <a>
                        <i class="fa fa-user"></i>
                        <span class="nav-label">管理员</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a v-link="{name:'admin_index'}">管理员列表</a></li>
                        <li><a v-link="{name:'admin_create'}">管理员添加</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>
</template>

<script>
    import AuthMixin from '../../mixins/auth';

    export default {
        props: ['admin'],
        mixins: [AuthMixin]
    }
</script>