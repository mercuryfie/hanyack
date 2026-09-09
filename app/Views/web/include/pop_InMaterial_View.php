 <div class="common_pop_wrap in_material_wrap" id="pop_inMaterial" name="pop_inMaterial">
    <div class="common_pop_conkol in_material_con">

        <div class="area area1 flexType1 mb20">
            <p class="pop_head_title">입고하기</p>
            <i class="fa-solid fa-xmark " id="Xbtn"></i>
        </div>
        <div class="area flexType2 mb10">
            <p class="must"></p>
            <p class="cat">약재명</p>
            <p class="data" id="in_mtname"></p>
        </div>
        <div class="area flexType2 mb10">
            <p class="must"></p>
            <p class="cat">사유</p>
            <select name="input_cause" id="in_reason" class="select_type">
                <option value="">선택하세요.</option>
                <option value="1">구매</option>
                <option value="2">반품</option>
                <option value="3">교환</option>
                <option value="4">기타</option>
            </select>
        </div>
        <div class="area vendor mb10 flexType2-1" id="vendor1">
            <div class="flexType2">
                <p class="must"></p>
                <p class="cat">업체명</p>
            </div>
            <div class="search_box" id="s_list">
                <input type="search" class="input_type mr10" placeholder="업체명 입력 후 엔터" id="v_skey" name="v_skey">
                <div class="result_box flexCol" id="v_list" name="v_list">
                </div>
                <p class="nodata" id="noptag" style="display:none;">검색 결과가 없습니다.</p>
            </div>
        </div>
        <div class="area flexType2 mb10"  id="">
            <p class="must"></p>
            <p class="cat">단위 무게</p>
            <p class="data">600g</p>
        </div>
        <div class="area  mb10 flexType2"  id="">
            <p class="must"></p>
            <p class="cat">수량</p>
            <input type="number" class="input_type" id="" placeholder="숫자만">
            <p class="unit">개</p>
        </div>
        <div class="area price mb10 flexType2"  id="vendor3">
            <p class="must"></p>
            <p class="cat">구매 단가</p>
            <input type="number" class="input_type" id="v_unitprice" placeholder="숫자만">
            <p class="unit">원</p>
        </div>
        <div class="area price mb10 flexType2"  id="vendor2">
            <p class="must"></p>
            <p class="cat">구매 총액</p>
            <input type="number" class="input_type" id="v_price" placeholder="숫자만">
            <p class="unit">원</p>
        </div>
        <div class="area flexType2 mb10 unit">
            <p class="must"></p>
            <p class="cat">총 입고량</p>
            <div class="wrap_div flexType2">
                <input type="number" class="input_type" id="in_stock" placeholder="숫자만">
                <select class="select_unit" id="in_stockType">
                    <option value="1" selected>g</option>
                    <option value="2">kg</option>
                    <option value="3">t</option>
                </select>
            </div>
        </div>
        <div class="area flexType2 mb10" id="">
            <p class="must"></p>
            <p class="cat">날짜</p>
            <input type="date" class="input_date" id="in_indate">
        </div>
        <div class="area  flexType2-1 mb10">
            <p class="notmust"></p>
            <p class="cat">비고</p>
            <textarea  id="in_memo" cols="30" rows="10" placeholder=""></textarea>

        </div>
        <div class="lastArea flexType1">
            <button class="btnType32 mr10" id="Xbtn2">취소</button>
            <button class="btnType32-1" id="btnInStockDo" data-mtcode="" data-vcode="">확인</button>
        </div>
    </div>
</div>