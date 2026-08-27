
$(document).ready(function() {
    // calendar --------------
    const datepickers = document.querySelectorAll(".datepicker");
    const calIcons = document.querySelectorAll(".calicon");

    datepickers.forEach((datepicker, index) => {
        let options = {
            dateFormat: "Y-m-d",
            static: true,
            appendTo: datepicker.parentNode,
            onClose: function (selectedDates, dateStr, instance) {
                instance.element.blur();
            },
        };

        if (datepicker.closest(".datepicker1-1") ||
            datepicker.closest(".datepicker1-2")
        ) { options.minDate = null; // 특정 조건에 따라 minDate 설정
        } else {
            options.minDate = "today";
        }

        const fp = flatpickr(datepicker, options);

        calIcons[index].addEventListener("click", function (e) {
            e.preventDefault();
            fp.toggle();
        });
    });



    //thumnail
    class FileUploadHandler {
        constructor(container) {
            this.container = container;
            this.preview = container.querySelector('.imagePreview');
            this.fileInput = container.querySelector('input[type="file"]');
            this.initEvents();
        }

        initEvents() {
            // 드래그 앤 드롭 이벤트
            this.container.addEventListener('dragover', (e) => this.handleDragOver(e));
            this.container.addEventListener('dragleave', () => this.resetStyle());
            this.container.addEventListener('drop', (e) => this.handleDrop(e));

            // 파일 선택 이벤트
            this.fileInput.addEventListener('change', (e) => this.handleFileSelect(e));
        }

        handleDragOver(e) {
            e.preventDefault();
            this.container.style.backgroundColor = '#f0f0f0';
            this.container.style.border = '2px dashed #000';
        }

        resetStyle() {
            this.container.style.backgroundColor = '';
            this.container.style.border = '1px solid #ccc';
        }

        handleDrop(e) {
            e.preventDefault();
            this.resetStyle();
            this.fileInput.files = e.dataTransfer.files;
            this.previewFiles(this.fileInput.files);
        }

        handleFileSelect(e) {
            this.previewFiles(e.target.files);
        }

        previewFiles(files) {
            this.preview.innerHTML = '';
            this.preview.classList.add('has-files');
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const fileType = file.type.split('/')[0];
                    const previewItem = this.createPreviewItem(file, e.target.result, fileType);
                    this.preview.appendChild(previewItem);
                };
                reader.readAsDataURL(file);

                if(files.length === 0) {
                    this.preview.classList.remove('has-files');
                    this.preview.innerHTML = `
            <span class="default-message">+</span>
            <span class="default-message">이곳에 파일을 가져다 놓으십시오.</span>
          `;
                    }
            });
        }

    createPreviewItem(file, dataUrl, fileType) {
            $('#orgImageView').remove();

            const item = document.createElement('div');
            item.className = 'preview-item';

            // 이미지/PDF 아이콘 분기 처리
            if (fileType === 'image') {
                item.innerHTML = `
        <img src="${dataUrl}" alt="${file.name}" class="thumbnail">
        <div class="file-meta">
          <span>${file.name}</span>
          <button class="delete-btn">×</button>
        </div>
      `;
            } else {
                item.innerHTML = `
        <div class="file-icon">📄</div>
        <div class="file-meta">
          <span>${file.name}</span>
          <button class="delete-btn">×</button>
        </div>
      `;
            }

            // 삭제 버튼 이벤트
            item.querySelector('.delete-btn').addEventListener('click', () => {
                item.remove();
                this.fileInput.value = '';

                const remainingFiles = this.preview.querySelectorAll('.preview-item').length;
                if(remainingFiles === 0) {
                    this.preview.classList.remove('has-files');
                    this.preview.innerHTML = `
          <span class="default-message">+</span>
          <span class="default-message">이곳에 파일을 가져다 놓으십시오.</span>
        `;
                }
            });

            return item;
        }
    }

// 초기화 코드
    document.querySelectorAll('.imgattach').forEach(container => {
        new FileUploadHandler(container);
    });
});

