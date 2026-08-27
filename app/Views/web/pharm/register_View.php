<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"> </script>
<script src="<?=URL_PHARM_ASSETS?>/register_Do.js?rnd=<?= rand(); ?>"></script>
<script>
</script>
<form id="regForm" method="post" onsubmit="return false">
    <?if(fn_ArrayCnt($body['info'])>0){?>
        <input type="hidden" name="rCode" id="rCode" value="<?=$body['info']['code'];?>" />
        <input type="hidden" name="mdcode" id="mdcode" value="<?=$body['info']['mdcode'];?>" />
        <input type="hidden" name="medicode" id="medicode" value="<?=$body['info']['medicode'];?>" />
        <input type="hidden" name="mdname" id="mdname" value="<?=$body['info']['mdname'];?>" />
    <?}else{?>
        <input type="hidden" name="rCode" id="rCode" />
        <input type="hidden" name="mdcode" id="mdcode" />
        <input type="hidden" name="medicode" id="medicode" />
        <input type="hidden" name="mdname" id="mdname" />
    <?}?>
    <input type="hidden" name="p_uid" id="p_uid" value="<?=$body['uid'];?>" />
    <input type="hidden" name="micode" id="micode" value="<?=$body['micode'];?>" />
    <input type="hidden" name="method" id="method" />


    <div class="merright ">
        <section class="merright herbRegister">
            <div class="merright1-0">
            </div>
            <div class="rightBox merright1-1 hbsearch">
                <div class="herbTtl">
                    <p class="must"></p>
                    <p>본초검색</p>
                </div>

                <div class="herbbtn1-4">
                    <p class="HDName" id="tHdName">-</p>
                    <p>약재명으로 검색하세요.</p>
                </div>
                <div class="col2 idx1-2 btnon">
                    <button name="btnSearchHD" data-word="ㄱ" type="button" class="btn_cho">ㄱ</button>
                    <button name="btnSearchHD" data-word="ㄴ"  type="button" class="btn_cho">ㄴ</button>
                    <button name="btnSearchHD" data-word="ㄷ" type="button" class="btn_cho">ㄷ</button>
                    <button name="btnSearchHD" data-word="ㄹ"  type="button" class="btn_cho">ㄹ</button>
                    <button name="btnSearchHD" data-word="ㅁ" type="button" class="btn_cho">ㅁ</button>

                    <button name="btnSearchHD" data-word="ㅂ" type="button" class="btn_cho">ㅂ</button>
                    <button name="btnSearchHD" data-word="ㅅ" type="button" class="btn_cho">ㅅ</button>
                    <button name="btnSearchHD" data-word="ㅇ"type="button" class="btn_cho">ㅇ</button>
                    <button name="btnSearchHD" data-word="ㅈ" type="button" class="btn_cho">ㅈ</button>
                    <button name="btnSearchHD" data-word="ㅊ" type="button" class="btn_cho">ㅊ</button>

                    <button name="btnSearchHD" data-word="ㅋ" type="button" class="btn_cho">ㅋ</button>
                    <button name="btnSearchHD" data-word="ㅌ" type="button" class="btn_cho">ㅌ</button>
                    <button name="btnSearchHD" data-word="ㅍ" type="button" class="btn_cho">ㅍ</button>
                    <button name="btnSearchHD" data-word="ㅎ" type="button" class="btn_cho">ㅎ</button>
                </div>
                <div class="herbbox">
                    <div class="herbbtn1-1">
                        <input type="search" class="searchInput"
                            id="txtHD" name="txtHD" placeholder="검색어 입력 후, 엔터를 누르세요." onfocus="ini_Form1();">
                        <button class="herbtoggle" type="button"><i class="fas fa-caret-down downbtn"></i></button>

                    </div>
                    <div class="herbbtn1-2" id="HD_List">
                    </div>
                </div>
            </div>
            <div class="rightBox merright1-2">
                <p>약재 복사</p>
                <div class="tempbox">
                    <div class="tempbtn1-1">
                        <button class="selectedtemp" type="button" id="hdlist_cmt" name="hdlist_cmt" onclick="show_HDList2();">본초를 검색하세요.</button>
                        <button class="temptoggle" type="button" id="hdlist2_tog" name="hdlist2_tog" onclick="show_HDList2();"> <i class="fas fa-caret-down"></i></button>
                    </div>
                    <div class="tempbtn1-2" id="HD_List2">
                    </div>
                </div>
            </div>
            <div class="rightBox merright1-3">
                <p>상품 정보</p>
                <div class="infobox">
                    <div class="merinfo infotype0">
                        <p class="must"></p>
                        <p>본초명</p>
                        <p class="HDName" id="HDName">-</p>
                    </div>
                    <div class="merinfo infotype1">
                        <p class="must"></p>
                        <p>약재명</p>
                        <input type="search" id="o_name" name="o_name" placeholder="" class="inputType240">
                    </div>
                    <div class="merinfo infotype1">
                        <p class="must"></p>
                        <p>원재료명</p>
                        <input type="search" id="m_name" name="m_name" placeholder="" class="inputType240">
<!--                        <div class="dd">-->
<!--                            -->
<!--                        </div>-->
                    </div>
<!--                    <div class="merinfo infotype1">-->
<!--                        <p class="must"></p>-->
<!--                        <p>제조번호</p>-->
<!--                        <input type="search" id="o_number" name="o_number" placeholder="" class="inputType240">-->
<!--                    </div>-->
                    <div class="merinfo infotype2">
                        <p class="must notmust"></p>
                        <p>구분</p>
                        <select name="gubun1" id="gubun1">
                            <option value="">본초를 검색하세요.</option>
                        </select>
                    </div>
                    <div class="merinfo infotype3">
                        <p class="must notmust"></p>
                        <p>가공방법</p>
                        <select name="o_option2" id="o_option2">
                            <?= $body['option2']; ?>
                        </select>
                    </div>
                    <div class="merinfo infotype4">
                        <p class="must"></p>
                        <p>개당무게</p>
                        <select name="o_weight" id="o_weight"  >
                            <?= $body['option3']; ?>
                        </select>
                    </div>
                    <div class="merinfo infotype4">
                        <p class="must"></p>
                        <p>포장타입</p>
                        <select name="hnPackageType" id="hnPackageType"  >
                            <option value="">선택하세요.</option>
                            <option value="1">개별</option>
                            <option value="2">Box</option>
                        </select>
                    </div>
                    <div class="merinfo infotype4" id="hnPCntArea" style="display: none;">
                        <p class="notmust"></p>
                        <p>포장기본수량</p>
                        <input type="number" id="hnPackageCnt" name="hnPackageCnt" placeholder="숫자만입력" class="inputType240">
                        <p class="unit ml10 ">개</p>
                    </div>
                    <div class="merinfo infotype5">
                        <p class="must"></p>
                        <p>원산지</p>
                        <select name="o_nation" id="o_nation">
                            <?= $body['nation']; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="rightBox merright1-5">
                <p>상세 정보</p>
                <div class=" infotype6 merimg">
                    <p class="must"></p>
                    <p>대표이미지</p>
                    <div class="thum_taker_box" id="thum_wrap" name="thum_wrap">
                        <label for="attachImg" class="photo-picker">
                            <input class="" type="file" name="attachImg" id="attachImg" multiple style="" data-ext="jpg,jpeg,png,gif" accept="image/jpeg, image/jpg, image/png, image/gif">
                            <i class="fa-solid fa-camera"></i>
                        </label>
                    </div>
                    <div id="thumbArea" name="thumbArea" class="thum_arange">
                    </div>
                </div>
                <div class="ifbox infotype8">
                    <p class="notmust"></p>
                    <p>상세설명</p>
                        <div class="infodetail">
                            <div id="ckeditor" class="infockeditor">
                            </div>
                            <textarea id="editor_data" name="editor_data" class="ckTextArea" style="display: none;">
                            </textarea>
                        </div>
                </div>
            </div>
            <div class="lastBox mr20">
                <button type="button" class="btnType3">취소</button>
                <button type="button" id="submitBtn" name="submitBtn" class="btnType4">확인</button>
            </div>
        </section>
    </div>
</form>

 
<?= $this->endSection() ?>