<div class="confirmOrderCon" id="confirmOrder" name="confirmOrder">
    <div class="confirmOrderpop">
        <i class="fa-solid fa-calendar-days topIcon"></i>
        <h2 class="">주문 확인</h2>
        <p class="guide">배송 희망일을 입력하십시오</p>
        <div class="dateBox">
            <p>배송희망일</p>
            <input type="text" id="s_date" name="s_date" class="datepicker datepicker1-2" placeholder="날짜 선택" readonly>
            <i class="fa-regular fa-calendar calicon" id="calicon1-1"></i>
        </div>
        <div class="textBox">
            <p>추가메시지</p>
            <textarea class="msg" name="" id="" cols="30" rows="10" placeholder="hello"></textarea>
        </div>
        <div class="btnBox">
            <button class="btnGrey"
                    type="button"
                    id="" name="" onclick="go_smart();">닫기</button>
            <button class="btnGreen"
                    id="" name=""
                    type="button" data-odcode="" onclick="go_orderList();">확인</button>
        </div>
    </div>
</div>