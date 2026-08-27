 <div class="common_pop_wrap add_material_wrap" id="pop_addMaterial" name="pop_addMaterial">
    <div class="common_pop_conkol add_material_con">
        <div class="area area1 flexType1 mb20">
            <p class="pop_head_title" id="p_title">원재료 등록하기</p>
            <i class="fa-solid fa-xmark " id="Xbtn"></i>
        </div>
        <div class="area">
            <div class="left">

            </div>
            <div class="right">

            </div>
        </div>
        <div class="area  flexType2 mb10">
            <p class="cat">이름</p>
            <input type="search" class="input_type" id="mtname" name="mtname">
        </div>
        <div class="area  flexType2 mb10">
            <p class="cat">기본손실률</p>
            <input type="number" class="input_type" id="waste_rate" name="waste_rate"> %
        </div>
        <div class="area optimal flexType2 mb10">
            <p class="cat">적정재고량</p>
            <div class="wrap_div flexType2">
                <input type="number" class="input_type" id="optimal_stock" name="optimal_stock">
                <select name="real_rate" id="real_rate" class="select_type">
                    <option value="1">g</option>
                    <option value="2">kg</option>
                    <option value="3">t</option>
                </select>
            </div>
        </div>
        <div class="area  flexType2-1 mb10">
            <p class="cat">비고</p>
            <textarea name="memo" id="memo" cols="30" rows="10" placeholder="비고란입니다"></textarea>

        </div>
        <div class="lastArea flexType1">
            <button class="btnType32 mr10" id="Xbtn2">취소</button>
            <button class="btnType32-1" id="btnMtRegDo" name="btnMtRegDo" >확인</button>
            <button class="btnType32-1" id="btnMtUpdateDo" name="btnMtUpdateDo" data-mtcode="">수정</button>
        </div>
    </div>
</div>