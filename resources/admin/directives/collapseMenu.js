export default {
    twoWay: true,
    priority: 1000,
    params: ['options'],
    bind: function () {
        let self = this;
        let defaults = {
            toggle: true
        };
        let settings = $.extend(defaults, self.params.options);
        let $this = $(this.el);
        let $toggle = settings.toggle;

        $this.find("li.active").has("ul").children("ul").addClass("collapse in");
        $this.find("li").not(".active").has("ul").children("ul").addClass("collapse");

        $this.find("li").children("a").on("click" + ".collapseMenu", function (e) {
            if($(this).siblings("ul").length){
                e.preventDefault();
            }
            $(this).parent("li").toggleClass("active").children("ul").collapse("toggle");
            if ($toggle) {
                $(this).parent("li").siblings().removeClass("active").children("ul.in").collapse("hide");
            }
        });

    },

    update(value) {
        // todo
    },
    unbind() {
        $(this.el).off('.collapseMenu');
    }
}