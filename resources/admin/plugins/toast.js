import '../assets/js/plugins/toastr/toastr.css';
import Toast from  '../assets/js/plugins/toastr/toastr';

export default {
    install: function (vue) {
        "use strict";
        //Toast.options = {
        //    "closeButton": true,
        //    "debug": false,
        //    "progressBar": true,
        //    "positionClass": "toast-top-right",
        //    "onclick": null,
        //    "showDuration": "400",
        //    "hideDuration": "400",
        //    "timeOut": "7000",
        //    "extendedTimeOut": "1000",
        //    "showEasing": "swing",
        //    "hideEasing": "linear",
        //    "showMethod": "fadeIn",
        //    "hideMethod": "fadeOut"
        //}
        vue.prototype.$toast = Toast;
    }

}