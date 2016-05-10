<template>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>{{title}}</h2>
            <ol class="breadcrumb" v-if="count>0">
                <li v-for="(key,val) in paths" :class="{'active':$index==(count-1)}">
                    <strong v-if="$index==(count-1)">{{val.name}}</strong>
                    <a href="{{val.url?val.url:'javascript:;'}}" v-else>{{val.name}}</a>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            title: {
                required: true,
                type: String
            },
            paths: {
                type: Array
            }
        },
        computed: {
            count: function () {
                return this.paths.length;
            }
        }
    }
</script>