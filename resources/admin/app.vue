<template>
    <div>
        <router-view></router-view>
        <loading :show="showLoading"></loading>
    </div>
</template>

<script>
    import Vue from 'vue';
    import Loading from './components/loading';
    export default {
        ready: function () {
            let vm = this;
            Vue.http.interceptors.push({
                request: function (request) {
                    vm.showLoading = true;
                    return request;
                },
                response: function (response) {
                    vm.showLoading = false;
                    return response;
                }
            });
        },
        data: function () {
            return {
                showLoading: false
            }
        },
        components: {
            loading: Loading
        }
    }
</script>