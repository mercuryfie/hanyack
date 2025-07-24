 <?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>
<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>
 <!-- js ----------------------------  -->
<script src="<?=URL_PHARM_ASSETS?>/burkOrder_Do.js?rnd=<?= rand(); ?>"></script>
<script>
</script>
<form id="regForm" method="post" onsubmit="return false">
    <input type="hidden" name="p_uid" id="p_uid" value="<?=$body['uid'];?>" />
    <input type="hidden" name="micode" id="micode" value="<?=$body['micode'];?>" />
    <input type="hidden" name="mdcode" id="mdcode" />
    <input type="hidden" name="medicode" id="medicode" />
    <input type="hidden" name="mdname" id="mdname" />
    <input type="hidden" name="method" id="method" />
    <input type="hidden" name="buymethod" id="buymethod" value="1" />
    <input type="hidden" name="salemethod" id="salemethod" value="1" />
    <input type="hidden" name="submethod" id="submethod" value="1" />
    <input type="hidden" name="tax" id="tax" value="1" />

    <div class="merright">
        <section class="merright">
            <div class="merright1-0">

            </div>
            <div class="rightBox merright1-1 hbsearch">
                <div class="herbTtl">
                    <p class="must"></p>
                    <p>본초검색</p>
                </div>
                <!-- <p id="HDName"></p> -->

                <div class="herbbtn1-4">
                    <p class="HDName">-</p>
                    <p>ex. "ㄱㅊ" 혹은 "감초"로 검색하십시오. </p>
                </div>
                <div class="col2 idx1-2 btnon">
                    <button onclick="Search_HDMedicine(1,'ㄱ');" type="button">ㄱ</button>
                    <button onclick="Search_HDMedicine(1,'ㄴ');" type="button">ㄴ</button>
                    <button onclick="Search_HDMedicine(1,'ㄷ');" type="button">ㄷ</button>
                    <button onclick="Search_HDMedicine(1,'ㄹ');" type="button">ㄹ</button>
                    <button onclick="Search_HDMedicine(1,'ㅁ');" type="button">ㅁ</button>

                    <button onclick="Search_HDMedicine(1,'ㅂ');" type="button">ㅂ</button>
                    <button onclick="Search_HDMedicine(1,'ㅅ');" type="button">ㅅ</button>
                    <button onclick="Search_HDMedicine(1,'ㅇ');" type="button">ㅇ</button>
                    <button onclick="Search_HDMedicine(1,'ㅈ');" type="button">ㅈ</button>
                    <button onclick="Search_HDMedicine(1,'ㅊ');" type="button">ㅊ</button>

                    <button onclick="Search_HDMedicine(1,'ㅋ');" type="button">ㅋ</button>
                    <button onclick="Search_HDMedicine(1,'ㅌ');" type="button">ㅌ</button>
                    <button onclick="Search_HDMedicine(1,'ㅍ');" type="button">ㅍ</button>
                    <button onclick="Search_HDMedicine(1,'ㅎ');" type="button">ㅎ</button>
                </div>
                <div class="herbbox">
                    <div class="herbbtn1-1">
                        <input type="search" class="searchInput"
                            id="txtHD" name="txtHD" placeholder="검색어 입력 후, 엔터를 누르세요." onfocus="ini_Form1();">
                        <button class="herbtoggle" type="button"> <i class="fas fa-caret-down downbtn"></i></button>
                        <!-- <i class="fa-solid fa-xmark"></i> -->
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
                        <p class="HDName">-</p>
                    </div>
                    <div class="merinfo infotype1">
                        <p class="must"></p>
                        <p>상품명</p>
                        <input type="text" id="o_name" name="o_name" placeholder="ex. 감초" class="herbInput">
                    </div>
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
                        <p>포장단위</p>
                        <select name="o_weight" id="o_weight">
                            <?= $body['option3']; ?>
                        </select>
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
            <div class="rightBox merright1-4 priceInfoBox">
                <p class="headtitle">판매 정보</p>
                <div class="buy_type_wrap" id="buyWrap" name="buyWrap">
                    <div class="buy_type">
                        <p class="notmust"></p>
                        <p class="title">구매방법</p>
                        <a href="#" onclick="" class="title2">일반구매</a>
                    </div>
                    <div class="option_box" id="optionBox" name="optionBox">
                        <div class="option_type">
                            <p class="mustStyle must"></p>
                            <p class="title">근당가격</p>
                            <input type="text" name="" id="" placeholder="숫자만입력" class="inputType240">
                        </div>
                        <div class="option_type">
                            <p class="mustStyle must"></p>
                            <p class="title">포장가격</p>
                            <input type="text" name="" id="" placeholder="숫자만입력" class="inputType240">
                        </div>
                        <div class="option_type">
                            <p class="mustStyle must"></p>
                            <p class="title">재고수량</p>
                            <input type="text" name="" id="" placeholder="숫자만입력" class="inputType240">
                        </div>
                    </div>
                </div>
                <div class="buy_type_wrap">
                    <div class="buy_type">
                        <p class="notmust"></p>
                        <p class="title">구매방법 추가</p>
                        <a href="#" onclick="" class="title2">정기구독</a>
                        <input type="checkbox" name="addBtn3" id="addBtn3" onchange="" class="inputCheck1">
                    </div>
                </div>
                <div class="buy_type_wrap" id="buyWrap2" name="buyWrap2">
                    <div class="option_box" id="optionBox" name="optionBox">
                        <div class="option_type">
                            <p class="mustStyle must"></p>
                            <p class="title">구독 기간</p>
                            <select name="" id="" class="selectType3">
                                <option value="1" class="" onchange="on_submethod('1')">5개월</option>
                                <option value="2" class=""  selected onchange="on_submethod('2')">6개월</option>
                                <option value="3" class=""  onchange="on_submethod('3')">7개월</option>
                                <option value="4" class=""  onchange="on_submethod('4')">8개월</option>
                                <option value="5" class=""  onchange="on_submethod('5')">9개월</option>
                                <option value="6" class=""  onchange="on_submethod('6')">10개월</option>
                            </select>
                        </div>
                        <div class="option_type">
                            <p class="mustStyle must"></p>
                            <p class="title">근당가격</p>
                            <input type="text" name="" id="" placeholder="숫자만입력" class="inputType240">
                        </div>
                        <div class="option_type">
                            <p class="mustStyle must"></p>
                            <p class="title">포장가격</p>
                            <input type="text" name="" id="" placeholder="숫자만입력" class="inputType240">
                        </div>
                        <div class="option_type">
                            <p class="mustStyle must"></p>
                            <p class="title">재고수량</p>
                            <input type="text" name="" id="" placeholder="숫자만입력" class="inputType240">
                        </div>
                    </div>
                </div>
                <div class="date_wrap">
                    <div class="option_type">
                        <p class="must"></p>
                        <p class="title">제조일자</p>
                        <input type="text" id="makedate" name="makedate" class="datepicker datepicker1-1 d_start inputType160" placeholder="날짜 선택" readonly>
                        <i class="fa-regular fa-calendar calicon" id="calicon1-4" name=""></i>
                    </div>
                    <div class="option_type">
                        <p class="must"></p>
                        <p class="title">유통기한</p>
                        <div class="option_date pribox1-3 btnon"> <!-- 3,2,1년 -->
                            <button onclick="on_method('1');" id="pemethod1" name="pemethod1" type="button" class="btnType1 ">3년</button>
                            <button onclick="on_method('2');" id="pemethod2" name="pemethod2" type="button" class="btnType1 ">2년</button>
                            <button onclick="on_method('3');" id="pemethod3" name="pemethod3" type="button" class="btnType1 ">1년</button>
                            <button onclick="on_method('4');" id="pemethod4" name="pemethod4" type="button" class="btnType1 ">6개월</button>
                        </div>
                    </div>
                    <div class="option_type  ">
                        <p class="notmust"></p>
                        <p class="title"></p>
                        <div class="option_date pribox1-4 mb40"> <!-- 소비기한 -->
                            <input type="text" id="s_date" name="s_date" class="inputType160 datepickers datepicker1-2 d_start" placeholder="날짜 선택" readonly>
                            <i class="fa-regular fa-calendar calicon" id="calicon1-1"></i>
                            <p class="wave">~</p>
                            <input type="text" id="e_date" name="e_date" class="inputType160 datepickers datepicker1-3" placeholder="날짜 선택" readonly>
                            <i class="fa-regular fa-calendar calicon" id="calicon1-2"></i>
                        </div>
                    </div>

                </div>
<!--                <div class="pribox">-->
<!---->
<!--                    <div class="prileft">-->
<!--                        <div class="pridef"> -->
<!---->
<!--                            <p class="must"></p>-->
<!--                            <p class="must"></p>-->
<!--                        </div>-->
<!--                        <div class="prileft1-1"> -->
<!---->
<!--                            <p>제조일자</p>-->
<!--                            <p>유통기한</p>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="priright">-->
<!--                        <div class="pribox1-0">-->
<!--                            <input type="number" id="o_gPrice" name="o_gPrice" min="0" placeholder="숫자만 입력" class="noinput">-->
<!--                        </div>-->
<!--                        <div class="pribox1-1">-->
<!--                            <input type="number" id="o_pPrice" name="o_pPrice" min="0" placeholder="숫자만 입력" class="noinput">-->
<!--                        </div>-->
<!--                        <div class="pribox1-1">-->
<!--                            <input type="number" id="o_stock" name="o_stock" min="0" placeholder="숫자만 입력" class="noinput">-->
<!--                        </div>-->
<!--                        <div class="pribox1-2 btnon">-->
<!--                            <button onclick="on_buymethod('1');" id="buymethod1" name="buymethod1" type="button" class="unchecked">일반구매</button>-->
<!--                            <button onclick="on_buymethod('2');" id="buymethod2" name="buymethod2" type="button" class="unchecked">대량구매</button>-->
<!--                            <button onclick="on_buymethod('3');" id="buymethod3" name="buymethod3" type="button" class="unchecked">정기구독</button>-->
<!--                        </div>-->
<!--                        <div class="pribox1-2 btnon">-->
<!--                            <button onclick="on_salemethod('1');" id="salemethod1" name="salemethod1" type="button" class="unchecked">없음</button>-->
<!--                            <button onclick="on_salemethod('2');" id="salemethod2" name="salemethod2" type="button" class="unchecked">5%</button>-->
<!--                            <button onclick="on_salemethod('3');" id="salemethod3" name="salemethod3" type="button" class="unchecked">10%</button>-->
<!--                        </div>-->
<!--                        <div class="option_date pribox1-6">
<!--                            <input type="text" id="makedate" name="makedate" class="inputType160 datepickers datepicker1-1 d_start" placeholder="날짜 선택" readonly>-->
<!--                            <i class="fa-regular fa-calendar calicon" id="calicon1-4" name=""></i>-->
<!--                        </div>-->
<!--                        <div class="option_date pribox1-3 btnon">
<!--                            <button onclick="on_method('1');" id="pemethod1" name="pemethod1" type="button" class="btnType1 ">3년</button>-->
<!--                            <button onclick="on_method('2');" id="pemethod2" name="pemethod2" type="button" class="btnType1 ">2년</button>-->
<!--                            <button onclick="on_method('3');" id="pemethod3" name="pemethod3" type="button" class="btnType1 ">1년</button>-->
<!--                            <button onclick="on_method('4');" id="pemethod4" name="pemethod4" type="button" class="btnType1 ">6개월</button>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <div class="rightBox merright1-5">
                <p>상세 정보</p>
                <div class=" infotype6 merimg">
                    <p class="must"></p>
                    <p>대표이미지</p>
                    <div class="imgattach">
                        <div class="imagePreview" id="mainarea" name="mainarea" data-ext="jpg,jpeg,png,gif">
                            <span class="default-message">+</span>
                            <span class="default-message">이곳에 파일을 가져다 놓으십시오.</span>
                        </div>
                        <label for="mainimg" class="custom-upload-btn">파일 선택</label>
                        <input type="file" id="mainimg" name="mainimg" accept="image/*" style="display: none">
                    </div>
                </div>
                <div class=" infotype7">
                    <p class="notmust"></p>
                    <p>첨부파일<br>(시험성적서 PDF)</p>
                    <div class="imgattach">
                        <div class="imagePreview" id="attacharea" name="attacharea" data-ext="pdf">
                            <span class="default-message">+</span>
                            <span class="default-message">이곳에 파일을 가져다 놓으십시오.</span>
                        </div>
                        <label for="attachimg" class="custom-upload-btn">파일 선택</label>
                        <input type="file" id="attachimg" name="attachimg" accept="application/pdf" style="display: none">
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
                <div class="ifbox infotype9">
                    <p class="notmust"></p>
                    <p>옵션</p>
                    <div class="proop">
                        <input type="checkbox" name="unuse" id="unuse" checked>
                        <label for="unuse">이전 생산 약재 비활성화하기</label>
                    </div>
                </div>
            </div>
            <div class="lastBox">
                <button type="button" class="btnType3">취소</button>
                <button type="button" id="submitBtn" name="submitBtn" class="btnType4">확인</button>
            </div>
        </section>
    </div>
</form>

 
<?= $this->endSection() ?>