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
 <script src="<?=URL_PHARM_ASSETS?>/herb_Edit.js?rnd=<?= rand(); ?>"></script>
<script src="<?=URL_PHARM_ASSETS?>/register.js?rnd=<?= rand(); ?>"></script>
<script>
</script>
<form id="editForm" method="post" onsubmit="return false">
    <input type="hidden" name="p_uid" id="p_uid" value="<?=$body['uid'];?>" />
    <input type="hidden" name="hncode" id="hncode" value="<?=$body['data']['hn_code'];?>" />
    <input type="hidden" name="w_value" id="w_value" value="<?=$body['data']['w_value'];?>" />
    <!--ㅇㅇ -->
    <div class="merright">
        <section class="merright">
            <div class="merright1-0">

            </div>

            <div class="rightBox  herb_modifier_wrap">
                 <div class="firstBox">
                     <div class="head_title flexStart">
                         <p class="must"></p>
                         <p class="title">기본 정보</p>

                     </div>
                     <div class="infobox">
                         <div class="merinfo infotype1 flexType3" >
                             <div class="flexType2 mr10">
                                 <p class="title">약재코드</p>
                                 <span><?=$body['data']['hn_code']?></span>
                             </div>
                             <button type="button" class="btnType1" onclick="go_herbReg_settingData('<?=$body['data']['hn_code']?>');">생산 등록</button>
                         </div>
                         <div class="merinfo infotype1" >
                             <p class="title">본초명</p>
                             <span><?=$body['data']['fk_mdname']?> (<?=$body['data']['fk_mdcode']?>)</span>
                         </div>
                         <div class="merinfo infotype2">
                             <p class="title">약재명</p>
                             <span><?=$body['data']['hn_name']?></span>
                         </div>
                         <div class="merinfo infotype2">
                             <p class="title">제조번호</p>
                             <span><?=$body['data']['hn_number']?></span>
                         </div>
                         <div class="merinfo infotype2">
                             <p class="title">구분</p>
                             <span><?= ($body['data']['t1_value']!='') ? $body['data']['t1_value'] : '-'; ?></span>
                         </div>
                         <div class="merinfo infotype4">
                             <p class="title">가공방법</p>
                             <span><?=$body['data']['t2_value']?></span>
                         </div>
                         <div class="merinfo infotype4">
                             <p class="title">포장단위</p>
                             <span><?=$body['data']['w_name']?></span>
                         </div>
                         <div class="merinfo infotype4">
                             <p class="title">박스당갯수</p>
                             <span><?=$body['data']['hn_boxCnt']?>개</span>
                         </div>
                         <div class="merinfo infotype5">
                             <p class="title">원산지</p>
                             <span><?=$body['data']['n_value']?></span>
                         </div>
                         <div class="merinfo infotype5">
                             <p class="title">제조일자</p>
                             <p class="date"><?= date('Y-m-d', strtotime($body['data']['hn_sellSDate'])); ?></p>
                         </div>
                         <div class="merinfo infotype5 mb40">
                             <p class="title">유통기한</p>
                             <p class="date"><?= date('Y-m-d', strtotime($body['data']['hn_sellEDate'])); ?></p>
                         </div>
                     </div>
                 </div>
                <div class="secondBox">
                    <div class="rightBox priceInfoBox ">
                        <p class="headtitle">판매 정보</p>
                        <div class="buy_type_wrap " id="buyWrap" name="buyWrap">
                            <div class="buy_type">
                                <p class="notmust"></p>
                                <p class="title">구매방법</p>
                                <p class="title2">일반구매</p>
                            </div>
                            <div class="option_box" id="optionBox" name="optionBox">
                                <div class="option_type">
                                    <p class="mustStyle must"></p>
                                    <p class="title">근당가격</p>
                                    <input type="text" id="hn_gPrice_1" name="hn_gPrice_1" placeholder="숫자만 입력" class="inputType160" value="<?= $body['price'][0]['hn_gPrice']; ?>" >
                                    <p class="unit">원</p>

                                </div>
                                <div class="option_type">
                                    <p class="mustStyle must"></p>
                                    <p class="title">포장가격</p>
                                    <input type="text" id="hn_pPrice_1" name="hn_pPrice_1" placeholder="숫자만 입력" class="inputType160" value="<?= $body['price'][0]['hn_pPrice'];?>" readonly>
                                    <p class="unit">원</p>
                                </div>
                                <div class="option_type">
                                    <p class="mustStyle must"></p>
                                    <p class="title">재고수량</p>
                                    <input type="text" id="hn_stock_1" name="hn_stock_1" placeholder="숫자만 입력" class="inputType160" value="<?= $body['price'][0]['hn_stock'];?>">
                                    <p class="unit">개</p>
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
                                <input type="text" name="hn_gPrice_2" id="hn_gPrice_2" placeholder="숫자만입력" class="inputType240" value="<?= $body['price'][1]['hn_gPrice']; ?>" >
                                <p class="unit">원</p>
                            </div>
                            <div class="option_type">
                                <p class="mustStyle must"></p>
                                <p class="title">포장가격</p>
                                <input type="text" name="hn_pPrice_2"
                                       id="hn_pPrice_2" placeholder="숫자만입력"
                                       class="inputType240"
                                       value="<?= $body['price'][1]['hn_pPrice'];?>"
                                       readonly>
                                <p class="unit">원</p>
                            </div>
                        </div>
                    </div>
                    <div class="buy_type_wrap">
                        <div class="buy_type">
                            <p class="notmust"></p>
                            <p class="title">대량구매</p>
                            <label for="burkOrder" class="burk_order_box">
                                <input type="radio" name="hn_bigsell" id="hn_bigsell" class="burkOrderType" value="1" <?if($body['data']['hn_bigsell']==1) echo('checked');?>>예
                                <input type="radio" name="hn_bigsell" id="hn_bigsell" class="burkOrderType2" value="0" <?if($body['data']['hn_bigsell']==0) echo('checked');?>>아니오
                            </label>
                        </div>
                    </div>

                    <div class="detBox">
                        <div class=" infotype6 merimg">
                            <p class="must"></p>
                            <p>대표이미지</p>

                            <div class="thum_taker_box" id="thum_wrap" name="thum_wrap">
                                <label for="attachImg" class="photo-picker"
                                       data-ext="jpg,jpeg,png,gif"
                                       accept="application/jpeg">
                                    <input class="" type="file" name="attachImg" id="attachImg" multiple style="" data-ext="jpg,jpeg,png,gif" accept="image/jpeg, image/jpg, image/png, image/gif">
                                    <i class="fa-solid fa-camera"></i>
                                </label>
                            </div>
                            <div id="thumbArea" name="thumbArea" class="thum_arange">
                                <?if($body['fname']['img']!=''){?>
                                    <div class="thumCon" id="" name="">
                                        <div class="thumBox" name="thumPreview">
                                        <button class="delete-btn" type="button" id="deleteBtn" name="deleteBtn">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <img src="/assets/product/image/<?=$body['fname']['img']?>" alt="img" class="addedImg">
                                        </div>
                                        <p class="file-name"><?=$body['fname']['img']?></p>
                                    </div>
                                <?}?>
                            </div>
                        </div>
                        <div class=" infotype7">
                            <p class="notmust"></p>
                            <p>첨부파일<br>(시험성적서 PDF)</p>
                            <div class="thum_taker_box" id="thum_wrap2" name="thum_wrap2">
                                <label for="attachFile" class="photo-picker"
                                       data-ext="pdf">
                                    <input class="" accept="application/pdf" type="file" name="attachFile" id="attachFile" multiple style="" data-ext="pdf" accept="application/pdf">
                                    <i class="fa-solid fa-file"></i>
                                </label>
                            </div>
                            <div id="thumbArea2" name="thumbArea2" class="thum_arange">
                                <?if($body['fname']['data']!=''){?>
                                    <div class="thumCon" id="orgImageView" name="orgImageView">
                                        <div class="thumBox" name="thumPreview2">
                                        <button class="delete-btn" type="button" id="deleteBtn2" name="deleteBtn2">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        <img src="/assets/web/src/pdfSample.png" alt="img" class="addedImg">
                                        </div>
                                        <p class="file-name" ><?=$body['fname']['data']?></p>
                                    </div>
                                <?}?>
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
                        <div class="ifbox infotype9 ">
                        </div>
                    </div>
                </div>
            </div>
            <div class="lastBox">
                <button type="button" class="btnType3" id="cancelBtn">취소</button>
                <button type="button" id="submitBtn" name="submitBtn" class="btnType4">수정</button>
            </div>
        </section>
    </div>
</form>

 
<?= $this->endSection() ?>