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
                                    <label class="col-sm-2 control-label">文章名称：</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" v-model="data.title">
                                        <label class="help-block error" v-if="errors">{{errors['title']}}</label>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">文章分类：</label>

                                    <div class="col-sm-10">
                                        <select class="form-control" v-model="data.category_id">
                                            <option v-for="category in categories" :value="category.id">
                                                {{category.name}}
                                            </option>
                                        </select>
                                        <label class="help-block error" v-if="errors">{{errors['category_id']}}</label>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">文章标签：</label>

                                    <div class="col-sm-10">
                                        <select class="form-control" id="select2" multiple="multiple" style="display: none;">
                                            <option v-for="tag in tags" :value="tag.id"
                                                    :selected="inArray(initSelectedTds,tag.id)">
                                                {{tag.name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">文章描述：</label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" v-model="data.description"></textarea>
                                        <label class="help-block error" v-if="errors">{{errors['description']}}</label>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">文章内容：</label>

                                    <div class="col-sm-10">
                                        <editor :model.sync="data.content"></editor>
                                        <label class="help-block error" v-if="errors">{{errors['content']}}</label>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button type="submit" class="btn btn-primary">提交
                                        </button>
                                        <a v-link="{name:'post_index'}" class="btn btn-white">取消</a>
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
    import Editor from '../../components/editor';
    import {extend} from '../../lib/utils';

    import '../../assets/js/plugins/select2/select2.css';
    import '../../assets/js/plugins/select2/select2';

    export default {
        ready: function () {
            let vm = this;
            this.data.id = this.$route.params.id;

            this.getData().then(function () {
                $('#select2').select2({
                    placeholder: '选择标签',
                    tags: true
                }).on('change.select2', function () {
                    vm.data.tagIds = ($('#select2').val());
                }).trigger('change');
            });

        },
        data: function () {
            return {
                title: '文章修改',
                breadcrumbs: [
                    {
                        name: '首页',
                        url: ''
                    },
                    {
                        name: '文章修改',
                        url: ''
                    }
                ],
                categories: [],
                tags: [],
                data: {
                    title: '',
                    category_id: 0,
                    description: '',
                    tags: [],
                    tagIds: [],
                    content: ''
                },
                errors: null
            }
        },
        computed: {
            initSelectedTds: function () {
                let arr = [];
                for (let index in this.data.tags) {
                    arr.push(this.data.tags[index]['id']);
                }
                return arr;
            }
        },
        components: {
            'bread-crumb': BreadCrumb,
            'editor': Editor
        },
        methods: {
            inArray: function (array, item) {
                return Array.indexOf(array, item) > -1;
            },
            getData: function () {
                return new Promise(function (resolve, reject) {
                    this.$http.get('post/' + this.data.id + '/edit').then(function (result) {
                        let data = result.data;
                        if (data.flag == true && data.data) {
                            this.data = extend(this.data, data.data);
                            this.categories = data.categories;
                            this.tags = data.tags;
                        }
                        this.$toast['success'](data.msg);
                        resolve(result);
                    }, function (error) {
                        reject(error);
                    });
                }.bind(this));
            },
            updateData: function () {
                this.$http.put('post/' + this.data.id, this.data).then(function (result) {
                    let data = result.data;
                    if (data.flag == true) {
                        this.$route.router.go('/main/post/index');
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