document.addEventListener("DOMContentLoaded", function () {
    // hbname 이 같으면 col 13,14,15,16 값을 - 로 처리
    const rows = document.querySelectorAll(".sotable tbody tr");
    let prevHbname = null;

    rows.forEach((row, index) => {
        const hbnameElement = row.querySelector(".hbname p:first-child");
        const columnsToModify = [13, 14, 15, 16];

        if (hbnameElement) {
            const hbname = hbnameElement.textContent.trim();

            if (hbname === prevHbname) {
                columnsToModify.forEach((colIndex) => {
                    const col = row.querySelector(`td:nth-child(${colIndex})`);
                    if (col) col.textContent = "-";
                });
            } else {
                prevHbname = hbname;
            }
        }
    });

    // smartOrder 더보기 popbox에서 가격순 필터링
    const select = document.getElementById("popslt");
    const container = document.querySelector(".bestcon1-2");
    const originalOrder = Array.from(container.children);

    select.addEventListener("change", function () {
        const selectedOption = this.value;
        let items = Array.from(container.querySelectorAll(".bestops"));

        if (selectedOption === "저가순") {
            items.sort((a, b) => {
                const priceA = parseInt(
                    a
                        .querySelector(".becon1-3 p:nth-child(3)")
                        .textContent.replace(/[,원]/g, ""),
                );
                const priceB = parseInt(
                    b
                        .querySelector(".becon1-3 p:nth-child(3)")
                        .textContent.replace(/[,원]/g, ""),
                );
                return priceA - priceB; // 오름차순 정렬
            });
        } else if (selectedOption === "고가순") {
            items.sort((a, b) => {
                const priceA = parseInt(
                    a
                        .querySelector(".becon1-3 p:nth-child(3)")
                        .textContent.replace(/[,원]/g, ""),
                );
                const priceB = parseInt(
                    b
                        .querySelector(".becon1-3 p:nth-child(3)")
                        .textContent.replace(/[,원]/g, ""),
                );
                return priceB - priceA; // 내림차순 정렬
            });
        } else {
            items = originalOrder; // 원래 순서 복원
        }

        container.innerHTML = "";
        items.forEach((item) => container.appendChild(item));
    });

    // smartOrder에서 제약사필터링
    const pharli = document.getElementById("pharli");

    pharli.addEventListener("change", function () {
        const selectedValue = this.value;
        const rows = document.querySelectorAll(".sotable tbody tr");

        rows.forEach((row) => (row.style.display = ""));

        if (selectedValue) {
            rows.forEach((row) => {
                const product =
                    row.querySelector("td:nth-child(3)").textContent;
                row.style.display = product === selectedValue ? "" : "none";
            });
        }
    });

    // smartOrder에서 origin 필터링
    const originli = document.getElementById("originli");
    originli.addEventListener("change", function () {
        const selectedValue = this.value;
        const rows = document.querySelectorAll(".sotable tbody tr");

        rows.forEach((row) => (row.style.display = ""));

        if (selectedValue) {
            rows.forEach((row) => {
                const product =
                    row.querySelector("td:nth-child(6)").textContent;
                row.style.display = product === selectedValue ? "" : "none";
            });
        }
    });
    // smartOrder에서 orderli 필터링
    const smartcon3 = document.querySelector(".smartcon3");
    smartcon3.addEventListener("change", function (event) {
        if (event.target.id === "orderli") {
            event.stopPropagation();

            const orderli = event.target;
            const selectedOption = orderli.value;
            const tbody = document.querySelector(".smartcon3 tbody");

            if (!tbody) {
                console.error("tbody not found in smartcon3");
                return;
            }

            const rows = Array.from(tbody.querySelectorAll("tr"));

            const groupedRows = rows.reduce((groups, row) => {
                const hbnameElement = row.querySelector(
                    ".hbname p:first-child",
                );
                if (!hbnameElement) return groups;

                const hbname = hbnameElement.textContent.trim();
                if (!groups[hbname]) {
                    groups[hbname] = [];
                }
                groups[hbname].push(row);
                return groups;
            }, {});
            Object.keys(groupedRows).forEach((hbname) => {
                groupedRows[hbname].sort((a, b) => {
                    const priceA = parseInt(
                        a
                            .querySelector("td:nth-child(12)")
                            ?.textContent.replace(/,/g, "") || "0",
                    );
                    const priceB = parseInt(
                        b
                            .querySelector("td:nth-child(12)")
                            ?.textContent.replace(/,/g, "") || "0",
                    );

                    if (selectedOption === "저가순") {
                        return priceA - priceB;
                    } else if (selectedOption === "고가순") {
                        return priceB - priceA;
                    }
                    return 0;
                });
            });
            tbody.innerHTML = "";
            Object.keys(groupedRows).forEach((hbname) => {
                groupedRows[hbname].forEach((row) => tbody.appendChild(row));
            });
        }
    });


    $('.datepicker').each(function(index, elem) {
        const fp = flatpickr(elem, {
            dateFormat: "Y-m-d",
            minDate: "2024-01-01",
            static: true,
            appendTo: elem.parentNode,
            onClose: function(selectedDates, dateStr, instance) {
                instance.element.blur();
            }
        });

        $('.calicon').eq(index).on('click', function(e) {
            e.preventDefault();
            fp.open();
        });


    });

    // popup box popup기능
    // 팝업 설정 배열
   const popupConfig = [
        { openBtns: ".machingOption", popup: ".machingPopCon", closeBtn: ".closeMachingPop" },
        { openBtns: ".bestmore", popup: ".bestpop", closeBtn: ".closepop" },
        { openBtns: ".addcart", popup: ".cartpopcon", closeBtn: ".closecart" },
       { openBtns: ".addcart", popup: ".cartpopcon", closeBtn: ".closecart" }

    ];

    popupConfig.forEach((config) => {
        const openButtons = document.querySelectorAll(config.openBtns);
        const popup = document.querySelector(config.popup);
        const closeButton = document.querySelector(config.closeBtn);

        openButtons.forEach((button) => {
            button.addEventListener("click", () => {
                popup.style.display = "block";
            });
        });

        closeButton.addEventListener("click", () => {
            popup.style.display = "none";
        });

        window.addEventListener("click", function (event) {
            if (event.target == popup) {
                popup.style.display = "none";
            }
        });
    });
});
