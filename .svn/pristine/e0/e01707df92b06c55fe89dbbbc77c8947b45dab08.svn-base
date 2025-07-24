document.addEventListener("DOMContentLoaded", function () {
    const popupConfig = [
        {
            openBtns: ".cart_ordernow",
            popup: ".cart_orderpopcon",
            closeBtn: ".close_corder",
        },
        {
            openBtns: ".dltbtn",
            popup: ".cart_dltmercon",
            closeBtn: ".close_dltmer",
        },
    ];

    popupConfig.forEach((config) => {
        const openButtons = document.querySelectorAll(config.openBtns); // 여러 개의 버튼
        const popup = document.querySelector(config.popup); // 팝업 요소
        const closeButton = document.querySelector(config.closeBtn); // 닫기 버튼

        // 각 열기 버튼에 클릭 이벤트 추가
        openButtons.forEach((button) => {
            button.addEventListener("click", () => {
                popup.style.display = "block"; // 팝업 열기
            });
        });

        // 닫기 버튼에 클릭 이벤트 추가
        closeButton.addEventListener("click", () => {
            popup.style.display = "none"; // 팝업 닫기
        });

        window.addEventListener("click", function (event) {
            if (event.target == popup) {
                popup.style.display = "none";
            }
        });
    });
});
