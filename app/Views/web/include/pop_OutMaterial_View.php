 <div class="common_pop_wrap out_material_wrap" id="pop_outMaterial" name="pop_outMaterial">
    <div class="common_pop_conkol out_material_con">
        <div class="area area1 flexType1 mb20">
            <p class="pop_head_title">출고하기</p>
            <i class="fa-solid fa-xmark " id="Xbtn"></i>
        </div>
        <div class="area  flexType2 mb10">
            <p class="cat">약재명</p>
            <p class="data">감초</p>
        </div>
        <div class="area  flexType2 mb10">
            <p class="cat">사유</p>
            <select name="output_cause" id="output_cause" class="select_type">
                <option value="1">불량</option>
                <option value="2">판매</option>
                <option value="3">폐기</option>
            </select>
        </div>
        <div class="area customer mb10 flexType2">
            <p class="cat">업체명</p>
            <input type="search" class="input_type mr10" placeholder="업체명 입력 후 엔터" id="v_skey" name="v_skey">
            <!--            <button class="btnType32-2" id="" data-sn="">확인</button>-->
            <div class="result_box flexCol" id="v_list" name="v_list">
            </div>
        </div>
        <div class="area price mb10 flexType2">
            <p class="cat">근/개당 가격</p>
            <input type="number" class="input_type" placeholder="숫자만 입력">원
        </div>
        <div class="area flexType2 mb10" id="">
            <p class="cat">날짜</p>
            <input type="date" class="input_date">
        </div>
        <div class="area flexType2 mb10 unit">
            <p class="cat">용량</p>
            <div class="wrap_div flexType2">
                <input type="number" class="input_type" placeholder="숫자만 입력">
                <select name="" id="" class="select_unit">
                    <option value="">g</option>
                    <option value="">kg</option>
                    <option value="">t</option>
                </select>
            </div>
        </div>
        <div class="area  flexType2-1 mb10">
            <p class="cat">비고</p>
            <textarea name="" id="" cols="" rows="" placeholder="비고란입니다"></textarea>

        </div>
        <div class="lastArea flexType1">
            <button class="btnType32 mr10" id="Xbtn2">취소</button>
            <button class="btnType32-1" id="" data-sn="">확인</button>
        </div>
    </div>
</div>