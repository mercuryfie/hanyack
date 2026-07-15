<?php

namespace App\Controllers;


use App\Libraries\Form;
use App\Libraries\Utils;
use CodeIgniter\API\ResponseTrait;


class CommonController extends BaseController
{
    use ResponseTrait;


    public function herbList()
    {
        $sessinarr = $this->GetSessionData();

        $skey = $this->request->getGet('hd') ?? '';
        if($sessinarr['islogin']==false) {
            $mi_type = '';
            fn_Alert('로그인이 필요합니다. ','/Member/Login');
        }else {
            $header_arr = [
                'skey' => $skey
            ];
            $metaarr = [
                'h_title' => '상품 리스트',
                'h_type' => 1
            ];

            $member_m = model('Member_m');
            $mRs = $member_m->Load_Company_miType('pharm');
            if(fn_ArrayCnt($mRs)>0){
                $option = '';
                foreach ($mRs as $d){
                    $option .= "<option value='{$d['mi_code']}'>{$d['mi_name']}</option>";
                }
            }

            $bodydata = [
                'pcnt' => 16,
                'option' => $option
            ];

            $form = new Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr,$header_arr),
                'left_menu' => $form->fnMake_Left($sessinarr),
                'body' => $bodydata
            ];

            return view('web/common/mainThum_View', $main_data);
        }
    }

    public function itemDetail()
    {
        $sessinarr = $this->GetSessionData();

        $hncode = ($this->request->getGet('hd') == '') ? '' : $this->request->getGet('hd');
        $ptype = ($this->request->getGet('pt') == '') ? 1 : $this->request->getGet('pt');
        if($hncode=='') {
            fn_Alert('잘못된 접근입니다.');
            return;
        }
        $metaarr = [
            'h_title' => '디제이메디',
            'h_type' => 1
        ];
        $herb_m = model('Herb_m');
        $Rs = $herb_m->Load_Pharm_Info($hncode);
        if(empty($Rs)){
            fn_Alert("선택하신 상품은 판매중지되었거나,\n존재하지 않는 약재입니다.");
            return ;
        }
        $hn_package_type = $Rs[0]['hn_package_type'];
        $hn_package_cnt = $Rs[0]['hn_package_cnt'];
        $hn_price = $Rs[0]['price'];
        $hn_weight = $Rs[0]['w_value'];
        $info = [
            'thumnail' => $Rs[0]['thumnail'],
            'hn_code' => $Rs[0]['hn_code'],
            'hn_name' => $Rs[0]['hn_name'],
            'w_name' => $Rs[0]['w_name'],
            'w_value' => $hn_weight,
            't1_value' => $Rs[0]['t1_name'],
            't2_value' => $Rs[0]['t2_name'],
            'option' => $this->Product_Option_str($Rs[0]['t1_name'],$Rs[0]['t2_name']),
            'n_value' => $Rs[0]['n_value'],
            'mi_name' => $Rs[0]['mi_name'],
            'hn_product_date' => fn_Short_Date($Rs[0]['hn_product_date']),
            'hn_expired_date' => fn_Short_Date($Rs[0]['hn_expired_date']),
            'hn_bigsell' => $Rs[0]['hn_bigsell'],
            'hn_desc' => $Rs[0]['hn_desc'],
            'hn_package_type' => $Rs[0]['hn_package_type'],
            'hn_package_cnt' => $Rs[0]['hn_package_cnt'],
            'unitPrice' => $hn_price
        ];
        if (!$sessinarr['islogin']) {
            $info['hn_like'] = 0;
            $info['hn_matched'] = 0;
            $auth = '';
            $match = [];
            $info['unitInfo'] = '';
        }else{
            $auth = $sessinarr['user']['mi_type'];
            $mi_cfcode = $sessinarr['user']['mi_cf'];
            if($auth==AUTH_PHARM){
                $info['hn_like'] = 0;
                $info['hn_matched'] = 0;
                $match = [];
                $info['unitInfo'] = '';
            }else{
                $mi_code = $sessinarr['user']['mi_code'];
                $info['hn_like'] = $herb_m->Cnt_Product_Like($hncode,$mi_code,$ptype);
                $match = $herb_m->Load_Product_Match_info2($mi_cfcode,$hncode);
                $info['hn_matched'] = fn_ArrayCnt($match);
                $info['unitInfo'] = $this->getUnitInfo($hn_package_type,$hn_package_cnt,$hn_weight,1,$hn_price);
            }
        }
        $data = [
            'info' => $info,
            'match' => $match,
            'auth' => $auth,
            'ptype' => $ptype,
            'pname' => $this->Order_Type_Name($ptype),
            'islogin' => $sessinarr['islogin']
        ];

        $form = New Form;
        $main_data = [
            'meta' => $form->fnMake_Meta($metaarr),
            'header' => $form->fnMake_Header($sessinarr),
            'body' => $data
        ];

        return view('web/common/itemDetail_View',$main_data);
    }


    public function itemDetail_m()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return redirect()->to('/Member/Login')->with('msg', '로그인이 필요합니다.');
        } else {

            $metaarr = [
                'h_title' => '상품등록',
                'h_type' => 1
            ];

            $form = new Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];

            return view('mobile/common/mainThum_View', $main_data);
        }
    }


}