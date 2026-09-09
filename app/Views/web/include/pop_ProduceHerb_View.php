<div class="common_pop_wrap pop_produceherb_wrap" id="pop_produce_herb"  name="pop_produce_herb" style="">
    <div class="common_pop_conkol pop_produceherb_con" id="prod_herb_con">
        <div class="area area1">
            <h2 class="pop_head_title mb20" id="mainTitle">생산하기</h2>
            <i class="fa-solid fa-xmark " id="Xbtn"></i>
        </div>
        <div class="area area2 flexType1">
            <div class="left mr20">
                <div class="row">
                    <p class="sub_title">
                        생산 정보
                    </p>
                </div>
                <div class="row flexType2">
                    <p class="cat">약재명</p>
                    <p class="data" id="p_hnname" name="p_hnname" data-wvalue=""></p>
                </div>
                <div class="row mtname flexType2">
                    <p class="cat">원재료명</p>
                    <input type="search" class="input_type3 mr10" placeholder="원재료명 입력 후 엔터" data-mtcode="" id="m_skey" name="m_skey">
                    <div class="result_box flexCol" id="mlist" name="mlist" >
                    </div>
                </div>
                <div class="row flexType2">
                    <p class="cat">원재료 투입량</p>
                    <input type="search" class="input_type3 mr10" placeholder="숫자만" id="p_InputMaterail" name="p_InputMaterail">
                    <select name="p_MUnitType" id="p_MUnitType" class="input_type3 unit">
                        <option value="1">g</option>
                        <option value="2">kg</option>
                        <option value="3">t</option>
                    </select>
                </div>
                <div class="row flexType2">
                    <p class="cat">제조번호</p>
                    <input type="search" class="input_type3" name="p_batchno" id="p_batchno">
                </div>

                <div class="row flexType2">
                    <p class="cat">제조일자</p>
                    <input type="date" class="input_type3 date" name="birthDate" id="birthDate">
                </div>
                <div class="row flexType2">
                    <p class="cat">유통기한</p>
                    <input type="date" class="input_type3 date" name="periodDate" id="periodDate">
                </div>
                <div class="row flexType2-1 file_row">
                    <p class="cat">시험성적서</p>

                    <div class="file_box">
                        <label for="test_file" class="btnType32 h32">파일 선택</label>
                        <input type="file" id="test_file" name="test_file" class="input_file" hidden>
                        <div class="f_name_box flexType3-1">
                            <p class="file_name" id="test_file_name">
                                선택된 파일 없음
                            </p>
                            <i class="fa-solid fa-xmark file_clear_btn" id="test_file_clear"></i>
                        </div>
                    </div>
                </div>
                <div class="row flexType2">
                    <p class="cat">생산량</p>
                    <div class="unit_box flexType2">
                        <input type="search" class="input_type3 mr10" placeholder="숫자만" id="p_OutputMaterail" name="p_OutputMaterail">
                        <select name="pUintType" id="p_PUintType" name="p_PUintType" class="input_type3 unit">
                            <option value="1">g</option>
                            <option value="2">kg</option>
                            <option value="3">t</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="row">
                    <p class="sub_title">
                        가격 설정
                    </p>
                </div>
                <div class="row flexType2">
                    <button type="button" class="btnType32  mr5 active" id="realPrice" name="realPrice"  >직접입력</button>
                    <button type="button" class="btnType32" id="defaultPrice" name="defaultPrice"  data-gradea="<?=$body['grade']['grade_a'];?>" data-gradeb="<?=$body['grade']['grade_b'];?>" data-gradec="<?=$body['grade']['grade_c'];?>" data-graded="<?=$body['grade']['grade_d'];?>" data-gradee="<?=$body['grade']['grade_e'];?>">기본할인</button>
                </div>
                <div class="row flexType2">
                    <p class="cat">근당가격</p>
                    <input type="search" class="input_type3 " placeholder="숫자만" id="p_gPrice" name="p_gPrice">
                    <p class="unit">원</p>
                </div>
                <div class="row flexType2">
                    <p class="cat">포장가격</p>
                    <p class="data" id="p_packagePrice" name="p_packagePrice"></p>
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
        </div>
        <div class="area lastArea">
            <button class="btnType32 mr10" id="Xbtn2">닫기</button>
            <button class="btnType32-1 " id="btnProdHerb">확인</button>
        </div>
    </div>
</div>
