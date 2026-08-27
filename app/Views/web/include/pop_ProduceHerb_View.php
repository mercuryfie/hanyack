<div class="common_pop_wrap pop_produceherb_wrap" id="pop_produce_herb"  name="pop_produce_herb" style="">
    <div class="common_pop_conkol pop_produceherb_con" id="prod_herb_con">
        <div class="area area1">
            <h2 class="pop_head_title mb20" id="mainTitle">생산하기</h2>
            <i class="fa-solid fa-xmark " id="Xbtn"></i>
        </div>
        <div class="area area2 flexType1">

            <!--            <div class="row flexType2">-->
            <!--                <p class="cat">약재코드</p>-->
            <!--                <p class="data">-</p>-->
            <!--            </div>-->
<!--            <div class="row flexType1">-->
<!--                <p class="cat"></p>-->
<!--                <button class="btnType32 active mr10" id="" onclick="Produce_Herb();">생산하기</button>-->
<!--                <button class="btnType32 " id="" onclick="Log_Produce_Herb()∑;">로그보기</button>-->
<!--            </div>-->
            <div class="left mr20">
                <div class="row">
                    <p class="sub_title">
                        생산 정보
                    </p>
                </div>
                <div class="row flexType2">
                    <p class="cat">약재명</p>
                    <p class="data" id="mtname"></p>
                </div>
                <div class="row mtname flexType2">
                    <p class="cat">원재료명</p>
                    <input type="search" class="input_type3 mr10" placeholder="원재료명 입력 후 엔터" data-mtcode="" id="m_skey" name="m_skey">
                    <div class="result_box flexCol" id="mlist" name="mlist" >
<!--                        <a href="javascript:;" class="data">hello22</a>-->
                    </div>
                </div>
                <div class="row flexType2">
                    <p class="cat">원재료 투입량</p>
                    <input type="search" class="input_type3 mr10" placeholder="숫자만" id="" name="">
                    <!--            <button class="btnType32-2" id="" data-sn="">확인</button>-->
                </div>
                <div class="row flexType2">
                    <p class="cat">제조번호</p>
                    <input type="search" class="input_type3" name="" id="pcode">
                </div>

                <div class="row flexType2">
                    <p class="cat">제조연월일</p>
                    <input type="date" class="input_type3 date" name="birthDate">
                </div>
                <div class="row flexType2">
                    <p class="cat">소비기한</p>
                    <input type="date" class="input_type3 date" name="birthDate">
                    <!--                <p class="data">2026.01.01</p>-->
                </div>
                <div class="row flexType2-1 file_row">
                    <p class="cat">시험성적서</p>

                    <div class="file_box">
                        <label for="test_file" class="btnType32 h32">파일 선택</label>
<!--                        <div class="flexType2">-->
<!--                            <label for="test_file" class="btnType32 h32">파일 선택</label>-->
<!---->
<!--                        </div>-->
                        <input type="file" id="test_file" class="input_file" hidden>

                        <div class="f_name_box flexType3-1">
                            <p class="file_name" id="test_file_name">
                                선택된 파일 없음
                            </p>
                            <i class="fa-solid fa-xmark file_clear_btn" id="test_file_clear"></i>
                        </div>
                    </div>
                </div>
<!--                <div class="row flexType2">-->
<!--                    <p class="cat">시험성적서</p>-->
<!--                    <input type="file" class="input_file">-->
<!--                </div>-->
                <div class="row flexType2">
                    <p class="cat">생산량</p>
                    <div class="unit_box flexType2">
                        <input type="search" class="input_type3 mr10" placeholder="숫자만">
                        <select name="" id="" class="input_type3 unit">
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
                    <button type="button" class="btnType32 active mr5" name=""  data-hpcode="" >직접입력</button>
                    <button type="button" class="btnType32" name="" data-hpcode="">기본할인</button>

                </div>
                <div class="row flexType2">
                    <p class="cat">근당가격</p>
                    <input type="search" class="input_type3 " placeholder="숫자만">
                    <p class="unit">원</p>
                </div>
                <div class="row flexType2">
                    <p class="cat">포장가격</p>
                    <p class="data">10,000</p>
                    <p class="unit">원</p>
                </div>
                <div class="row flexType2">
                    <p class="cat">등급 A</p>
                    <input type="search" class="input_type3 " placeholder="숫자만" >
                    <p class="unit">원</p>
                </div>
                <div class="row flexType2">
                    <p class="cat">등급 B</p>
                    <input type="search" class="input_type3 " placeholder="숫자만">
                    <p class="unit">원</p>
                </div>
                <div class="row flexType2">
                    <p class="cat">등급 C</p>
                    <input type="search" class="input_type3 " placeholder="숫자만">
                    <p class="unit">원</p>
                </div>
                <div class="row flexType2">
                    <p class="cat">등급 D</p>
                    <input type="search" class="input_type3 " placeholder="숫자만">
                    <p class="unit">원</p>
                </div>
                <div class="row flexType2">
                    <p class="cat">등급 E</p>
                    <input type="search" class="input_type3 " placeholder="숫자만">
                    <p class="unit">원</p>
                </div>
                <div class="row">
                    <p class="fontType1">* 예: 등급 할인 시 -500 입력, 증액 시 500 입력 </p>
                </div>

            </div>
        </div>
        <div class="area lastArea">
            <button class="btnType32 mr10" id="Xbtn2">닫기</button>
            <button class="btnType32-1 " id="btnProdHerb">확인</button>
            <button class="btnType32-1 " id="btnEditHerb">확인</button>
        </div>
    </div>
</div>
