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

                            <form class="form-horizontal" @submit.prevent="updateData">

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
                                    <label class="col-sm-2 control-label">旧密码：</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" v-model="data.password">
                                        <label class="help-block error" v-if="errors">{{errors['password']}}</label>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">新密码：</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" v-model="data.new_password">
                                        <label class="help-block error" v-if="errors">{{errors['new_password']}}</label>
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
    import {extend} from '../../lib/utils';
    import BreadCrumb from '../partial/bread-crumb';

    export default {
        ready: function () {
            this.data.id = this.$route.params.id;
            this.getData();
        },
        data: function () {
            return {
                title: '管理员编辑',
                breadcrumbs: [
                    {
                        name: '首页',
                        url: ''
                    },
                    {
                        name: '管理员编辑',
                        url: ''
                    }
                ],
                data: {
                    id: 0,
                    name: '',
                    email: '',
                    password: '',
                    new_password: ''
                },
                errors: null
            }
        },
        components: {
            'bread-crumb': BreadCrumb
        },
        methods: {
            getData: function () {
                this.$http.get('user/' + this.data.id + '/edit').then(function (result) {
                    let data = result.data;
                    if (data.flag == true && data.data) {
                        this.data = extend(this.data, data.data);
                    }
                    this.$toast['success'](data.msg);
                });
            },
            updateData: function () {
                this.$http.put('user/' + this.data.id, this.data).then(function (result) {
                    let data = result.data;
                    if (data.flag == true && data.data) {
                        this.data = extend(this.data, data.data);
                        this.errors = {};
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