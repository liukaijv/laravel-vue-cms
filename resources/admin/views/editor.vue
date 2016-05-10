<style>
    .bootstrap-editor {
        overflow: scroll;
        max-height: 300px
    }
</style>
<template>
    <div class="bootstrap-editor">

    </div>
</template>

<script>

    import '../assets/js/bootstrap-wysiwyg';

    export default {
        ready: function () {
            $('.bootstrap-editor').wysiwyg();
        }
    }

</script>