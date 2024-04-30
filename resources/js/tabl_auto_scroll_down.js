document.addEventListener("DOMContentLoaded", function (event) {
    var check = $(".table-auto-scroll");
    if (check.length) {
        // table auto scroll
        var $el = $(".table-auto-scroll");
        anim();
        $el.hover(stop, anim);
        // END table auto scroll
    }
});

window.anim = function () {
    var $el = $(".table-auto-scroll");
    var st = $el.scrollTop();
    var sb = $el.prop("scrollHeight") - $el.innerHeight();
    $el.animate({
        scrollTop: st < sb / 2 ? sb : 0
    }, 15000, anim);
}

window.stop = function () {
    var $el = $(".table-auto-scroll");
    $el.stop();
}
