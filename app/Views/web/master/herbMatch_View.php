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
                <div class="merli1-1-1 flexType2" >
                    <select name="decocList" id="decocList" class="inputType160 mr10">
                        <option value="">탕전실</option>
                        <?=$body['option'];?>
                    </select>
                    <input type="search" id="search_name" name="search_name" class="inputType240 mr10" placeholder="약재명을 검색하십시오">
                    <button type="button" class="btnType1" id="btnSearch" name="btnSearch" data-page="1" data-cfcode="<?=$body['cf_code'];?>" >검색</button>
                </div>
                <div class="refresh">
                    <button type="button" id="btn_cancle" name="btn_cancle" class="btnType1">초기화</button>
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