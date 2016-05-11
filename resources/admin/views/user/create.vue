<template>
    <div>

        <bread-crumb :title="title" :paths="breadcrumbs"></bread-crumb>

        <div class=" wrapper wrapper-content animated fadeInRight">

            <div class="row">
                <div class="col-lg-12">

                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>{{title}}</h5>

                            <div class="ibox-tools"></div>
                        </div>
                        <div class="ibox-content">

                            <form class="form-horizontal" @submit.prevent="createData">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">邮箱：</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="data.email"
                                               :disabled="data.id">
                                        <label class="help-block error" v-if="errors">{{errors['email']}}</label>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">密码：</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" v-model="data.password">
                                        <label class="help-block error" v-if="errors">{{errors['password']}}</label>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">确认密码：</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" v-model="data.repeat_password">
                                        <label class="help-block error"
                                               v-if="errors">{{errors['repeat_password']}}</label>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">姓名：</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="data.name">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button type="submit" class="btn btn-primary">提交
                                        </button>
                                        <a v-link="{name:'admin_index'}" class="btn btn-white">取消</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</template>

<script>

    import BreadCrumb from '../partial/bread-crumb';

    export default {
        data: function () {
            return {
                title: '用户创建',
                breadcrumbs: [
                    {
                        name: '首页',
                        url: ''
                    },
                    {
                        name: '用户创建',
                        url: ''
                    }
                ],
                data: {
                    name: '',
                    email: '',
                    password: '',
                    repeat_password: ''
                },
                errors: null
            }
        },
        components: {
            'bread-crumb': BreadCrumb
        },
        methods: {
            createData: function () {
                this.$http.post('user', this.data).then(function (result) {
                    let data = result.data;
                    if (data.flag == true) {
                        this.$route.router.go('/main/user/index');
                    }
                    if (data.errors) {
                        this.errors = data.errors;
                    }
                    this.$toast['success'](data.msg);
                });
            }
        }
    }
</script>