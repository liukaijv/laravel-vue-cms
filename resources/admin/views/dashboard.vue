<template>

    <div class=" wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">
                <div class="widget navy-bg">
                    <div class="row vertical-align">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <h2 class="font-bold">{{data.users_count}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget navy-bg">
                    <div class="row vertical-align">
                        <div class="col-xs-3">
                            <i class="fa fa-thumbs-up fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <h2 class="font-bold">{{data.posts_count}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget navy-bg">
                    <div class="row vertical-align">
                        <div class="col-xs-3">
                            <i class="fa fa-rss fa-3x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <h2 class="font-bold">{{data.categories_count}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        ready: function () {
            this.getData();
        },
        data: function () {
            return {
                data: {
                    posts_count: 0,
                    users_count: 0,
                    categories_count: 0
                }
            }
        },
        methods: {
            getData: function () {
                this.$http.get('dashboard').then(function (result) {
                    let data = result.data;
                    this.data = data.data;
                });
            }
        }
    }
</script>