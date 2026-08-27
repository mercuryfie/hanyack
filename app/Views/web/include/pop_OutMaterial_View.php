 <div class="common_pop_wrap out_material_wrap" id="pop_outMaterial" name="pop_outMaterial">
    <div class="common_pop_conkol out_material_con">
        <div class="area area1 flexType1 mb20">
            <p class="pop_head_title">출고하기</p>
            <i class="fa-solid fa-xmark " id="Xbtn"></i>
        </div>
        <div class="area  flexType2 mb10">
            <p class="cat">약재명</p>
            <p class="data" id="out_mtname">감초</p>
        </div>
        <div class="area  flexType2 mb10">
            <p class="cat">사유</p>
            <select name="out_reason" id="out_reason" class="select_type">
                <option value="">선택하세요.</option>
                <option value="1">판매</option>
                <option value="2">불량</option>
                <option value="3">폐기</option>
                <option value="4">기타</option>
            </select>
        </div>
        <div class="area vendor mb10 flexType2-1" id="vendor4">
            <p class="cat">업체명</p>
            <div class="search_box" id="so_list">
                <input type="search" class="input_type mr10" placeholder="업체명 입력 후 엔터" id="vo_skey" name="vo_skey">
                <div class="result_box flexCol" id="vo_list" name="vo_list">
                </div>
                <p class="nodata" id="noptag2" style="display: none;">검색 결과가 없습니다.</p>
            </div>
        </div>
        <div class="area  mb10 flexType2"  id="">
            <p class="cat">단위 무게</p>
            <p class="data">600g</p>
        </div>
        <div class="area  mb10 flexType2"  id="vendor3">
            <p class="cat">수량</p>
            <input type="number" class="input_type" id="" placeholder="숫자만">
            <p class="unit">개</p>
        </div>
        <div class="area price mb10 flexType2"  id="vendor6">
            <p class="cat">판매 단가</p>
            <input type="number" class="input_type" id="vo_unitprice" placeholder="숫자만">
            <p class="unit">원</p>
        </div>
        <div class="area price mb10 flexType2"  id="vendor5">
            <p class="cat">판매 총액</p>
            <input type="number" class="input_type" id="vo_price" placeholder="숫자만">
            <p class="unit">원</p>
        </div>
        <div class="area flexType2 mb10 unit">
            <p class="cat">출고량</p>
            <div class="wrap_div flexType2">
                <input type="number" class="input_type" placeholder="숫자만 입력" id="out_stock">
                <select name="out_stockType" id="out_stockType" class="select_unit">
                    <option value="1">g</option>
                    <option value="2">kg</option>
                    <option value="3">t</option>
                </select>
            </div>
        </div>
        <div class="area flexType2 mb10" >
            <p class="cat">날짜</p>
            <input type="date" class="input_date" id="out_indate">
        </div>
        <div class="area  flexType2-1 mb10">
            <p class="cat">비고</p>
            <textarea name="out_memo" id="out_memo" cols="" rows="" placeholder="비고란입니다"></textarea>

        </div>
        <div class="lastArea flexType1">
            <button class="btnType32 mr10" id="Xbtn2">취소</button>
            <button class="btnType32-1" id="btnOutStockDo" data-mtcode="" data-vcode="">확인</button>
        </div>
    </div>
</div>