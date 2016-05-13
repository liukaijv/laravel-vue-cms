<template>
    <div class="middle-box text-center animated fadeInDown">
        <div>
            <form class="m-t" role="form" onsubmit="return false">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="邮箱/用户名" required v-model="credentials.name">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="密码" required
                           v-model="credentials.password">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b" @click="login">登陆</button>
            </form>
        </div>
    </div>
</template>

<script>

    import auth from '../lib/auth';

    export default {
        data: function () {
            return {
                credentials: {
                    name: '',
                    password: ''
                }

            };
        },
        methods: {
            login: function () {

                let vm = this;

                auth.login(vm, vm.credentials).then(function () {
                    vm.$route.router.go('/main/dashboard');
                    vm.$toast['success']('登陆成功');
                }, function (error) {
                    vm.$toast['success'](error.msg);
                });

            }
        }
    }
</script>