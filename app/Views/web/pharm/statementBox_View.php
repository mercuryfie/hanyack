<?= $this->extend("/web/template/layout_pop") ?>
<?= $this->section("content") ?>
<script src="<?=URL_PHARM_ASSETS?>/statementBox_Do.js"></script>

<div class="modal-con" id="org_area">
    <table class="statementBox">
        <thead>
        <tr>
            <th>약재명</th>
            <td class="title"><?=$body['hn_name']?></td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th>제조사</th>
            <td><?=$body['mi_name']?></td>
        </tr>
        <tr>
            <th>사용기한</th>
            <td><?=$body['e_date']?></td>
        </tr>
        <tr>
            <th>포장단위</th>
            <td><?=$body['unitWeight']?></td>
        </tr>
        <tr>
            <th>수량</th>
            <td>-</td>
        </tr>
        </tbody>
    </table>
</div>

<div class="printBox btn-wrap">
    <button type="button" class="btntype7" onclick="g_close();">닫기</button>
    <button type="button" class="btntype7" id="btnPrnPallet" data-code="<?=$body['pacode']?>">파레트 출력</button>
    <button type="button" class="btntype8" id="prn_Box">출력</button>
</div>

<?= $this->endSection() ?>
