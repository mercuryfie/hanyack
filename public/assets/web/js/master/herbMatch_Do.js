$(document).ready(function() {

    $('.herbName').hover(
        function() { $(this).addClass('hovered'); },
        function() { $(this).removeClass('hovered'); }
    );

    $('#XBtn').on('click',function(e){
        Form_ini2();
        $('#matchingpop').hide();
    });

    $('#matchingpop').on('click', function(e){
        if (e.target === this) {
            INI_Matching_pop();
            $(this).hide();
        }
    });

    $('#btn_match').on('click',function(e){
       Insert_Match_Data();
    });

    $('#btn_match_del').on('click',function(e){
        Del_Decoc_Match();
    });


    $("#txtHD").on("keypress", function (key) {
        if (key.keyCode == 13) {
            $word = $('#txtHD').val();
            if ($word == '') {
                Make_Toast('검색어를 입력하세요.');
                $('#txtHD').focus();
            } else {
                Search_HDMedicine(this,2, $word);
            }
        }
    });

    $(document).on('click','button[name="btn_select"]',function(){
        let code = $(this).data('code');
        let hn_txt = $(this).text();
        let cf_code = $("#decocList option:selected").val();
        let nation = $("#naList option:selected").val();
        $('#txtHD').val(hn_txt);

        Form_ini();

        if(cf_code=='') {
            $('#decocList').focus();
            Make_Toast('탕전실을 선택하세요.');
        }else if(nation ==''){
            $('#naList').focus();
            Make_Toast('원산지를 선택하세요.');
        }else{
            Load_Decoc_Herb(code,cf_code,nation);
        }
    });

    $(document).on('focusin','#txtHD, .btn_cho, #decocList, #naList',function(){
        $('#txtHD').val('');
    });


});

async function Search_HDMedicine(form,target, val) {
    try {
        start_spinner();
        let dataarr = {"word": val, "target": target};
        let url = APIURL + "/Load_Medicine";
        let result = await Load_API(url, dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if (result.get('status') == 'ok') {
            let html = '';
            let data = result.get('data');
            let arr = (data && data.list) ? data.list : [];
            console.log(arr);
            let Cnt = arr.length;
            if (Cnt > 0) {
                $.each(arr, function (index, el) {
                    html += `<button class="herboption" type="button" name="btn_select" data-code="${el.mdMedi}">${el.mdMediName} [${el.mdMedi}]</button>`;
                });
                $('#HD_List').append(html);
                $('#HD_List').css('display', 'flex');
                if(target==1) $(form).addClass("checkedGreen");
            } else {
                Make_Toast(result.get('message'));
            }
        } else {
            ini_Form1();
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}


async function Del_Decoc_Match(){
    try{
        start_spinner();
        let snChecked = $('input[name="delcode"]:checked').map(function() {
            return this.value;
        }).get();

        console.log(snChecked);
        let snCnt = snChecked.length;
        if(snCnt>0){
            let cfcode=  $('#btn_match_del').data('cfcode');
            let mdMedi = $('#btn_match_del').data('meMed');
            let mmmedi = $('#btn_match_del').data('medicine');
            let seq = $('#btn_match').data('seq');
            let nation = $("#naList option:selected").val();
            if((cfcode=='')||(mdMedi=='')){
                Make_Toast("잘못된 매칭 정보 입니다.\n다시 시도하여 주세요.");
            }else {
                let dataarr = {"data1": snChecked,"cfcode":cfcode,"mdMedi":mdMedi,"mmMedi" : mmmedi};
                let url = APIURL + '/Del_Match_Data';
                let result = await Load_API(url, dataarr);
                if (result.get('status') == 'NoLogin') {
                    go_login();
                } else if (result.get('status') == 'ok') {
                    Form_ini3();
                    Load_Decoc_Match(cfcode,mdMedi,mmmedi,nation);

                    let eCnt = result.get('data').Match;
                    $('#list_' + seq).text("매칭[" + eCnt + "개]");
                    Make_Toast('매칭 삭제 완료 되었습니다.');
                }
            }
        }else{
            Make_Toast('매칭 삭제 하실 약재를 선택하세요.');
        }
        stop_spinner();
    }catch(error){
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}


async function Insert_Match_Data(){
    try{
        start_spinner();
        let hncodeChecked = $('input[name="matchcode"]:checked').map(function() {
            return this.value;
        }).get();

        let codeCnt = hncodeChecked.length;
        if(codeCnt>0){

            let cfcode=  $('#btn_match').data('cfcode');
            let mdMedi = $('#btn_match').data('meMed');
            let mm_medicine = $('#btn_match').data('medicine');
            let mm_origin = $('#btn_match').data('origin');
            let md_title_kor = $('#btn_match').data('title');
            let md_maker = $('#btn_match').data('maker');
            let seq = $('#btn_match').data('seq');
            let mm_stock = $('#mm_stock').val();
            let nation = $("#naList option:selected").val();

            if((mm_medicine=='')||(mm_origin=='')||(md_title_kor=='')||(md_maker=='')){
                Make_Toast("잘못된 매칭 정보 입니다.\n다시 시도하여 주세요.");
            }else {
                let dataarr = {"data1": hncodeChecked,"cfcode":cfcode,"mdMedi":mdMedi,"mm_medicine": mm_medicine,"mm_origin": mm_origin,"md_title_kor": md_title_kor,"md_maker": md_maker,"mm_stock" : mm_stock};
                let url = APIURL + '/Insert_Match_Data';
                let result = await Load_API(url, dataarr);
                if (result.get('status') == 'NoLogin') {
                    go_login();
                } else if (result.get('status') == 'ok') {
                    Form_ini3();
                    Load_Decoc_Match(cfcode,mdMedi,mm_medicine,nation);

                    let eCnt = result.get('data').Match;
                    $('#list_' + seq).text("매칭[" + eCnt + "개]");
                    Make_Toast('매칭 완료 되었습니다.');
                }
            }
        }else{
            Make_Toast('매칭 하실 약재를 선택하세요.');
        }
        stop_spinner();
    }catch(error){
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}


function INI_Matching_pop() {
    $('#yaklist').empty();
    $('#yaknation').html('');
    $('#yakcode').html('');
    $('#yakname').html('');
    $('#yakcompany').val();
    $('#yakherb').val();
    $('#popMatch').data('hncode', '');
    $('#popMatch').data('mm_origin', '');
    $('#popMatch').data('mm_medicine', '');
    $('#popMatch').data('mm_title_kor', '');
    $('#popMatch').data('mm_origin_kor', '');
}



function Form_ini(){
    $('#HD_List').empty();
    $('#HD_List').css('display','none');
    $('.btn_cho').removeClass("checkedGreen");
    $('#herbList').empty();
}

function Form_ini2(){
    $('#btn_match').data('medicine','');
    $('#btn_match').data('origin','');
    $('#btn_match').data('title','');
    $('#btn_match').data('maker','');
    $('#btn_match').data('cfcode','');
    $('#btn_match').data('meMed','');
    $('#btn_match').data('seq','');

    $('#btn_match_del').data('cfcode','');
    $('#btn_match_del').data('meMed','');
    $('#btn_match_del').data('medicine','');


    $('#yaklist1').empty();
    $('#yaklist2').empty();
}

function Form_ini3(){
    $('#yaklist1').empty();
    $('#yaklist2').empty();
}

function pop_match(seq,cfcode,mdMedi,medicine,title,mmorigin,maker,origin){
    Form_ini2();

    $('#btn_match').data('medicine',medicine);
    $('#btn_match').data('origin',mmorigin);
    $('#btn_match').data('title',title);
    $('#btn_match').data('maker',maker);
    $('#btn_match').data('cfcode',cfcode);
    $('#btn_match').data('meMed',mdMedi);
    $('#btn_match').data('seq',seq);
    $('#btn_match_del').data('cfcode',cfcode);
    $('#btn_match_del').data('meMed',mdMedi);
    $('#btn_match_del').data('medicine',medicine);


    Load_Decoc_Match(cfcode,mdMedi,medicine,origin);
    $('#matchingpop').show();
}


async function Load_Decoc_Match(cfcode,mdMedi,medicine,nation){
    try{
        start_spinner();
        let dataarr = {"cf": cfcode,"mdMedi" : mdMedi,"mmcode" : medicine,"nation":nation};
        let url = APIURL + '/Load_Decoc_Match_Info';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if(result.get('status') == 'ok') {
            let html1 = '';
            let html2 = '';
            let arr1 = result.get('data').list1;
            let arr2 = result.get('data').list2;
            let Cnt1 = arr1.length;
            let Cnt2 = arr2.length;

            console.log('arr1=' + Cnt1);
            console.log('arr2=' + Cnt2);


            let opstr = '';
            if (Cnt1 > 0) {
                $.each(arr1, function (index, el) {
                    opstr = '';
                    if((el.t1_value!='')&&(el.t2_value!='')) {
                        opstr += `/${el.t1_value}/${el.t2_value}`;
                    }else if((el.t1_value!='')&&(el.t2_value=='')){
                        opstr += `/${el.t1_value}`;
                    }else if((el.t1_value=='')&&(el.t2_value!='')){
                        opstr += `/${el.t2_value}`;
                    }

                    html1 += `
                        <div class="list flexType2"> 
                        <label for="hello" class="line" id="" name="mdmedilist">
                            <input type="checkbox" id="" name="delcode" class="checkbox" value="${el.sn}">  
                        </label>
                        <p class="herbName" id="" name="yakname2">[${el.n_value}]${el.hn_name}(${el.w_name}${opstr})${el.mi_name}</p>  
                        </div> 
                    `;
                });
                $('#yaklist1').append(html1);
            }

            if (Cnt2 > 0) {
                $.each(arr2, function (index, el) {
                    opstr = '';
                    if((el.t1_value!='')&&(el.t2_value!='')) {
                        opstr += `/${el.t1_value}/${el.t2_value}`;
                    }else if((el.t1_value!='')&&(el.t2_value=='')){
                        opstr += `/${el.t1_value}`;
                    }else if((el.t1_value=='')&&(el.t2_value!='')){
                        opstr += `/${el.t2_value}`;
                    }
                    html2 += `
                        <div class="list flexType2"> 
                        <label for="hello" class="line" id="" name="mdmedilist">
                            <input type="checkbox" id="" name="matchcode" class="checkbox" value="${el.hn_code}">  
                        </label>
                        <p class="herbName" id="" name="yakname2">[${el.n_value}]${el.hn_name}(${el.w_name}${opstr})${el.mi_name}</p>  
                        </div> 
                    `;
                });
                $('#yaklist2').append(html2);
            }
        }else {
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    }catch(error){
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }

}



async function Load_Decoc_Herb(code,cfcode,orgin){
    try {
        start_spinner();
        let dataarr = {"medicode": code, "cfcode": cfcode,"orgin" : orgin};
        let url = APIURL + '/Load_Decoc_Herb_List';
        let result = await Load_API(url,dataarr);
        if (result.get('status') == 'NoLogin') {
            go_login();
        } else if(result.get('status') == 'ok') {
            let html = '';
            let data = result.get('data');
            let arr = (data && data.list) ? data.list : [];
            let Cnt = arr.length;
            if (Cnt > 0) {
                $.each(arr, function (index, el) {
                    html += `
                        <tr >
                            <td>${el.mdMedi} / ${el.mdMediName}</td>
                            <td>${el.mm_medicine}</td>
                            <td>${el.md_title_kor}</td>
                            <td>${el.md_maker}</td>
                            <td>${el.mm_origin}</td>
                            <td><button class="editHerb" type="button" id="list_${el.mm_seq}" onclick="pop_match(${el.mm_seq},'${cfcode}','${el.mdMedi}','${el.mm_medicine}','${el.md_title_kor}','${el.mm_origin}','${el.md_maker}','${orgin}');" >매칭[${el.m_cnt}개]</button></td>
                        </tr>    
                    `;
                });
                $('#herbList').append(html);
            }else{
                Make_Toast('검색하신 약재 결과가 없습니다.');
            }
        }else{
            Make_Toast(result.get('message'));
        }
        stop_spinner();
    } catch (error) {
        Make_Toast('오류가 발생하였습니다. 다시 시도하여주세요.\n[ERROR : ' + error + '}');
        stop_spinner();
    }
}
