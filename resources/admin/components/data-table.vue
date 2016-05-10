<template>
    <table class="table">
        <thead>
        <tr>
            <td v-for="(k,v) in columns">
                {{typeof v=='object'?v[0]:v}}
            </td>
            <td>操作</td>
        </tr>
        </thead>
        <tbody>
        <tr v-for="entry in data">
            <td v-for="(k,v) in columns">
                {{typeof v=='object'&&entry[k]?entry[k][v[1]]:entry[k]}}              
            </td>
            <td>
                <a :class="{'m-l-sm':$index>0}" @click.prevent="invokeAction(action.name,entry[action.prop])"
                   v-for="action in actions">{{action.display}}</a>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
    import {ucFirst} from '../lib/utils';

    export default {
        props: {
            columns: {
                required: true,
                type: Object
            },
            data: {
                required: true,
                type: Array
            },
            actions: {
                type: Array,
                default: function () {
                    return [
                        {
                            name: 'edit',
                            display: '编辑',
                            prop: 'id'
                        },
                        {
                            name: 'delete',
                            display: '删除',
                            prop: 'id'
                        }
                    ]
                }
            },
            class: {
                type: String
            }
        },
        methods: {
            invokeAction: function (action, params) {
//                if (action && params) {
//                    this.$dispatch('on' + ucFirst(action), params);
//                }
                //accept array or string
                action = 'on' + ucFirst(action);
                let args = [];
                if (Array.isArray(params)) {
                    params.unshift(action);
                    args = params;
                } else {
                    args = [action, params];
                }
                let dispatch = this.$dispatch;
                dispatch.apply(this, args);
            }
        }
    }
</script>