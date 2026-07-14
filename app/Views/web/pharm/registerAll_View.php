<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>
<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>
<!-- ckeditor ----------------------------  -->
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"> </script>


<section class="merright">
    <div class="merright1-0">

    </div>
    <div class="rightBox merright1-1 merallbox1-1">
        <p>상품일괄등록</p>
        <div class="merallbtnbox">
            <div>
                <button class="itemFilter">원산지</button>
                <button class="itemFilter">택배사 코드</button>
                <button class="itemFilter">약재 코드</button>
                <button class="itemFilter">에러 코드</button>
            </div>
            <div>
                <button class="itemFilter">이미지 업로드</button>
                <button class="itemFilter">엑셀 업로드</button>
                <button class="itemFilter">양식 다운로드</button>
            </div>
        </div>
    </div>
    <div class="rightBox merallbox1-2">
        <p>처리상태</p>
        <div class="meralltablebox">
            <table class="meralltable">
                <thead> 
                    <tr class="merAllTtl1-1">
                       <td class="merlirow">번호</td>
                        <td class="meralltd merRegisterStatus merlirow">상태</td>
                        <td class="merlirow">사유</td>
                        <td class="merlirow">약재명</td>
                        <td class="merlirow">원산지</td>
                        <td class="merlirow">구분</td>
                        <td class="merlirow">가공방법</td>
                        <td class="merlirow">규격</td>
                        <td class="merlirow">근당가격</td>
                        <td class="merlirow">포장가격</td>
                        <td class="merlirow">비고</td>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td>1</td>
                        <td class="merRegisterStatus merFailed">실패</td>
                        <td>ER01</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    <td>2</td>
                        <td class="merRegisterStatus merFailed">실패</td>
                        <td>ER00</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                    <td>3</td>
                        <td class="merRegisterStatus merPassed">성공</td>
                        <td>ER00</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                      <td>4</td>
                        <td class="merRegisterStatus merPassed">성공</td>
                        <td>ER00</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--    <div class="merrightlast">-->
    <!--        <button>취소</button>-->
    <!--        <button>확인</button>-->
    <!--    </div>-->
</section>

<?= $this->endSection() ?>
