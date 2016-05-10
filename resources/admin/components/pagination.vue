<template>

    <ul class="pagination {{class}}" v-if="isShow">
        <li v-if="showFirst"><a @click.prevent="page--"><span>&laquo;</span></a></li>
        <li v-for="index in pages" :class="{ 'active': page == index}">
            <a @click.prevent="linkClick(index)">{{ index }}</a>
        </li>
        <li v-if="showLast"><a @click.prevent="page++"><span>&raquo;</span></a></li>
    </ul>

</template>

<script>

    // paginate file component

    export default {
        props: {
            page: {
                type: Number,
                required: true
            },
            showSize: {
                type: Number,
                default: 10
            },
            pageSize: {
                type: Number,
                default: 20
            },
            count: {
                type: Number,
                required: true
            },
            class: {
                type: String,
                default: ''
            }
        },
        computed: {
            isShow: function () {
                return Math.floor(this.count / this.pageSize);
            },
            pages: function () {
                var arr = [],
                        left = 1,
                        totalPage = Math.ceil(this.count / this.pageSize),
                        right = totalPage;
                if (this.showSize > totalPage) {
                    this.showSize = totalPage;
                }
                if (this.current <= 0) {
                    this.page = 1;
                }
                if (this.page > totalPage) {
                    this.page = totalPage;
                }
                if (totalPage >= (this.showSize + 1)) {
                    let halfRight = Math.ceil((this.showSize - 1) / 2)
                    let halfLeft = Math.floor((this.showSize - 1) / 2)
                    if (this.page > halfRight && this.current < totalPage - halfLeft) {
                        left = this.page - halfRight;
                        right = this.page + halfLeft
                    } else {
                        if (this.page <= halfRight) {
                            left = 1
                            right = this.showSize
                        } else {
                            right = totalPage
                            left = totalPage - (this.showSize - 1)
                        }
                    }
                }
                while (left <= right) {
                    arr.push(left)
                    left++
                }
                return arr
            },
            showLast: function () {
                if (this.page == Math.ceil(this.count / this.pageSize)) {
                    return false
                }
                return true
            },
            showFirst: function () {
                if (this.page == 1) {
                    return false
                }
                return true
            }
        },
        methods: {
            linkClick: function (index) {
                if (index != this.page) {
                    this.page = index
                }
            }
        },
        watch: {
            page: function (oldValue, newValue) {
                this.$dispatch('onChangePage', oldValue);
            }
        }
    }

</script>
