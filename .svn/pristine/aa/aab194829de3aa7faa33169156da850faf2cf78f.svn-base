<?php

namespace App\Controllers;

use App\Models;
use App\Libraries\Utils;
use App\Libraries\Form;

class OrderController extends BaseController
{
    public function __construct()
    {
        $util = New Utils;
        $util->fnCheck_Auth(AUTH_DECOC);

    }

    public function SmartOrder(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else {
            $mi_code = $sessinarr['user']['mi_code'];

            $order_m=model('Order_m');
            $Rs =$order_m->Load_Company($mi_code);
            $cfcode = $Rs[0]['mi_cfcode'];

            $s_data = array();

            $metaarr = array(
                'h_title' => '스마트 오더',
                'h_type' => 1
            );

            $body = array(
                'cfcode' => $cfcode
            );


            $form = new Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'search' => $form->fnMake_Search($s_data),
                'body' => $body

            );

            return view('web/decoc/smartOrder_View', $main_data);
        }
    }

    public function OList(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        $s_data = array();

        $metaarr = array(
            'h_title' => '상품리스트',
            'h_type' => 1
        );

        $form = New Form;
        $main_data = array(
            'meta' => $form->fnMake_Meta($metaarr),
            'header' => $form->fnMake_Header($sessinarr),
            'search' => $form->fnMake_Search($s_data)

        );
        
        return view('web/myOrderListDec_View',$main_data);
    }

    public function Cart(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        $s_data = array();

        $metaarr = array(
            'h_title' => '장바구니',
            'h_type' => 1
        );
        $left_menu = array();

        $form = New Form;
        $main_data = array(
            'meta' => $form->fnMake_Meta($metaarr),
            'header' => $form->fnMake_Header($sessinarr),
            'search' => $form->fnMake_Search($s_data),
            'left_menu' => $left_menu 

        );

        return view('web/decoc/cart_View',$main_data);
    }



}
