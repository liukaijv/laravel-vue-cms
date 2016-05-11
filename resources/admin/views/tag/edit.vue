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
                                    <label class="col-sm-2 control-label">标签名称：</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="data.name">
                                        <label class="help-block error" v-if="errors">{{errors['name']}}</label>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button type="submit" class="btn btn-primary">提交
                                        </button>
                                        <a v-link="{name:'tag_index'}" class="btn btn-white">取消</a>
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
        ready: function () {
            this.data.id = this.$route.params.id;
            this.$http.get('tag/' + this.data.id + '/edit').then(function (result) {
                let data = result.data;
                if (data.flag == true && data.data) {
                    this.data = data.data;
                }
                this.$toast['success'](data.msg);
            })
        },
        data: function () {
            return {
                title: '标签修改',
                breadcrumbs: [
                    {
                        name: '首页',
                        url: ''
                    },
                    {
                        name: '标签修改',
                        url: ''
                    }
                ],
                categories: [],
                data: {
                    id: 0,
                    name: ''
                },
                errors: null
            }
        },
        components: {
            'bread-crumb': BreadCrumb
        },
        methods: {
            updateData: function () {
                this.$http.put('tag/' + this.data.id, this.data).then(function (result) {
                    let data = result.data;
                    if (data.flag == true) {
                        this.$route.router.go('/main/tag/index');
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