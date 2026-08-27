<?= $this->extend("/web/template/layout_mypage_dj") ?>
<?= $this->section("content") ?>

<script src="<?=URL_MASTER_ASSETS?>/herbMatch_Do.js?rnd=<?= rand(); ?>"></script>
<section class="merright">

    <input type="hidden" name="xxxx" id="xxxx" value="xxxx" />
    <div class="herbMachingWrap">
        <input type="hidden" name="" value="$hncode">
        <div class="tableRightBox ">
            <p class="headTitle1">약재 매칭</p>
            <div class="btnBox flexType3">
                <div class="merli1-1-1 flexCol match_boxmxh">
                    <div class="upside flexType2 match_boxkfg mb10">
                        <p class="order">1</p>
                        <select name="decocList" id="decocList" class="inputType160 mr10">
                            <option value="">탕전실</option>
                            <?= $body['decoc']; ?>
                        </select>
                    </div>
                    <div class="upside flexType2 match_boxkfg mb10">
                        <p class="order">2</p>
                        <select name="naList" id="naList" class="inputType160 mr10">
                            <option value="">원산지</option>
                            <?= $body['nation']; ?>
                        </select>
                    </div>
                    <div class="downside match_boxkfh flexType4">
                        <p class="order">3</p>
                        <div class="right">
                            <div class="col2 idx1-2 btnon">
                                <button onclick="Search_HDMedicine(this,1,'ㄱ');" type="button" class="btn_cho">ㄱ</button>
                                <button onclick="Search_HDMedicine(this,1,'ㄴ');" type="button" class="btn_cho">ㄴ</button>
                                <button onclick="Search_HDMedicine(this,1,'ㄷ');" type="button" class="btn_cho">ㄷ</button>
                                <button onclick="Search_HDMedicine(this,1,'ㄹ');" type="button" class="btn_cho">ㄹ</button>
                                <button onclick="Search_HDMedicine(this,1,'ㅁ');" type="button" class="btn_cho">ㅁ</button>

                                <button onclick="Search_HDMedicine(this,1,'ㅂ');" type="button" class="btn_cho">ㅂ</button>
                                <button onclick="Search_HDMedicine(this,1,'ㅅ');" type="button" class="btn_cho">ㅅ</button>
                                <button onclick="Search_HDMedicine(this,1,'ㅇ');" type="button" class="btn_cho">ㅇ</button>
                                <button onclick="Search_HDMedicine(this,1,'ㅈ');" type="button" class="btn_cho">ㅈ</button>
                                <button onclick="Search_HDMedicine(this,1,'ㅊ');" type="button" class="btn_cho">ㅊ</button>

                                <button onclick="Search_HDMedicine(this,1,'ㅋ');" type="button" class="btn_cho">ㅋ</button>
                                <button onclick="Search_HDMedicine(this,1,'ㅌ');" type="button" class="btn_cho">ㅌ</button>
                                <button onclick="Search_HDMedicine(this,1,'ㅍ');" type="button" class="btn_cho">ㅍ</button>
                                <button onclick="Search_HDMedicine(this,1,'ㅎ');" type="button" class="btn_cho">ㅎ</button>
                            </div>
                            <div class="herbbox herb_boxdsa">
                                <div class="herbbtn1-1">
                                    <input type="search" class="searchInput"
                                           id="txtHD" data-medicode="" name="txtHD" placeholder="검색어 입력 후, 엔터를 누르세요." onfocus="">
                                    <button class="herbtoggle" type="button"><i class="fas fa-caret-down downbtn"></i>
                                    </button>

                                </div>
                                <div class="herbbtn1-2" id="HD_List">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <table class="merlitable">
                <tr>
                    <td class="merlirow">표준약재</td>
                    <td class="merlirow">DJMEDI약재코드</td>
                    <td class="merlirow">약재명</td>
                    <td class="merlirow">제조사</td>
                    <td class="merlirow">원산지</td>
                    <td class="merlirow">매칭</td>
                </tr>

                <tbody id="herbList" name="herbList">
                </tbody>


            </table>
        </div>
    </div>

</section>
<?= $this->include("/web/include/pop_Matching_View") ?>
<?= $this->endSection() ?>