<?= $this->extend("/web/template/layout_pop") ?>
<?= $this->section("content") ?>
<? $util = new \App\Libraries\Utils();?>
<script src="<?=URL_COMMON_ASSETS?>/jquery-barcode.js"></script>
<script src="<?=URL_PHARM_ASSETS?>/statement_Do.js"></script>

<div class="modal-con" id="org_area">
    <!-- <h3>작업서 및 바코드출력</h3> -->
    <div class="list-area top-table-area" >
        <table>
            <colgroup>
                <col><col>
                <col><col>
                <col><col>
                <col><col>
                <col><col>
            </colgroup>
            <tbody>
                <!-- row start -->
                <tr>
                    <th colspan="1" rowspan="2">
                        <p class="">
                            거래명세서
                        </p>
                    </th>
                    <td colspan="4" rowspan="2" style="margin: 0 auto;">
                        <div id="barcodeDiv" data-pcode="<?=$body['info']['pcode']?>" style=""></div>
                    </td>
                    <th colspan="2">대표</th>
                    <th colspan="" >부사장</th>
                    <th colspan="4">담당자</th>
                </tr>
                <!-- row start -->
                <tr style="">
                    <td colspan="2"><?=$body['company'][0]['mi_ceo']?></td>
                    <td></td>
                    <td colspan="4"></td>
                </tr>
                <!-- row start -->
                <tr >
                    <th colspan="1">작업번호</th>
                    <td colspan="4" rowspan="" ><?=$body['info']['pcode']?></td>
                    <th colspan="2">발행일</th>
                    <td colspan="2" class="printDate"><?=$body['info']['regdate']?></td>
                    <th>부서</th>
                    <td style="width:100px;"></td>
                </tr>
                <!-- row start -->
                <tr>
                    <th colspan="1">거래처</th>
                    <td colspan="4" class="decocNm" ><?=$body['company'][0]['mi_name']?></td>
                    <th colspan="2">출하부서</th>
                    <td class="hello" colspan="4">-</td>
                </tr>
                <!-- row start -->
                <tr>
                    <th colspan="1">납품장소</th>
                    <td colspan="4">-</td>
                    <th colspan="2">입고희망일(주기)</th>
                    <td colspan="4" id="hopeDayTxt" >-</td>
                </tr>

            </tbody>
        </table>
        <div class="list-area bottom-table-area" style="min-height: 345px;">
            <table id="tableMediapplydesc">
                <colgroup class="col12">
                    <col class="wid3"><col class="wid4"><col  class="wid4"><col class="wid12"><col class="wid12">
                    <col  class="wid4"><col  class="wid4"><col class="wid4"><col ><col  class="wid5">
                    <col class="wid5"><col  class="wid5">
                </colgroup>

                <thead>
                <tr>
                    <th class="">No</th>
                    <th>요청코드</th>
                    <th>약재코드</th>
                    <th class="">약재명</th>
                    <th>탕전실약재명</th>
                    <th>무게</th>
                    <th>수량</th>
                    <th>배송희망일</th>
                    <th>비고</th>
                </tr>
                </thead>

                <tbody>
                <?if($util->fnArrayCnt($body['sub']) > 0){?>
                    <?foreach ($body['sub'] as $d){?>
                        <tr>
                            <td><?=$d['num']?></td>
                            <td><?=$d['pa_code']?></td>
                            <td><?=$d['fk_hncode']?></td>
                            <td><?=$d['hn_name']?></td>
                            <td class="herbName"><a href="javascript://" onclick="Prn_Box('<?=$d['fk_hncode']?>');"><?=$d['mm_kTitle']?></a></td>
                            <td><?=$d['t_weight']?>g</td>
                            <td><?=$d['t_cnt']?>개</td>
                            <td><?=$d['delidate']?></td>
                        </tr>
                    <?}?>
                <?}?>
                </tbody>
            </table>
            <div class="print-info">출력후 1장은 약재와 함께 탕전실로 보내주세요! </div>
        </div>
    </div>


<!--        <div class="modal-con">-->
<!--             -->
<!--        </div>-->
</div>
<div class="btn-wrap">
    <button type="button" class="btn btntype7" onclick="g_close();">닫기</button>
    <button type="button" class="btn printOpen btntype8" id="applyPrintBtn" data-pcode="<?=$body['info']['pcode']?>" data-ptype="<?=$body['info']['ptype']?>">출력</button>
</div>

<DIV ID="printArea">
</DIV>


<?= $this->endSection() ?>
