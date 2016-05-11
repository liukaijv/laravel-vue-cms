<template>
    <textarea data-role="summernote"></textarea>
</template>

<script>

    import  '../assets/js/plugins/summernote/summernote';
    import  '../assets/js/plugins/summernote/summernote.css';
    import  '../assets/js/plugins/summernote/summernote-bs3.css';

    export default {
        replace: true,
        inherit: false,
        props: {
            model: {
                required: true,
                twoWay: true
            },
            language: {
                type: String,
                required: false,
                default: "en-US"
            },
            height: {
                type: Number,
                required: false,
                default: 300
            },
            minHeight: {
                type: Number,
                required: false,
                default: 200
            },
            maxHeight: {
                type: Number,
                required: false,
                default: 800
            },
            toolbar: {
                type: Array,
                required: false,
                default: function () {
                    return [
                        ["font", ["bold", "italic", "underline", "clear"]],
                        ["fontsize", ["fontsize"]],
                        ["para", ["ul", "ol", "paragraph"]],
                        ["color", ["color"]],
                        ["insert", ["link", "picture", "hr"]]
                    ];
                }
            }
        },
        beforeCompile: function () {
            this.isChanging = false;
            this.control = null;
        },
        ready: function () {
            if (this.minHeight > this.height) {
                this.minHeight = this.height;
            }
            if (this.maxHeight < this.height) {
                this.maxHeight = this.height;
            }
            var me = this;
            this.control = $(this.$el);
            this.control.summernote({
                lang: this.language,
                height: this.height,
                minHeight: this.minHeight,
                maxHeight: this.maxHeight,
                toolbar: this.toolbar,
                onInit: function () {
                    me.control.code(me.model);
                }
            }).on("summernote.change", function () {
                if (!me.isChanging) {
                    me.isChanging = true;
                    var code = me.control.code();
                    me.model = (code === null || code.length === 0 ? null : code);
                    me.$nextTick(function () {
                        me.isChanging = false;
                    });
                }
            });
        },
        watch: {
            model: function (val, oldVal) {
                if (!this.isChanging) {
                    this.isChanging = true;
                    var code = (val === null ? "" : val);
                    this.control.code(code).trigger("summernote.change");
                    this.isChanging = false;
                }
            }
        }
    }

</script>