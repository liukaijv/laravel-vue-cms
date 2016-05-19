<style>

    .loading-mask {
        position: absolute;
        left: 0;
        top: 0;
        z-index: 2001;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.2);
    }

    .loading-mask > div {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%);
    }

</style>

<template>

    <div class="loading-mask" :transition="fade" v-show="show">
        <div class="sk-spinner sk-spinner-rotating-plane"></div>
    </div>

</template>

<script>
    export default {
        props: {
            show: {
                default: false
            }
        }
    }
</script>