$(document).ready(function() {
    Load_Order(1, '','');

    $(document).on('change','#decoc_filter,#pharm_filter',function(){
        let decoc = $('#decoc_filter').val();
        let pharm = $('#pharm_filter').val();
        Form_ini();
        Load_Order(1,decoc,pharm);
    });

    $(document).on('click','#more1,#more2',function(){
        let decoc = $('#decoc_filter').val();
        let pharm = $('#pharm_filter').val();
        let page = $('#more1').data('page');
        Load_Order(page,decoc,pharm);
    });

    $(document).on('click',"button[name='btn_return']",function(){
        let sn = $(this).data('sn');
        let url = DECOCURL + '/return?gd=' + sn;
        $(location).attr('href',url);
    });

});

async function  Load_Order(page,decoc,pharm){
    try {
        start_spinner();
        let dataarr = {"page": page, "decoc": decoc,"pharm" : pharm};
        let url = APIURL + '/Load_OrderList';
        let result = await Load_API(url, dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if (result.get('status') == 'ok') {
            let html = '';
            let sub_html1 = '';
            let sub_html2 = '';
            let sub_html3 = '';
            let data = result.get('data');
            let arr = (data && data.list) ? data.list : [];
            let Cnt = arr.length;
            console.log(arr);
            if (Cnt > 0) {
                $.each(arr, function (index, el) {
                    if(el.gd_status==0) {
                        sub_html1 =`<p class="tagType11">${Order_Step_Name(el.gd_status)}</p>`;
                        sub_html2 = '';
                    } else if (el.gd_status==1){
                        sub_html1 =`<p class="tagType12">${Order_Step_Name(el.gd_status)}</p>`;
                        sub_html2 = '';
                    } else if (el.gd_status==2){
                        sub_html1 =`<p class="tagType13">${Order_Step_Name(el.gd_status)}</p>`;
                        sub_html2 = '';
                    } else if (el.gd_status==3){
                        sub_html1 =`<p class="tagType14">${Order_Step_Name(el.gd_status)}</p>`;
                        sub_html2 = '';
                    } else if (el.gd_status==4){
                        sub_html1 =`<p class="tagType15">${Order_Step_Name(el.gd_status)}</p>`;
                        if(el.deli_period==0) {
                            sub_html2 = `<button type="button" class="btnType1" id="btn_return" name="btn_return" data-sn="${el.sn}">반품/교환</button>`;
                        }
                    }

                    if(el.gd_ptype==1){
                        sub_html3 = `<p class="tagType1">${Order_Type_Name(el.gd_ptype)}</p>`;3
                    }else if(el.gd_ptype==2){
                        sub_html3 = `<p class="tagType2">${Order_Type_Name(el.gd_ptype)}</p>`
                    }else if(el.gd_ptype==3){
                        sub_html3 = `<p class="tagType3">${Order_Type_Name(el.gd_ptype)}</p>`
                    }


                    html +=`
                        <tr>   
                            <td>${sub_html1}</td>
                            <td>${el.gd_code}</td>  
                            <td>${el.od_regdate}</td>
                            <td>${el.mi_name}</td>
                            <td>${el.od_wname}</td>
                            <td>${el.hn_name}</td>
                            <td>${sub_html3}</td>
                            <td>${el.hn_option}</td>
                            <td>${el.gd_cnt}개</td>
                            <td>${number_format(el.gd_rPrice)}원</td>
                            <td>${number_format(el.gd_price)}원</td> 
                            <td>${sub_html2}</td>
                        </tr>
                    `;
                });
            }else{
                if(page==1) {
                    html = '<tr><td colspan="11">주문정보가 없습니다.</td></tr>'
                }else{
                    Make_Toast('마지막입니다.');
                }
            }
            $('#orderlist').append(html);

            $('#more1').data('page',data.page);
        }else{
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    }catch(error){
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}

function Form_ini(){
    $('#orderlist').empty();
    $('#more1').data('page',1);
}

