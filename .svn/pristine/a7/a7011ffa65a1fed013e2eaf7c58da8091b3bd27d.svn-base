<?php

namespace App\Controllers;

use App\Libraries\Form;
use App\Libraries\Utils;
use App\Model;
use CodeIgniter\API\ResponseTrait;

class HerbDecocController extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $util = New Utils;
        $util->fnCheck_Auth(AUTH_DECOC);

    }

    public function herbList(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else {
            $request = service('request');
            $skey = ($request->getPost('skey')=='') ? '' : $request->getPost('skey');
            $page = ($request->getPost('page')=='') ? 1 : $request->getPost('page');
            $limit = 50;

            $s_data = array();

            $metaarr = array(
                'h_title' => '약재리스트',
                'h_type' => 1
            );

            $body = array(
                'skey' => $skey,
                'page' => $page,
                'limit' => $limit
            );

            $form = new Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr),
                'search' => $form->fnMake_Search($s_data),
                'body' => $body

            );

            return view('web/decoc/herbListDec_View', $main_data);
        }
    }

    public function orderList(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else{
            $mi_type = $sessinarr['user']['mi_type'];
            $metaarr = array(
                'h_title' => '주문내역',
                'h_type' => 1
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

            return view('web/decoc/orderListDec_View', $main_data);
        }
    }


    public function orderDetail(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else{
            $mi_type = $sessinarr['user']['mi_type'];
            $metaarr = array(
                'h_title' => '상품등록',
                'h_type' => 1
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

            return view('web/decoc/orderDetailDec_View', $main_data);
        }
    }

    public function popMaching(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else{
            $mi_type = $sessinarr['user']['mi_type'];
            $metaarr = array(
                'h_title' => '상품등록',
                'h_type' => 1
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

            return view('web/include/pop_Matching_View', $main_data);
        }
    }


    public function putList(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else{
            $mi_type = $sessinarr['user']['mi_type'];
            $metaarr = array(
                'h_title' => '약재 입고 관리',
                'h_type' => 1
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

            return view('web/decoc/putListDec_View', $main_data);
        }
    }

    public function deliveryList(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else{
            $mi_type = $sessinarr['user']['mi_type'];
            $metaarr = array(
                'h_title' => '상품등록',
                'h_type' => 1
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

            return view('web/decoc/deliveryListDec_View', $main_data);
        }
    }

    public function deliveryInfo(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else{
            $mi_type = $sessinarr['user']['mi_type'];
            $metaarr = array(
                'h_title' => '상품등록',
                'h_type' => 1
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

            return view('web/decoc/deliveryInfo_View', $main_data);
        }
    }

    public function confirmOrder(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else{
            $mi_type = $sessinarr['user']['mi_type'];
            $metaarr = array(
                'h_title' => '디제이메디 > 상품등록',
                'h_type' => 1
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

            return view('web/include/pop_ConfirmOrder_View', $main_data);
        }
    }


    public function deliveryStatus(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else{
            $mi_type = $sessinarr['user']['mi_type'];
            $metaarr = array(
                'h_title' => '상품등록',
                'h_type' => 1
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

            return view('web/include/pop_DeliveryStatus_View', $main_data);
        }
    }

    public function cancelCheck(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else{
            $mi_type = $sessinarr['user']['mi_type'];
            $metaarr = array(
                'h_title' => '상품등록',
                'h_type' => 1
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

            return view('web/include/pop_CancelCheck_View', $main_data);
        }
    }

    public function stockListDecoc(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else{
            $mi_type = $sessinarr['user']['mi_type'];
            $metaarr = array(
                'h_title' => '상품등록',
                'h_type' => 1
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

            return view('web/decoc/stockListDecoc_View', $main_data);
        }
    }


    public function dashBoard(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else{
            $mi_type = $sessinarr['user']['mi_type'];
            $metaarr = array(
                'h_title' => '상품등록',
                'h_type' => 1
            );

            $form = New Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

            return view('web/decoc/dashBoard_View', $main_data);
        }
    }



}
