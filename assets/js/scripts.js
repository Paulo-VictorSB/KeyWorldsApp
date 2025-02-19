$(document).ready(function () {
    $(".menu-toggle").click(function () {
        $(".menu-overlay").addClass("open");
    });

    $(".close-menu").click(function () {
        $(".menu-overlay").removeClass("open");
    });

    $(".menu-content a").click(function () {
        $(".menu-overlay").removeClass("open");
    });
});