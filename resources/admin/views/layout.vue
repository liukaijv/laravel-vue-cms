<template>
    <div id="wrapper">

        <sidebar :admin="admin"></sidebar>

        <div id="page-wrapper" class="gray-bg">

            <top :admin="admin"></top>

            <router-view></router-view>

            <bottom></bottom>
        </div>

    </div>
</template>

<script>

    import auth from '../lib/auth';
    import Top from './partial/top';
    import Sidebar from './partial/sidebar';
    import Bottom from './partial/bottom';

    export default {
        ready: function () {
            let vm = this;
            let local_admin = auth.user;
            if (local_admin) {
                vm.admin = local_admin;
            } else {
                let token = auth.getToken();
                vm.$http.get('admin_info', {token: token}).then(function (result) {
                    let data = result.data;
                    if (data.flag == true && data.data) {
                        vm.admin = data.data;
                    }else{
                         vm.$route.router.go('/login');
                    }
                    vm.$toast['success'](data.msg);
                });
            }
        },
        data: function () {
            return {
                admin: {}
            }
        },
        components: {
            top: Top,
            sidebar: Sidebar,
            bottom: Bottom
        }
    }
</script>