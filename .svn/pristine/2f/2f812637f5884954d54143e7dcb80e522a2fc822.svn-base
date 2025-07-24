<?php

namespace App\Controllers;


use App\Libraries\Form;
use App\Libraries\Utils;
use CodeIgniter\API\ResponseTrait;


class CommonController extends BaseController
{
    use ResponseTrait;

    public function itemDetail(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();

        $request = service('request');
        $hncode = ($request->getGet('hd') == '') ? '' : $request->getGet('hd');
        if($hncode==''){
            $util->fnalert('잘못된 접근입니다.');
        }else{
            $metaarr = array(
                'h_title' => '디제이메디',
                'h_type' => 1
            );

            $herb_m = model('Herb_m');
            $Rs = $herb_m->Load_Product_Code($hncode);
            if($util->fnArrayCnt($Rs)<=0){
                $util->fnalert("선택하신 상품은 판매중지되었거나,\n존재하지 않는 약재입니다.");
            }else{
                $info = array();

                $info['thumnail'] = $Rs[0]['thumnail'];
                $info['hn_code'] = $Rs[0]['hn_code'];
                $info['hn_name'] = $Rs[0]['hn_name'];
                $info['w_name'] = $Rs[0]['w_name'];
                $info['t1_value'] = $Rs[0]['t1_value'];
                $info['t2_value'] = $Rs[0]['t2_value'];
                $info['n_value'] = $Rs[0]['n_value'];
                $info['mi_name'] = $Rs[0]['mi_name'];
                $info['hn_sellSDate'] = $Rs[0]['hn_sellSDate'];
                $info['hn_sellEDate'] = $Rs[0]['hn_sellEDate'];
                $info['hn_bigsell'] = $Rs[0]['hn_bigsell'];
                $info['hn_desc'] = $Rs[0]['hn_desc'];



                $price = $util->fnLoadPrice($hncode);

                $data = array(
                    'info' => $info,
                    'price' => $price
                );

                $form = New Form;
                $main_data = array(
                    'meta' => $form->fnMake_Meta($metaarr),
                    'header' => $form->fnMake_Header($sessinarr),
                    'body' => $data
                );

                return view('web/common/itemDetail_View',$main_data);

            }
        }
    }

    public function pList(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if($sessinarr['islogin']==false) {
            $mi_type = '';
            $util->fnAlert('로그인이 필요합니다. ','/Member/Login');
        }else {
            $request = service('request');
            $l_typ = ($request->getGet('lp') == '') ? '1' : $request->getGet('lp');
            $sKey = ($request->getGet('skey') == '') ? '' : $request->getGet('skey');
            $page = ($request->getGet('page') == '') ? 1 : $request->getGet('page');

            $header_arr = array(
                'skey' => $sKey
            );


            $metaarr = array(
                'h_title' => '상품 리스트',
                'h_type' => 1
            );

            $limit = 30;
            $offset = $limit * ($page - 1);

            $member_m = model('Member_m');
            $mRs = $member_m->Load_Company_miType('pharm');
            if($util->fnArrayCnt($mRs)>0){
                $option = '';
                foreach ($mRs as $d){
                    $option .= "<option value='{$d['mi_code']}'>{$d['mi_name']}</option>";
                }
            }

            $bodydata = array(
                'page'=> $page,
                'typ' => $l_typ,
                'option' => $option
            );

            $form = new Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr,$header_arr),
                'left_menu' => $form->fnMake_Left($sessinarr),
                'body' => $bodydata
            );

            if($l_typ==1) {
                return view('web/common/mainThum_View', $main_data);
            }else{
                return view('web/common/mainList_View', $main_data);
            }
        }
    }

    public function mainList($skey=false){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();

        $request = service('request');

        $metaarr = array(
            'h_title' => '상품 리스트',
            'h_type' => 1
        );

        if($sessinarr['islogin']==true) {
            $mi_type = $sessinarr['user']['mi_type'];
            $uid = $sessinarr['user']['uid'];
        }  else {
            $mi_type = '';
            $url = '/';
            $util->fnAlert('로그인 세션이 만료되었습니다. ',$url);
        }

        $bodydata = array();
        $bodydata['skey'] = $skey;
        $herb_m = model('Herb_m');
        if($skey=='') {
            $Rs = $herb_m->Load_Product_All();
        }else{
            $Rs = $herb_m->Load_Product2($mi_code,$skey);
        }
        if($util->fnArrayCnt($Rs)>0){
            $dataarr = array();
            foreach($Rs as $d){
                if($d['hn_isok'] == 100){
                    $temparr = array();

                    $temparr['sn'] = $d['sn'];
                    $temparr['hn_ID'] = $d['hn_ID'];
                    $temparr['hn_code'] = $d['hn_code'];
                    $temparr['fk_mdcode'] = $d['fk_mdcode'];
                    $temparr['fk_mdname'] = $d['fk_mdname'];
                    $temparr['fk_micode'] = $d['fk_micode'];
                    $temparr['mi_name'] = $d['mi_name'];
                    $temparr['fk_ncode'] = $d['fk_ncode'];
                    $temparr['n_value'] = $d['n_value'];

                    $temparr['fk_t1code'] = $d['fk_t1code'];
                    $temparr['t1_value'] = ($d['fk_t1code']=='0') ? '-' : $d['t1_value'];
                    $temparr['fk_t2code'] = $d['fk_t2code'];
                    $temparr['t2_value'] = $d['t2_value'];
                    $temparr['fk_wcode'] = $d['fk_wcode'];
                    $temparr['w_value'] = $d['w_value'];
                    $temparr['w_name'] = $d['w_name'];
                    $temparr['hn_name'] = $d['hn_name'];

                    $temparr['hn_sale'] = $d['hn_sale'];
                    $temparr['hn_MakeDate'] = $util->fnShort_Date($d['hn_MakeDate']);
                    $temparr['hn_sellSDate'] = $util->fnShort_Date($d['hn_sellSDate']);
                    $temparr['hn_sellEDate'] = $util->fnShort_Date($d['hn_sellEDate']);
                    $temparr['hn_tax'] = $d['hn_tax'];
                    $temparr['hn_desc'] = $d['hn_desc'];
                    $temparr['hn_isSell'] = $d['hn_isSell'];
                    $temparr['sn'] = $d['sn'];
                    $temparr['hn_isok'] = $d['hn_isok'];
                    $temparr['hn_regdate'] = $d['hn_regdate'];
                    $temparr['fname'] = $d['thumnail'];

                    $pRs = $herb_m->Load_Product_Price_Type($d['hn_code'],1);
                    if($util->fnArrayCnt($pRs)>0) {
                        $temparr['hn_gPrice'] = $pRs[0]['hn_gPrice'];
                        $temparr['hn_pPrice'] = $pRs[0]['hn_pPrice'];
                        $temparr['hn_method'] = $pRs[0]['hn_method'];
                    }else{
                        $temparr['hn_gPrice'] = '';
                        $temparr['hn_pPrice'] = '';
                        $temparr['hn_method'] = '';
                    }


                    array_push($dataarr,$temparr);
                }
            }
            $bodydata['list'] = $dataarr;
        }else{
            $bodydata['list'] = array();
        }



        $form = New Form;
        $main_data = array(
            'meta' => $form->fnMake_Meta($metaarr),
            'header' => $form->fnMake_Header($sessinarr),
            'left_menu' => $form->fnMake_Left($sessinarr),
            'body' => $bodydata
        );

        return view('web/common/mainList_View',$main_data);
    }
}