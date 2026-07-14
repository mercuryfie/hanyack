<?= $this->extend("/web/template/layout_mypage_phar") ?>
<?= $this->section("content") ?>
<!-- calendar ----------------------------  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"> </script>
<!-- ckeditor ----------------------------  -->
<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
<!-- js ----------------------------  -->
<script src="<?=URL_PHARM_ASSETS?>/herb_Edit_Do.js?rnd=<?= rand(); ?>"></script>
<script src="<?=URL_PHARM_ASSETS?>/register.js?rnd=<?= rand(); ?>"></script>
<script>
</script>
<!-- --><?php //print_r($body)?>
<form id="regForm" method="post" onsubmit="return false">
    <input type="hidden" name="p_uid" id="p_uid" value="<?=$body['uid'];?>" />
    <!--    <input type="hidden" name="micode" id="micode" value="--><?php //=$body['micode'];?><!--" />-->
    <input type="hidden" name="mdcode" id="mdcode" />
    <input type="hidden" name="medicode" id="medicode" />
    <input type="hidden" name="mdname" id="mdname" />
    <input type="hidden" name="method" id="method" />

    <div class="merright">
        <section class="merright">
            <div class="merright1-0">

            </div>

            <div class="rightBox merright1-3">
                <p>상품 정보</p>
                <div class="infobox">
                    <div class="merinfo infotype1" >
                        <p class="must"></p>
                        <p>약재코드</p>
                        <span><?=$body['data']['hn_code']?></span>
                    </div>
                    <div class="merinfo infotype1" >
                        <p class="must"></p>
                        <p>본초명</p>
                        <span><?=$body['data']['hn_name']?> (<?=$body['data']['fk_mdcode']?>)</span>
                    </div>
                    <div class="merinfo infotype2">
                        <p class="must"></p>
                        <p>약재명</p>
                        <span><?=$body['data']['fk_mdname']?></span>
                    </div>
                    <div class="merinfo infotype2">
                        <p class="notmust"></p>
                        <p class="">구분</p>
                        <span><?=$body['data']['t1_value']?></span>
                    </div>
                    <div class="merinfo infotype4">
                        <p class="notmust"></p>
                        <p>가공방법</p>
                        <select name="o_option2" id="o_option2">
                            <?=$body['option2'];?>
                        </select>
                    </div>

                    <div class="merinfo infotype4">
                        <p class="must"></p>
                        <p>포장단위</p>
                        <select name="fk_wcode" id="fk_wcode">
                            <?=$body['option3'];?>
                        </select>
                    </div>
                    <div class="merinfo infotype5">
                        <p class="must"></p>
                        <p>원산지</p>
                        <select name="n_key" id="n_key">
                            <?=$body['nation'];?>
                        </select>
                    </div>
                </div>
                <div class="date_wrap">
                    <div class="option_type">
                        <p class="must"></p>
                        <p class="title">제조일자</p>
                        <input type="text" id="makedate" name="makedate" class="datepicker datepicker1-1 d_start inputType160" placeholder="날짜 선택" readonly
                               value="<?= date('Y-m-d', strtotime($body['data']['hn_sellSDate'])); ?>">
                        <i class="fa-regular fa-calendar calicon" id="calicon1-4" name=""></i>
                    </div>
                    <div class="option_type">
                        <p class="must"></p>
                        <p class="title">유통기한</p>
                        <div class="option_date pribox1-3 btnon"> <!-- 3,2,1년 -->
                            <button onclick="on_method('1');" id="pemethod1" name="pemethod1" type="button" class="btnType1 " data-value="1">3년</button>
                            <button onclick="on_method('2');" id="pemethod2" name="pemethod2" type="button" class="btnType1 " data-value="2">2년</button>
                            <button onclick="on_method('3');" id="pemethod3" name="pemethod3" type="button" class="btnType1 " data-value="3">1년</button>
                            <button onclick="on_method('4');" id="pemethod4" name="pemethod4" type="button" class="btnType1 " data-value="4">6개월</button>
                            <input type="hidden" name="hn_DateMethod" id="hn_DateMethod" value="<?=$body['data']['hn_DateMethod']?>">
                        </div>
                    </div>
                    <div class="option_type  ">
                        <p class="notmust"></p>
                        <p class="title"></p>
                        <div class="option_date pribox1-4 mb40"> <!-- 소비기한 -->
                            <input type="text" id="s_date" name="s_date" class="inputType160 datepickers datepicker1-2 d_start" placeholder="날짜 선택"
                                   value="<?= date('Y-m-d', strtotime($body['data']['hn_sellSDate'])); ?>" readonly>
                            <i class="fa-regular fa-calendar calicon" id="calicon1-1"></i>
                            <p class="wave">~</p>
                            <input type="text" id="e_date" name="e_date" class="inputType160 datepickers datepicker1-3" placeholder="날짜 선택"
                                   value="<?= date('Y-m-d', strtotime($body['data']['hn_sellEDate'])); ?>" readonly>
                            <i class="fa-regular fa-calendar calicon" id="calicon1-2"></i>
                        </div>
                    </div>

                </div>
            </div>
            <div class="rightBox merright1-4 priceInfoBox">
                <p class="headtitle">판매 정보</p>
                <div class="buy_type_wrap" id="buyWrap" name="buyWrap">
                    <div class="buy_type">
                        <p class="notmust"></p>
                        <p class="title">구매방법</p>
                        <p class="title2">일반구매</p>
                    </div>
                    <div class="option_box" id="optionBox" name="optionBox">
                        <div class="option_type">
                            <p class="mustStyle must"></p>
                            <p class="title">근당가격</p>
                            <input type="text" id="hn_gPrice_1" name="hn_gPrice_1" placeholder="숫자만 입력" class="inputType160" value="<?= $body['price'][0]['hn_gPrice']; ?>" >원
                        </div>
                        <div class="option_type">
                            <p class="mustStyle must"></p>
                            <p class="title">포장가격</p>
                            <input type="text" id="hn_pPrice_1" name="hn_pPrice_1" placeholder="숫자만 입력" class="inputType160" value="<?= $body['price'][0]['hn_pPrice'];?>" readonly>원
                        </div>
                        <div class="option_type">
                            <p class="mustStyle must"></p>
                            <p class="title">재고수량</p>
                            <input type="text" id="hn_stock_1" name="hn_stock_1" placeholder="숫자만 입력" class="inputType160" value="<?= $body['price'][0]['hn_stock'];?>">
                        </div>
                    </div>
                </div>
                <div class="buy_type_wrap">
                    <div class="buy_type">
                        <p class="notmust"></p>
                        <p class="title">구매방법2</p>
                        <p class="title2">정기구독</p>
                        <input type="checkbox" name="hn_add_2" id="hn_add_2" class="inputCheck1" <?if($body['price'][1]['hn_method']==2) echo('value="1" checked');?>>
                    </div>
                </div>
                <div class="buy_type_wrap" id="buyWrap2" name="buyWrap2" <?if($body['price'][1]['hn_method']==2) echo('style="display: block;');?>">
                <div class="option_box" id="optionBox" name="optionBox">
                    <div class="option_type">
                        <p class="mustStyle must"></p>
                        <p class="title">구독 기간</p>
                        <select name="hn_period" id="hn_period" class="selectType3">
                            <option value="5" <?if($body['price'][1]['hn_period']==5) echo('selected');?>>5개월</option>
                            <option value="6" <?if($body['price'][1]['hn_period']==6) echo('selected');?>>6개월</option>
                            <option value="7" <?if($body['price'][1]['hn_period']==7) echo('selected');?>>7개월</option>
                            <option value="8" <?if($body['price'][1]['hn_period']==8) echo('selected');?>>8개월</option>
                            <option value="9" <?if($body['price'][1]['hn_period']==9) echo('selected');?>>9개월</option>
                            <option value="10" <?if($body['price'][1]['hn_period']==10) echo('selected');?>>10개월</option>
                        </select>
                    </div>
                    <div class="option_type">
                        <p class="mustStyle must"></p>
                        <p class="title">근당가격</p>
                        <input type="text" name="hn_gPrice_2" id="hn_gPrice_2" placeholder="숫자만입력" class="inputType240" value="<?= $body['price'][1]['hn_gPrice']; ?>" >원
                    </div>
                    <div class="option_type">
                        <p class="mustStyle must"></p>
                        <p class="title">포장가격</p>
                        <input type="text" name="hn_pPrice_2" id="hn_pPrice_2" placeholder="숫자만입력" class="inputType240" value="<?= $body['price'][1]['hn_pPrice'];?>" readonly>원
                    </div>
                </div>
            </div>
            <div class="buy_type_wrap">
                <div class="buy_type">
                    <p class="notmust"></p>
                    <p class="title">구매방법3</p>
                    <p class="title2">대량구매</p>
                    <input type="checkbox" name="hn_add_3" id="hn_add_3" class="inputCheck1" <?if($body['price'][2]['hn_method']==3) echo('value="1" checked');?>>
                </div>
            </div>
            <div class="buy_type_wrap" id="buyWrap3" name="buyWrap3" <?if($body['price'][2]['hn_method']==3) echo('style="display: block;');?>">
            <div class="option_box" id="optionBox" name="optionBox">
                <div class="option_type">
                    <p class="mustStyle must"></p>
                    <p class="title">판매 단위</p>
                    <input type="text" name="hn_sellmethod" id="hn_sellmethod" placeholder="예) 1파레트" class="inputType240" value="<?= $body['price'][2]['hn_sellmethod']; ?>" >
                </div>
                <div class="option_type">
                    <p class="mustStyle must"></p>
                    <p class="title">총 무게</p>
                    <input type="text" name="hn_weight" id="hn_weight" placeholder="예) 10,000kg" class="inputType240" value="<?= $body['price'][2]['hn_weight']; ?>" >
                </div>
                <div class="option_type">
                    <p class="mustStyle must"></p>
                    <p class="title">가격</p>
                    <input type="text" name="hn_pPrice_3" id="hn_pPrice_3" placeholder="숫자만입력" class="inputType240" value="<?= $body['price'][2]['hn_pPrice']; ?>" >원
                </div>
            </div>
    </div>
    </div>
    <div class="rightBox merright1-5">
        <p>상세 정보</p>
        <div class=" infotype6 merimg">
            <p class="must"></p>
            <p>대표이미지</p>
            <div class="imgattach">
                <?if($body['fname']['img']!=''){?>
                    <div class="imgThum" id="orgImageView" name="orgImageView">
                        <button class="delete-btn">×</button>
                        <img src="/assets/product/image/<?=$body['fname']['img']?>" alt="" class="thumbnail">
                        <span class="filename"><?=$body['fname']['img']?></span>
                    </div>
                <?}?>
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
                <?if($body['fname']['data']!=''){?>
                    <div class="imgThum" id="orgImageView" name="orgImageView">
                        <button class="delete-btn">×</button>
                        <img src="/assets/product/image/<?=$body['fname']['data']?>" alt="" class="thumbnail">
                        <span class="filename"><?=$body['fname']['data']?></span>
                    </div>
                <?}?>
                <div class="imagePreview" id="mainarea" name="mainarea" data-ext="jpg,jpeg,png,gif">
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
                    <?=$body['data']['hn_desc']?>
                </div>
                <textarea id="editor_data" name="editor_data" class="ckTextArea" style="display: none;"  >
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