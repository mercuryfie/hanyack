<div class="common_pop_wrap pop_editprodherb_wrap" id="EditProdHerbWrap"  name="EditProdHerbWrap" style="">
    <div class="common_pop_conkol pop_editprodherb_con" id="EditProdHerbCon">
        <div class="area area1 mt20 mb10">
            <h2 class="pop_head_title " id="mainTitle">가격 수정하기</h2>
            <i class="fa-solid fa-xmark " id="Xbtn"></i>
        </div>
        <div class="area area2 flexCol2">
            <div class="row flexType2">
                <button type="button" class="btnType32   mr10" id="realPrice" name="realPrice"  >직접입력</button>
                <button type="button" class="btnType32 active" id="defaultPrice" name="defaultPrice"  data-gradea="<?=$body['grade']['grade_a'];?>" data-gradeb="<?=$body['grade']['grade_b'];?>" data-gradec="<?=$body['grade']['grade_c'];?>" data-graded="<?=$body['grade']['grade_d'];?>" data-gradee="<?=$body['grade']['grade_e'];?>">기본할인</button>
            </div>
            <div class="row flexType2">
                <p class="cat">근당가격</p>
                <input type="search" class="input_type3 " placeholder="숫자만" id="p_gPrice" name="p_gPrice">
                <p class="unit">원</p>
            </div>
            <div class="row flexType2">
                <p class="cat">포장가격</p>
                <input type="search" class="input_type3 " placeholder="숫자만" id="p_packagePrice" name="p_packagePrice">
                <p class="unit">원</p>
            </div>
            <div class="row flexType2">
                <p class="cat">등급 A</p>
                <input type="search" class="input_type3 " placeholder="숫자만"  id="p_PriceA" name="p_PriceA">
                <p class="unit">원</p>
            </div>
            <div class="row flexType2">
                <p class="cat">등급 B</p>
                <input type="search" class="input_type3 " placeholder="숫자만" id="p_PriceB" name="p_PriceB">
                <p class="unit">원</p>
            </div>
            <div class="row flexType2">
                <p class="cat">등급 C</p>
                <input type="search" class="input_type3 " placeholder="숫자만"  id="p_PriceC" name="p_PriceC">
                <p class="unit">원</p>
            </div>
            <div class="row flexType2">
                <p class="cat">등급 D</p>
                <input type="search" class="input_type3 " placeholder="숫자만"  id="p_PriceD" name="p_PriceD">
                <p class="unit">원</p>
            </div>
            <div class="row flexType2">
                <p class="cat">등급 E</p>
                <input type="search" class="input_type3 " placeholder="숫자만"  id="p_PriceE" name="p_PriceE">
                <p class="unit">원</p>
            </div>
            <div class="row">
                <p class="fontType1">* 예: 등급 할인 시 -500원 입력, 증액 시 500원 입력 </p>
            </div>
        </div>
        <div class="area lastArea">
            <button class="btnType32 mr10" id="Xbtn2">닫기</button>
            <button class="btnType32-1 " id="btnEditHerb">확인</button>
        </div>
    </div>
</div>
