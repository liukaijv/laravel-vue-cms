<template>
    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-minimalize minimalize-styl-2 btn btn-primary"
                        @click="toggleCanvasMenu">
                    <i class="fa fa-bars"></i>
                </button>
                <form role="search" class="navbar-form-custom">
                    <div class="form-group">
                        <input type="text" placeholder="搜索…" class="form-control" v-model="search_text"
                               @keyup="onKeyup | debounce 300">
                    </div>
                </form>

            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">欢迎您 {{admin.name}}！</span>
                </li>
                <li>
                    <a @click.prevent="logout">
                        <i class="fa fa-sign-out"></i> 退出
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>

    import AuthMixin from '../../mixins/auth';

    export default {
        props: ['admin'],
        data: function () {
            return {
                search_text: ''
            }
        },
        mixins: [AuthMixin],
        methods: {
            onKeyup: function () {
                this.$root.$broadcast('onSearch', this.search_text);
                return false;
            },
            toggleCanvasMenu: function () {
                window.document.body.classList.toggle('mini-navbar');
            }
        }
    }
</script>