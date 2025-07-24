<?php

namespace App\Controllers;

use App\Models;
use App\Libraries\Utils;
use App\Libraries\Auth;
use App\Libraries\Form;

class MypageController extends BaseController
{
    public function Mypage(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('messge','로그인이 필요합니다');
        }else {

            $metaarr = array(
                'h_title' => '상품등록',
                'h_type' => 1
            );

            $form = new Form;
            $main_data = array(
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            );

//            if($sessinarr['mi_type']=='pharm') {
//                return view('web/dashBoard_View', $main_data);
//            }else if($sessinarr['mi_type']=='decoc') {
//                return view('web/dashBoard_View', $main_data);
//            }else if($sessinarr['mi_type']=='master') {
//                return view('web/dashBoard_View', $main_data);
//            }

            return view('web/dashBoard_View', $main_data);
        }
    }


    
    
    
    


}
