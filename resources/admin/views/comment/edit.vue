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
                                    <label class="col-sm-2 control-label">评论人：</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="data.name" disabled>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">评论文章：</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="data.post.title" disabled>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">邮箱：</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="data.email" disabled>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">网站：</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="data.website" disabled>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">评论内容：</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" v-model="data.content" disabled></textarea>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <a v-link="{name:'comment_index'}" class="btn btn-white">取消</a>
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
    import {extend} from '../../lib/utils';

    export default {
        ready: function () {
            this.data.id = this.$route.params.id;
            this.getData();

        },
        data: function () {
            return {
                title: '评论查看',
                breadcrumbs: [
                    {
                        name: '首页',
                        url: ''
                    },
                    {
                        name: '评论查看',
                        url: ''
                    }
                ],
                data: {
                    id: 0,
                    post: {},
                    name: '',
                    email: '',
                    website: '',
                    content: ''
                },
                errors: null
            }
        },
        components: {
            'bread-crumb': BreadCrumb
        },
        methods: {
            getData: function () {
                return new Promise(function (resolve, reject) {
                    this.$http.get('comment/' + this.data.id + '/edit').then(function (result) {
                        let data = result.data;
                        if (data.flag == true && data.data) {
                            this.data = extend(this.data, data.data);
                        }
                        this.$toast['success'](data.msg);
                        resolve(result);
                    }, function (error) {
                        reject(error);
                    });
                }.bind(this));
            },
            updateData: function () {

            }
        }
    }
</script>