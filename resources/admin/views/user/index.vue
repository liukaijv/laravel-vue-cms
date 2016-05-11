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

                            <data-table :data="data" :columns="columns"></data-table>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="pull-right">
                                        <pagination :count="count" :page="page" :page-size="pageSize"></pagination>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</template>

<script>
    import BreadCrumb from '../partial/bread-crumb';
    import DataTable from '../../components/data-table';
    import Pagination from '../../components/pagination';

    export default {
        ready: function () {
            this.getData();
        },
        data: function () {
            return {
                title: '用户列表',
                breadcrumbs: [
                    {
                        name: '首页',
                        url: ''
                    },
                    {
                        name: '用户列表',
                        url: ''
                    }
                ],
                page: 1,
                pageSize: 15,
                count: 0,
                data: [],
                columns: {
                    id: '#',
                    name: '姓名',
                    email: '邮箱',
                    created_at: '创建时间'
                }

            }
        },
        components: {
            'bread-crumb': BreadCrumb,
            'data-table': DataTable,
            'pagination': Pagination
        },
        methods: {
            getData: function () {
                this.$http.get('user', {
                    page: this.page,
                    page_size: this.pageSize
                }).then(function (result) {
                    let data = result.data;
                    this.data = data.data;
                    this.count = data.count;
                });
            }
        },
        events: {
            onEdit: function (id) {
                this.$route.router.go({name: 'user_edit', params: {id: id}})
            },
            onDelete: function (id) {
                this.$http.delete('user/' + id).then(function (result) {
                    let data = result.data;
                    if (data.flag == true) {
                        this.getData();
                    }
                    this.$toast['success'](data.msg);
                });
            },
            onChangePage: function (page) {
                this.page = page;
                this.getData();
            }
        }
    }
</script>