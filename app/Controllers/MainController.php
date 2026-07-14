<?php

namespace App\Controllers;


use App\Libraries\Form;
use App\Libraries\Utils;
use CodeIgniter\API\ResponseTrait;


class MainController extends BaseController
{

    use ResponseTrait;

    public function Main()
    {
        $sessinarr = $this->GetSessionData();
        $metaarr = [
            'h_title' => '디제이메디',
            'h_type' => 1
        ];

        $form = New Form;
        $main_data = [
            'meta' => $form->fnMake_Meta($metaarr),
            'header' => $form->fnMake_Header($sessinarr),
            'left_menu' => $form->fnMake_Left($sessinarr),
            'body' => ''
        ];

        if (!fn_MobileCheck()) {
            return view('web/common/main_View', $main_data);
        } else {
            return view('mobile/common/react_container', $main_data);
        }
    }


    public function Main1($skey=false)
    {
        $sessinarr = $this->GetSessionData();
        $metaarr = [
            'h_title' => '디제이메디',
            'h_type' => 1
        ];

        $bodydata = [];
        $bodydata['skey'] = $skey;
        $herb_m=model('Herb_m');
        $tCnt = 10;
        $Rs = $herb_m->Load_Product_limit($tCnt);
        if(fn_ArrayCnt($Rs)>0){
            $dataarr = [];
            foreach($Rs as $d){
                if($d['hn_isok'] == 100){
                    $temparr = [];

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
                    $temparr['t1_value'] = ($d['fk_t1code']=='0') ? '' : $d['t1_value'];
                    $temparr['fk_t2code'] = $d['fk_t2code'];
                    $temparr['t2_value'] = $d['t2_value'];
                    $temparr['fk_wcode'] = $d['fk_wcode'];
                    $temparr['w_value'] = $d['w_value'];
                    $temparr['w_name'] = $d['w_name'];
                    $temparr['hn_name'] = $d['hn_name'];

                    $temparr['hn_sale'] = $d['hn_sale'];
                    $temparr['hn_MakeDate'] = fn_Short_Date($d['hn_MakeDate']);
                    $temparr['hn_sellSDate'] = fn_Short_Date($d['hn_sellSDate']);
                    $temparr['hn_sellEDate'] = fn_Short_Date($d['hn_sellEDate']);
                    $temparr['hn_tax'] = $d['hn_tax'];
                    $temparr['hn_desc'] = $d['hn_desc'];
                    $temparr['hn_isSell'] = $d['hn_isSell'];
                    $temparr['sn'] = $d['sn'];
                    $temparr['hn_isok'] = $d['hn_isok'];
                    $temparr['hn_regdate'] = $d['hn_regdate'];
                    $temparr['fname'] = $d['thumnail'];


                    if (!$sessinarr['islogin']) {
                        $temparr['hn_gPrice'] = '';
                        $temparr['hn_pPrice'] = '';
                        $temparr['hn_method'] = '';
                        $temparr['login_Type'] = '';
                        $auth = '';

                        array_push($dataarr,$temparr);
                    }else{
                        $auth = $sessinarr['user']['mi_type'];
                        $micode = $sessinarr['user']['mi_code'];
                        $cfcode = $sessinarr['user']['mi_cf'];
                        if($auth==AUTH_PHARM){
                            $temparr['hn_gPrice'] = '';
                            $temparr['hn_pPrice'] = '';
                            $temparr['hn_method'] = '1';
                            $temparr['hn_like'] = 0;

                            array_push($dataarr,$temparr);

                            $temparr['hn_gPrice'] = '';
                            $temparr['hn_pPrice'] = '';
                            $temparr['hn_method'] = '2';
                            $temparr['hn_like'] = 0;

                            array_push($dataarr,$temparr);
                        }else{


                            $pricearr = $this->LoadPrice($d['hn_code']);
                            $temparr['hn_gPrice'] = $pricearr[0]['hn_gPrice'];
                            $temparr['hn_pPrice'] = $pricearr[0]['hn_pPrice'];
                            $temparr['hn_method'] = $pricearr[0]['hn_method'];
                            $temparr['hn_like'] = $herb_m->Cnt_Product_Like($d['hn_code'],$micode,$pricearr[0]['hn_method']);

                            array_push($dataarr,$temparr);

                            $temparr['hn_gPrice'] = $pricearr[1]['hn_gPrice'];
                            $temparr['hn_pPrice'] = $pricearr[1]['hn_pPrice'];
                            $temparr['hn_method'] = $pricearr[1]['hn_method'];
                            $temparr['hn_like'] = $herb_m->Cnt_Product_Like($d['hn_code'],$micode,$pricearr[1]['hn_method']);

                            array_push($dataarr,$temparr);

                        }
                    }
                }
            }

            shuffle($dataarr);

            $bodydata['hot'] = $dataarr;
            $bodydata['deal'] = $dataarr;
            $bodydata['event'] = $dataarr;
            $bodydata['l_Type'] = '';
            //$bodydata['stock'] = $stockarr;
            $bodydata['login'] = $sessinarr['islogin'];
        }else{
            $bodydata['hot'] = [];
            $bodydata['deal'] = [];
            $bodydata['event'] = [];
            $bodydata['l_Type'] = '';
            //$bodydata['stock'] = [];
            $bodydata['login'] = false;
        }

        print_r($bodydata);

        $form = New Form;
        $main_data = [
            'meta' => $form->fnMake_Meta($metaarr),
            'header' => $form->fnMake_Header($sessinarr),
            'left_menu' => $form->fnMake_Left($sessinarr),
            'body' => $bodydata
        ];

        if (!fn_MobileCheck()) {
            return view('web/common/main_ver4_View', $main_data);
        } else {
            return view('mobile/common/react_container', $main_data);
        }
    }
}
