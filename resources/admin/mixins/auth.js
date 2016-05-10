import auth from '../lib/auth';

export default {
    methods: {
        logout: function () {
            let vm = this;
            auth.logout(this).then(function () {
                vm.$toast['success']('退出成功');
                vm.$route.router.go('/login');
            });
        }
    }
}