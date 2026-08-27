document.addEventListener("DOMContentLoaded", function () {
    // submenu --------------
    function handleHover(menuSelector, submenuSelector) {
        var submenu = $(submenuSelector);
        $(menuSelector + ", " + submenuSelector).on("mouseenter", function () {
            if (!submenu.is(":visible")) {
                submenu
                    .stop(true, true)
                    .css({display: "flex", position: "absolute", left: "80px", opacity: 0.3, zIndex: 12})
                    .animate({left: "120px", opacity: 1}, 300);
            }
        });

        $(document).on("mousemove", function (event) {
            var menu = $(menuSelector);

            if (!menu.is(event.target) && menu.has(event.target).length === 0 &&
                !submenu.is(event.target) && submenu.has(event.target).length === 0) {
                submenu
                    .stop(true, true)
                    .animate({left: "80px", opacity: 0}, 300, function () {
                        $(this).css("display", "none");
                    });
            }
        });
    }

    handleHover(".top_menu.down_1", ".submenu1-1");
    handleHover(".topmenu1-2", ".submenu1-2");
    handleHover(".topmenu1-4", ".submenu1-4");


});
