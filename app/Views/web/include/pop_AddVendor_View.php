 <div class="common_pop_wrap add_vendor_wrap" id="pop_AddVendor" name="pop_AddVendor">
    <div class="common_pop_conkol add_vendor_con">
        <input type="hidden" id="ve_code" value="">
        <div class="area area1 flexType1 mb20">
            <p class="pop_head_title" id="p_title">거래처 등록</p>
            <i class="fa-solid fa-xmark " id="Xbtn"></i>
        </div>
        <div class="area flexType2 mb10">
            <p class="must"></p>
            <p class="cat">업체명</p>
            <input type="search" class="input_type v_name" id="ve_name">
        </div>
        <div class="area b_no flexType2 mb10">
            <input type="hidden" class="" id="ve_no">
            <p class="must"></p>
            <p class="cat">사업자번호</p>
            <div class="wrap_div flexType3">
                <input type="search" class="input_type " id="ve_no1">
                <p class="dash">-</p>
                <input type="search" class="input_type" id="ve_no2">
                <p class="dash">-</p>
                <input type="search" class="input_type" id="ve_no3">
            </div>
        </div>
        <div class="area b_no flexType2 mb10">
            <p class="must"></p>
            <p class="cat">연락처</p>
            <div class="wrap_div flexType3">
                <input type="search" class="input_type" id="ve_ctc1">
                <p class="dash">-</p>
                <input type="search" class="input_type" id="ve_ctc2">
                <p class="dash">-</p>
                <input type="search" class="input_type" id="ve_ctc3">
            </div>
        </div>
        <div class="area flexType2 mb10">
            <p class="notmust"></p>
            <p class="cat">E-mail</p>
            <input type="search" class="input_type" id="ve_email">
        </div>
        <div class="area flexType2 mb10">
            <p class="notmust"></p>
            <p class="cat">회계용 E-mail</p>
            <input type="search" class="input_type" id="ve_busiemail">
        </div>
        <div class="area postcode_div flexType2 mb10" name="edit_address">
            <p class="must"></p>
            <p class="cat">우편번호</p>
            <div class="wrap_div flexType2">
                <input type="search" class="input_type" id="ve_postcode">
                <button class="btnType32 " id="findAddress" name="findAddress">찾기</button>

            </div>
        </div>
        <div class="area add mb10 flexType2-1" name="edit_address2">
            <div class=" flexType2">
                <p class="must"></p>
                <p class="cat">주소</p>
            </div>
            <div class="wrap_div">
                <input type="search" class="input_type mb10" id="roadAddress" placeholder="주소 입력">
                <input type="search" class="input_type" id="jibunAddress" placeholder="상세 주소 입력">
            </div>
        </div>
        <div class="area  flexType2-1 mb10">
            <p class="notmust"></p>
            <p class="cat">비고</p>
            <textarea name="" id="ve_desc" cols="30" rows="10" placeholder="비고란입니다"></textarea>


        </div>
        <div class="lastArea flexType1">
            <button class="btnType32 mr10" id="Xbtn2">취소</button>
            <button class="btnType32-1 btn_add_vendor" id="btn_AddVendor" data-sn="" data-vecode="" onclick="">확인</button>
            <button class="btnType32-1 btn_edit_vendor" id="btn_EditVendor" data-sn="" data-vecode="" onclick="">확인</button>
        </div>
    </div>
</div>