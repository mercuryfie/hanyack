document.addEventListener("DOMContentLoaded", function () { 
    // submenu --------------
    function handleHover(menuSelector, submenuSelector) {
        var submenu = $(submenuSelector);
        $(menuSelector + ", " + submenuSelector).on("mouseenter", function () {
            if (!submenu.is(":visible")) {
                submenu
                    .stop(true, true)
                    .css({ display: "flex", position: "absolute", left: "80px", opacity: 0.3 , zIndex:12 })
                    .animate({ left: "120px", opacity: 1 }, 300);
            }
        });
 
        $(document).on("mousemove", function (event) {
            var menu = $(menuSelector);

            if (!menu.is(event.target) && menu.has(event.target).length === 0 &&
                !submenu.is(event.target) && submenu.has(event.target).length === 0) {
                submenu
                    .stop(true, true)
                    .animate({ left: "80px", opacity: 0 }, 300, function () {
                        $(this).css("display", "none");
                    });
                }
            });
        }
 
        handleHover(".topmenu1-1", ".submenu1-1");
        handleHover(".topmenu1-2", ".submenu1-2");
        handleHover(".topmenu1-4", ".submenu1-4");

    // "a" 태그를 찾아서 이름 형식 적용
    // $('.merleft1-2 .identifier').each(function() {
    //     let $a = $(this);
    //     let name = $a.text().trim(); // "홍길동 님"
    //     let nameOnly = name.replace(" 님", ""); // "홍길동"만 추출
    //     if (nameOnly.length >= 6) {
    //         let formattedName = nameOnly.substring(0, 4) + "<br>" + nameOnly.substring(4);
    //         $a.html(formattedName + " 님"); // 변경된 이름 다시 넣기
    //     }
    // });
});
