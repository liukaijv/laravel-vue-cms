import '../assets/js/plugins/select2/select2.min.css';
import '../assets/js/plugins/select2/select2.min';

export default {
    twoWay: true,
    priority: 1000,
    params: ['options'],
    bind: function () {
        var self = this;
        $(this.el)
            .select2({
                data: this.params.options
            })
            .on('change', function () {
                self.set(this.value);
            });
    },
    update: function (value) {
        $(this.el).val(value).trigger('change');
    },
    unbind: function () {
        $(this.el).off().select2('destroy');
    }
}