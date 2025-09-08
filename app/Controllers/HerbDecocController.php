<?php

namespace App\Controllers;

require ROOTPATH .'vendor/autoload.php';

use App\Libraries\Form;
use App\Libraries\Utils;
use App\Model;
use CodeIgniter\API\ResponseTrait;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HerbDecocController extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $util = New Utils;
        $Auth = [AUTH_MASTER,AUTH_DECOC];
        $util->fn_Check_Auth($Auth);
    }


    function exportListToExcel($list, $filename = 'medicine_list.xlsx') {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 헤더 출력 (키 이름을 한글로 원하면 여기서 변경 가능)
        $headers = array_keys($list[0]);
        $sheet->fromArray($headers, NULL, 'A1');

        // 데이터 출력
        $data = [];
        foreach ($list as $item) {
            $data[] = array_values($item);
        }
        $sheet->fromArray($data, NULL, 'A2');

        // 엑셀 파일 쓰기
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        return $filename;
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

            $header_arr = [
                'skey' => $sKey
            ];


            $metaarr = [
                'h_title' => '상품 리스트',
                'h_type' => 1
            ];

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

            $bodydata = [
                'page'=> $page,
                'typ' => $l_typ,
                'option' => $option
            ];

            $form = new Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr,$header_arr),
                'left_menu' => $form->fnMake_Left($sessinarr),
                'body' => $bodydata
            ];

            if($l_typ==1) {
                return view('web/decoc/mainThum_View', $main_data);
            }else{
                return view('web/decoc/mainList_View', $main_data);
            }
        }
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

            $s_data = [];

            $metaarr = [
                'h_title' => '약재리스트',
                'h_type' => 1
            ];

            $body = [
                'skey' => $skey,
                'page' => $page,
                'limit' => $limit
            ];

            $form = new Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr),
                'search' => $form->fnMake_Search($s_data),
                'body' => $body
            ];

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
            $metaarr = [
                'h_title' => '주문내역',
                'h_type' => 1
            ];

            $form = New Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];

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
            $metaarr = [
                'h_title' => '상품등록',
                'h_type' => 1
            ];

            $form = New Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];
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
            $metaarr = [
                'h_title' => '상품등록',
                'h_type' => 1
            ];

            $form = New Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];

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
            $metaarr = [
                'h_title' => '약재 입고 관리',
                'h_type' => 1
            ];

            $form = New Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];

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
            $metaarr = [
                'h_title' => '상품등록',
                'h_type' => 1
            ];

            $form = New Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];

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
            $metaarr = [
                'h_title' => '상품등록',
                'h_type' => 1
            ];

            $form = New Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];

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
            $metaarr = [
                'h_title' => '디제이메디 > 상품등록',
                'h_type' => 1
            ];

            $form = New Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];

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
            $metaarr = [
                'h_title' => '상품등록',
                'h_type' => 1
            ];

            $form = New Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];

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
            $metaarr = [
                'h_title' => '상품등록',
                'h_type' => 1
            ];

            $form = New Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];

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
            $metaarr = [
                'h_title' => '사용약재 리스트',
                'h_type' => 1
            ];

            $form = New Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];

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
            $metaarr = [
                'h_title' => '상품등록',
                'h_type' => 1
            ];

            $form = New Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr)
            ];

            return view('web/decoc/dashBoard_View', $main_data);
        }
    }

    public function claim(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else {
            $request = service('request');
            $skey = ($request->getPost('skey')=='') ? '' : $request->getPost('skey');
            $page = ($request->getPost('page')=='') ? 1 : $request->getPost('page');
            $limit = 50;

            $s_data = [];

            $metaarr = [
                'h_title' => '약재리스트',
                'h_type' => 1
            ];

            $body = [
                'skey' => $skey,
                'page' => $page,
                'limit' => $limit
            ];

            $form = new Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr),
                'search' => $form->fnMake_Search($s_data),
                'body' => $body
            ];

            return view('web/decoc/claim_View', $main_data);
        }
    }


    public function claim_step2_(){
        $util = New Utils;
        $sessinarr = $util->fnGetSessionData();
        if(!$sessinarr['islogin']){
            return redirect()->to('/Member/Login')->with('msg','로그인이 필요합니다.');
        }else {
            $request = service('request');
            $skey = ($request->getPost('skey')=='') ? '' : $request->getPost('skey');
            $page = ($request->getPost('page')=='') ? 1 : $request->getPost('page');
            $limit = 50;

            $s_data = [];

            $metaarr = [
                'h_title' => '약재리스트',
                'h_type' => 1
            ];

            $body = [
                'skey' => $skey,
                'page' => $page,
                'limit' => $limit
            ];

            $form = new Form;
            $main_data = [
                'meta' => $form->fnMake_Meta($metaarr),
                'header' => $form->fnMake_Header($sessinarr),
                'left_menu' => $form->fnMake_Left($sessinarr),
                'search' => $form->fnMake_Search($s_data),
                'body' => $body
            ];

            return view('web/decoc/claimRefund_View', $main_data);
        }
    }




}
