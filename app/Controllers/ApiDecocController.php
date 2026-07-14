<?php

namespace App\Controllers;

use App\DTOs\ResultDTO;
use CodeIgniter\API\ResponseTrait;

class ApiDecocController extends BaseController
{
    use ResponseTrait;

    public function Cancel_Order(){
        $sn = ($this->request->getPost('sn') == '') ? '' : $this->request->getPost('sn');
        if ($sn == '') {
            $result = 'type101';
            $data = '';
            $message = '취소하실 주문 정보를 확인하여주세요.';
        } else {
            $order_m = model('Order_m');
            $Rs = $order_m->Load_Order_Goods($sn);
            if (fn_ArrayCnt($Rs) <= 0) {
                $result = 'error';
                $data = '';
                $message = '존재하지 않는 주문입니다.';
            } else {
                $d = $Rs[0];
                $micode = $d['od_wcode'];
                $wicode = $d['fk_micode'];
                $nowCnt = $d['gd_cnt'];
                $msg = '탕전실 주문취소';

                $param = [
                    'micode' => $micode,
                    'wicodde' => $wicode,
                    'process' => ORDER_CANCEL,
                    'nowCnt' => $nowCnt,
                    'msg' => $msg,
                    'sn' => $sn
                ];

                $bool = $this->CancelorReturn($param);
                if ($bool == true) {
                    $result = 'ok';
                    $data = '';
                    $message = 'success';
                } else {
                    $i_arr = [
                        'sn' => $sn
                    ];
                    $result = 'error';
                    $data = $i_arr;
                    $message = "취소처리에 실패 하였습니다.<br>다시 시도 하여주세요.";
                }
            }
        }

        $return = [
            'result' => $result,
            'info' => $data,
            'message' => $message
        ];
        return $this->respond($return);
    }

    public function Like_Do(){
        $hncode = ($this->request->getPost('code') == '') ? '' : $this->request->getPost('code');
        $ptype = ($this->request->getPost('ptype') == '') ? '' : $this->request->getPost('ptype');
        $act = ($this->request->getPost('act') == '') ? 1 : $this->request->getPost('act');
        if(($hncode=='') || ($ptype=='')){
            $result = 'AUTH_FAIL';
            $data = '';
            $message = '접근 권한이 없습니다.';
        }else {
            $sessinarr = $this->GetSessionData();
            if (!$sessinarr['islogin']) {
                $result = 'NoLogin';
                $data = '';
                $message = '로그인을 하셔야 합니다.';
            }else {
                $mi_type = $sessinarr['user']['mi_type'];
                if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
                    $result = 'AUTH_FAIL';
                    $data = '';
                    $message = '접근 권한이 없습니다.';
                } else {
                    $mi_code = $sessinarr['user']['mi_code'];
                    $param = [
                        'fk_hncode' => $hncode,
                        'mi_code' => $mi_code,
                        'ptype' => $ptype
                    ];
                    $herb_m = model('Herb_m');
                    if($act==1) {
                        $Cnt = $herb_m->Insert_Product_Like($param);
                    }else{
                        $Cnt = $herb_m->Delete_Product_Like($param);
                    }
                    $result = 'ok';
                    $data = '';
                    $message = 'success';
                }
            }
        }
        $return = [
            'result' => $result,
            'info' => $data,
            'message' => $message
        ];
        return $this->respond($return);
    }

    public function Process_Herb_Like(){
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $cfcode = $sessinarr['user']['mi_cf'];
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $hncode = $params['code'] ?? '';
        $act = $params['act'] ?? 1;

        $param = [
            'fk_hncode' => $hncode,
            'cfcode' => $cfcode,
            'ptype' => 1
        ];
        $herb_m = model('Herb_m');
        if($act==1) {
            $Cnt = $herb_m->Insert_Product_Like($param);
        }else{
            $Cnt = $herb_m->Delete_Product_Like($param);
        }

        $i_arr = ['ecnt' => $Cnt];
        return $this->respond(ResultDTO::success($i_arr));
    }


    public function Delete_Decoc_Order(){
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $cfcode = $sessinarr['user']['mi_cf'];
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $sn = $params['sn'] ?? '';
        if(empty($sn)){
            return $this->respond(ResultDTO::fail('Error004', [], '필수항목이 누락되었습니다.'));
        }
        $order_m = model('Order_m');
        $Rs = $order_m->Load_Order_Goods($sn);
        if(empty($Rs)){
            return $this->respond(ResultDTO::fail('Error005', [], '존재하지 않는 주문 상품입니다.'));
        }

        $param = [
            'cfcode' => $Rs[0]['cfcode'],
            'wicodde' => $Rs[0]['fk_micode'],
            'process' => ORDER_CANCEL,
            'nowCnt' => $Rs[0]['gd_cnt'],
            'msg' => '탕전실 주문취소',
            'sn' => $sn
        ];

        $bool = $this->CancelorReturn($param);
        if(!$bool){
            return $this->respond(ResultDTO::fail('Error005', [], '취소처리에 실패 하였습니다.<br>다시 시도 하여주세요.'));
        }
        $i_arr = ['ecnt' => 1];
        return $this->respond(ResultDTO::success($i_arr));
    }


    public function Load_Decoc_OrderList()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $cfcode = $sessinarr['user']['mi_cf'];
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $order_m = model('Order_m');
        $page = $params['page'] ?? 1;
        $searchName = $params['name'] ?? '';
        $datas = [
            'cfcode' => $cfcode,
            'name' => $searchName,
            'sdate' => $params['sdate'] ?? '',
            'edate' => $params['edate'] ?? '',
            'page' => $page,
            'pcnt' => $params['pcnt'] ?? '1'
        ];

        $list = [];
        $distinct = [];
        if(!empty($searchName)) {
            $dRs = $order_m->Distinct_Order_Decoc($datas);
            $distinct = array_column($dRs, 'fk_odcode');

            if(empty($distinct)){
                $i_arr = [
                    'list' => [],
                    'tcnt' =>0,
                    'nPage' => 1,
                    'totalRs' => 0
                ];
                return $this->respond(ResultDTO::success($i_arr));
            }
        }
        $totalRs = $order_m->Cnt_Order_Decoc_All($datas,$distinct);
        $oRs = $order_m->Load_Order_Decoc_All($datas,$distinct);
        if(!empty($oRs)){
            foreach($oRs as $d){
                $odcode = $d['od_code'];
                $cRs = $order_m->Load_Order_Decoc_Goods($cfcode,$odcode);
                if(empty($cRs)){
                    continue;
                }
                $t_data = [];
                foreach ($cRs as $f) {
                    if (fn_IsEmpty($f['gd_delicomplete'])) {
                        $diff2 = '';
                    } else {
                        $diff2 = fn_toDaysDiffUp($f['gd_delicomplete'], 7);
                    }

                    $t_data[] = [
                        'sn' => $f['primarysn'],
                        'hncode' => $f['hn_code'],
                        'fk_mdname' => $f['fk_mdname'],
                        'gd_cnt' => $f['gd_cnt'],
                        'gd_price' => $f['gd_price'],
                        'gd_rPrice' => $f['gd_rPrice'],
                        'gd_status' => $f['gd_status'],
                        'gd_delidate' => $f['gd_delidate'],
                        'delicode' => $f['delicode'],
                        'delitype' => $f['delitype'],
                        'hn_name' => $f['hn_name'],
                        'mi_name' => $f['mi_name'],
                        'n_value' => $f['n_value'],
                        't1_value' => $f['t1_name'],
                        't2_value' => $f['t2_name'],
                        'option_str' => $this->Product_Option_str($f['t1_name'], $f['t2_name']),
                        'w_name' => $f['w_name'],
                        'fname' => $f['thumnail'],
                        'od_regdate' => $f['od_regdate'],
                        'diff' => fn_toDaysDiffUp($f['od_regdate'], 4),
                        'diff2' => $diff2
                    ];
                }

                $list[] = [
                    'od_code' => $d['od_code'],
                    'od_cfcode' => $d['od_cfcode'],
                    'mi_name' => $d['mi_name'],
                    'mi_email' => $d['mi_busiemail'],
                    'mi_address' => $d['mi_busiaddr'],
                    'od_price' => $d['od_price'],
                    'regidate' => fn_Short_Date($d['od_regdate']),
                    'goods' => $t_data
                ];
            }
        }

        $i_arr = [
            'list' => $list,
            'tcnt' => count($list),
            'nPage' => $page+1,
            'totalRs' => $totalRs
        ];

        return $this->respond(ResultDTO::success($i_arr));
    }



    public function Add_Decoc_SingleOrder()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $cfcode = $sessinarr['user']['mi_cf'];
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $od_code = $this->Make_Code(3);
        $herb_m = model('Herb_m');
        $hnCode = $params['code'];
        $hnCnt = $params['cnt'];
        $hInfo = $herb_m->Load_Pharm_Info($hnCode);
        if(empty($hInfo)){
            return $this->respond(ResultDTO::fail('Error004', [], '존재하지 않는 악재정보입니다.'));
        }
        $hnPackageType = $hInfo[0]['hn_package_type'];
        $hnPackageCnt = $hInfo[0]['hn_package_cnt'];
        $hnUnitPrice = $hInfo[0]['price'];

        if($hnPackageType==1){
            $totalCnt = $hnCnt;
            $totalPrice = $hnUnitPrice * $hnCnt;
        }else{
            $totalCnt =  $hnPackageCnt * $hnCnt;
            $totalPrice = $totalCnt * $hnUnitPrice;
        }

        $goodsARr = [
            'gd_code' => $this->Make_Code(4),
            'fk_odcode' => $od_code,
            'fk_cfcode' => $cfcode,
            'fk_hncode' => $hnCode,
            'gd_price' => $totalPrice,
            'gd_cnt' => $totalCnt,
            'gd_rPrice' => $hnUnitPrice,
            'gd_delidate' => fn_AddDay(3, 1)
        ];
        $effec_goods = $herb_m->Insert_Order_Single_Goods($goodsARr);

        $orderArr = [
            'od_cfcode' => $cfcode,
            'od_code' =>$od_code,
            'od_price' => $totalPrice
        ];
        $effect_order = $herb_m->Insert_Order($orderArr);

        $i_arr = ['ecnt' => $effect_order];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Add_Decoc_OrderByCart()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $cfcode = $sessinarr['user']['mi_cf'];
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }

        $cartArr = [];
        $od_code = $this->Make_Code(3);
        $allPrice = 0;
        $herb_m = model('Herb_m');
        foreach($params as $item){
            $cartSn = $item['cartsn'];
            $hnCode = $item['code'];
            $hnCnt = $item['cnt'];
            $delidate = $item['delidate'];
            $hInfo = $herb_m->Load_Pharm_Info($hnCode);
            if(empty($hInfo)){
                continue;
            }
            $hnPackageType = $hInfo[0]['hn_package_type'];
            $hnPackageCnt = $hInfo[0]['hn_package_cnt'];
            $hnUnitPrice = $hInfo[0]['price'];

            if($hnPackageType==1){
                $totalCnt = $hnCnt;
                $totalPrice = $hnUnitPrice * $hnCnt;
            }else{
                $totalCnt =  $hnPackageCnt * $hnCnt;
                $totalPrice = $totalCnt * $hnUnitPrice;
            }

            $allPrice = $allPrice + $totalPrice;

            $goodsARr = [
                'gd_code' => $this->Make_Code(4),
                'fk_odcode' => $od_code,
                'fk_cfcode' => $cfcode,
                'fk_hncode' => $hnCode,
                'gd_price' => $totalPrice,
                'gd_cnt' => $totalCnt,
                'gd_rPrice' => $hnUnitPrice,
                'gd_delidate' => $delidate
            ];
            $effec_goods = $herb_m->Insert_Order_Single_Goods($goodsARr);
            if($effec_goods > 0){
                $herb_m->Delete_Cart($cartSn);
                $cartArr[] =$cartSn;
            }
       }
        if(!empty($cartArr)){
            $orderArr = [
                'od_cfcode' => $cfcode,
                'od_code' =>$od_code,
                'od_price' => $allPrice
            ];
            $effect_order = $herb_m->Insert_Order($orderArr);
        }

        $i_arr = [
            'list' => $cartArr,
            'tcnt' => count($cartArr)
        ];
        return $this->respond(ResultDTO::success($i_arr));


    }

    public function Del_Decoc_Cart()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $cartSn = $params['sn'] ?? '';
        if (empty($cartSn)) {
            return $this->respond(ResultDTO::fail('Error004', [], '필수항목이 누락되었습니다.'));
        }

        $herb_m = model('Herb_m');
        $result = $herb_m->Delete_Cart($cartSn);
        if($result<=0){
            return $this->respond(ResultDTO::fail('Error004', [], '삭제에 실패하였습니다.\n다시 시도하여주세요.'));
        }
        $i_arr = [
            'ecnt' => $result
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }



    public function Load_Decoc_Cart()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $cfcode = $sessinarr['user']['mi_cf'];
        $herb_m = model('Herb_m');
        $dRs = $herb_m->distinct_Cart($cfcode);
        if (empty($dRs)) {
            $i_arr = [
                'list' => [],
                'tcnt' => 0
            ];
            return $this->respond(ResultDTO::success($i_arr));
        }
        $data = [];
        foreach ($dRs as $d) {
            $m_arr = [];
            $sRs = $herb_m->Load_Cart_InfoByMaker($cfcode, $d['maker']);
            if (fn_ArrayCnt($sRs) > 0) {
                foreach ($sRs as $s) {
                    $t_arr = [
                        'sn' => $s['sn'],
                        'hnname' => $s['hn_name'],
                        'cfcode' => $s['cfcode'],
                        'macode' => $s['fk_macode'],
                        'maname' => $s['ma_name'],
                        'hncode' => $s['fk_hncode'],
                        'ptype' => $s['ct_pType'],
                        't_cnt' => $s['ct_cnt'],
                        'hn_package_type' => $s['hn_package_type'],
                        'hn_package_cnt' => $s['hn_package_cnt'],
                        't_gPrice' => $s['ct_gPrice'],
                        't_tPrice' => $s['ct_tPrice'],
                        'period' => $s['ct_pType'],
                        'regdate' => fn_Short_Date($s['ct_period']),
                        'hn_option' => $this->Product_Option_str($s['t1_name'],$s['t2_name']),
                        'w_name' => $s['w_name'],
                        'w_value' => $s['w_value'],
                        'n_value' => $s['n_value'],
                        't1_value' => $s['t1_name'],
                        't2_value' => $s['t2_name'],
                        'thumnail' => $s['thumnail'],
                        'LowCnt' => $this->LowPrice($s['fk_medicode'], $s['ct_gPrice'], $s['ct_pType'])
                    ];
                    $m_arr[] = $t_arr;
                    $maname = $s['ma_name'];
                    $macode = $s['fk_macode'];
                }

                $nCnt = fn_ArrayCnt($m_arr);
                $t_arr2 = [
                    'maname' => $maname,
                    'macode' => $macode,
                    'Cnt' => $nCnt,
                    'list' => $m_arr
                ];
                $data[] = $t_arr2;
            }
        }
        $i_arr = [
            'list' => $data,
            'tcnt' => count($data)
        ];
        return $this->respond(ResultDTO::success($i_arr));

    }

    public function Add_Decoc_Cart()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        $mi_code = $sessinarr['user']['mi_code'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $hncode = $params['code'] ?? '';
        $tcnt = $params['cnt'] ?? 0;
        if (empty($hncode)) {
            return $this->respond(ResultDTO::fail('Error004', [], '상품 코드가 누락되었습니다.'));
        }
        if (intval($tcnt) <= 0) {
            return $this->respond(ResultDTO::fail('Error005', [], '수량은 1개 이상이어야 합니다.'));
        }
        $herb_m = model('Herb_m');
        $hRs = $herb_m->Load_Pharm_Info($hncode);
        if (!is_array($hRs) || empty($hRs)) {
            return $this->respond(ResultDTO::fail('Error006', [], '존재 하지 않는 약재입니다.'));
        }
        $cfcode = $this->Load_CfCode($mi_code);
        $fk_macode = $hRs[0]['fk_micode'];
        $hnPackageType = $hRs[0]['hn_package_type'];
        $hnPackageCnt = $hRs[0]['hn_package_cnt'];
        $unitPrice = $hRs[0]['price'];
        $orderCnt = ($hnPackageType==1) ? $tcnt : ($tcnt * $hnPackageCnt);
        $totalPrice = $unitPrice * $orderCnt;

        $pRs = $herb_m->Load_Cart_InfoByHncode($cfcode, $hncode);
        if (!is_array($pRs) || empty($pRs)) {
            $t_arr = [
                'cfcode' => $cfcode,
                'fk_macode' => $fk_macode,
                'fk_hncode' => $hncode,
                'ct_pType' => 1,
                'ct_cnt' => $orderCnt,
                'ct_gPrice' => $unitPrice,
                'ct_tPrice' => $totalPrice,
                'ct_period' => 0
            ];
            $result  = $herb_m->Insert_Cart($t_arr);
        }else{
            $sn = $pRs[0]['sn'];
            $t_arr = [
                'ct_cnt' => ($pRs[0]['ct_cnt'] + $orderCnt),
                'ct_tPrice' => ($pRs[0]['ct_tPrice'] + $totalPrice)
            ];
            $result = $herb_m->Update_Cart($sn, $t_arr);
        }
        $i_arr = ['ecnt' => $result];
        return $this->respond(ResultDTO::success($i_arr));
    }



    public function Update_Decoc_Info()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $sn = $params['sn'] ?? '';
        if(empty($sn)){
            return $this->respond(ResultDTO::fail('Error004', [], '필수항목이 누락되었습니다.'));
        }
        $datas = $this->Make_Params($params);
        if (!is_array($datas) || empty($datas)) {
            return $this->respond(ResultDTO::fail('Error005', [], '업데이트 할 정보가 없습니다.'));
        }

        $herb_m = model('Herb_m');
        $Cnt = $herb_m->Update_Decoc_Medicine_Info($sn,$datas);

        $i_arr = ['ecnt' => $Cnt];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Load_Decoc_Match_Product()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $cfcode = $params['cfcode'] ?? '';
        $mm_medicine = $params['mm_medicine'] ?? '';
        if(empty($cfcode) || (empty($mm_medicine))){
            return $this->respond(ResultDTO::fail('Error005', [], '필수항목이 누락되었습니다.'));
        }

        $herb_m = model('Herb_m');
        $list = [];
        $fields = ['c.hn_code','c.hn_name','a.sn as matchedsn','a.mm_medicine','b.stock','b.stock_ware','b.stock_week','b.stock_month','b.is_manage','c.priceSn','c.fk_medicode','c.price','c.mi_name','c.w_name','c.w_value','c.n_value','c.t1_name','c.t2_name','c.hn_package_type','c.hn_package_cnt'];
        $cRs = $herb_m->Load_Decoc_Match_Product($cfcode,$mm_medicine,$fields);
        prn_Log($cRs);
        if(!empty($cRs)){
            foreach($cRs as $d){
                $orgin_price = $d['price'];
                $tStock = $d['stock'] + $d['stock_ware'];
                $stock_month = $d['stock_month'];
                $hn_package_type = $d['hn_package_type'];
                $hn_package_cnt = $d['hn_package_cnt'];
                $w_value = (($d['w_value']==null) || ($d['w_value']=='')) ? '600': $d['w_value'];
                if (($tStock * 0.1) < $stock_month) {
                    $needWeight = $stock_month - ($tStock * 0.1);
                    $temp_quantity = ceil($needWeight / $w_value);
                    if($hn_package_type==1){
                        $needed_quantity = $temp_quantity;
                    }else if($hn_package_type==2){
                        $needed_quantity = ceil($temp_quantity / $hn_package_cnt);
                    }
                } else {
                    $needed_quantity = 0;
                }

                if($hn_package_type==1){
                    $need_One = $orgin_price;
                    $need_Price = $needed_quantity * $orgin_price;
                }else{
                    $need_One = $orgin_price * $hn_package_cnt;
                    $need_Price = $needed_quantity * $need_One;
                }
                $t_arr = [
                    'hn_code' => $d['hn_code'],
                    'hn_name' => $d['hn_name'],
                    'mm_medicine' => $d['mm_medicine'],
                    'priceSn' => $d['priceSn'],
                    'medicode' => $d['fk_medicode'],
                    'price' => $d['price'],
                    'mi_name' => $d['mi_name'],
                    'w_name' => $d['w_name'],
                    'w_value' => $w_value,
                    'n_value' => $d['n_value'],
                    't1_name' => $d['t1_name'],
                    't2_name' => $d['t2_name'],
                    'is_manage' => $d['is_manage'],
                    'matchedsn' => $d['matchedsn'],
                    'hn_package_type' => $d['hn_package_type'],
                    'hn_package_cnt' => $d['hn_package_cnt'],
                    'guenPrice' => $this->calculatePricePerGeun($d['price'],$w_value),
                    'need' => $needed_quantity,
                    'needPrice' => $need_Price,
                    'needOne' => $need_One,
                    'option_str' => $this->Product_Option_str($d['t1_name'],$d['t2_name'])
                ];
                $list[] = $t_arr;
            }
        }

        $i_arr = ['list'=>$list,'tcnt' => count($cRs)];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Update_Medicine_Decoc_Match()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $f_type = $params['typ'] ?? '';
        if(empty($f_type)){
            return $this->respond(ResultDTO::fail('Error004', [], '필수항목이 누락되었습니다.'));
        }

        $cfcode = $params['cfcode'] ?? '';
        $mm_medicine = $params['mm_medicine'] ?? '';

        $herb_m = model('Herb_m');
        if($f_type==1){
            $MatchSn = $params['sn'] ?? '';

            if(empty($cfcode) || (empty($MatchSn))){
                return $this->respond(ResultDTO::fail('Error005', [], '필수항목이 누락되었습니다.'));
            }
            $chceckCnt = $herb_m->Count_Medicine_Decoc_Match($cfcode,$MatchSn);
            if($chceckCnt==0){
                return $this->respond(ResultDTO::fail('Error006', [], '존재하지 않는 매칭 정보 입니다.'));
            }
            $Cnt = $herb_m->Delete_Medicine_Decoc_Match($cfcode,$MatchSn);
            if ($Cnt === false) {
                return $this->respond(ResultDTO::fail('Error007', [], '삭제 처리 중 오류가 발생했습니다.'));
            }
        }else if($f_type==2){
            $hncode = $params['hncode'] ?? '';
            $hntitle = $params['hntitle'] ?? '';

            if(empty($cfcode) || empty($hncode)  || empty($hntitle)){
                return $this->respond(ResultDTO::fail('Error005', [], '필수항목이 누락되었습니다.'));
            }
            $chceckCnt = $herb_m->Count_Medicine_Decoc_Match2($cfcode,$hncode);
            if($chceckCnt>0){
                return $this->respond(ResultDTO::fail('Error006', [], '선택하신 약재는 이미 다른 약재랑 매칭 되어 있습니다. \n매칭되어 있는 약재를 삭제 하시고 다시 시도하여주세요.'));
            }

            $datas =[
                'cfcode' => $cfcode,
                'mm_medicine' => $mm_medicine,
                'mm_title' => $hntitle,
                'fk_hncode' => $hncode,
                'is_use' => 1
            ];
            $Cnt = $herb_m->Insert_Medicine_Decoc_Match($datas);
            if ($Cnt === false) {
                return $this->respond(ResultDTO::fail('Error007', [], '매칭 처리 중 오류가 발생했습니다.'));
            }

        }
        $tCnt = $herb_m->Count_Medicine_Decoc_Match3($cfcode,$mm_medicine);
        $i_arr = ['result'=>'ok','pCnt' => $tCnt];
        return $this->respond(ResultDTO::success($i_arr));

    }

    public function Load_Medicine_decoc(){
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $cfcode = $params['cfcode'] ?? '';
        if(empty($cfcode)){
            return $this->respond(ResultDTO::fail('Error004', [], '필수항목이 누락되었습니다.'));
        }
        $page = $params['page'] ?? 1;
        $searchStr = $params['sStr'] ?? '';
        $herb_m = model('Herb_m');
        $options = [
            'opt' => $params['opt'] ?? 1,
            'page' => $page,
            'pCnt' => $params['pCnt'] ?? 30,
            'bname' => '',
            'sStr' => $searchStr
        ];
        $list = [];
        $totalRs = $herb_m->Cnt_Medicine_Decoc_All($cfcode,$searchStr);
        $fields= ['a.*','IFNULL((SELECT COUNT(*) from herb_medicine_decoc_match WHERE cfcode=a.cfcode AND mm_medicine=a.mm_medicine AND is_del=0 AND is_use=1),0) AS matched'];
        $cRs = $herb_m->Load_Medicine_Decoc_All($cfcode,$options,$fields);
        if(!empty($cRs)){
            foreach ($cRs as $d){
                $totalStock = $d['stock'] + $d['stock_ware'];
                $t_arr = [
                    'sn' => $d['sn'],
                    'cfcode' => $d['cfcode'],
                    'mm_medicine' => $d['mm_medicine'],
                    'mm_title' => $d['mm_title'],
                    'medicode' => $d['md_Medi'],
                    'optimal_stock' => $d['optimal_stock'],
                    'stock' => $d['stock'],
                    'stock_month' => $d['stock_month'],
                    'stock_week' => $d['stock_week'],
                    'stock_ware' => $d['stock_ware'],
                    'matched' => $d['matched'],
                    'is_manage' => $d['is_manage'],
                    'totalStock' => $totalStock,
                    'update' => $d['update'],
                    'stock_status' => $this->Check_Stock_Status($d['optimal_stock'],$totalStock,$d['stock_month'])
                ];
                $list[] = $t_arr;
            }
        }
        $i_arr = [
            'list' => $list,
            'tcnt' => count($list),
            'nPage' => $page+1,
            'totalRs' => $totalRs
        ];

        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Load_Medicine_Decoc_Match(){
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $cfcode = $params['cfcode'] ?? '';
        $mmcode = $params['code'] ?? '';
        $medicode = $params['medicode'] ?? '';
        Prn_Log($params);
        if(empty($cfcode) || empty($mmcode) || empty($medicode)){
            return $this->respond(ResultDTO::fail('Error004', [], '필수항목이 누락되었습니다.'));
        }

        $matched = [];
        $herb_m = model('Herb_m');
        $fields =['a.*','b.hn_name','b.n_value','b.t1_name','b.t2_name','b.mi_name','b.w_name'];
        $cRs = $herb_m->Load_Medicine_Decoc_Matched($cfcode,$mmcode,$fields);
        if(is_array($cRs) && count($cRs)>0){
            foreach ($cRs as $d){
                $t_arr = [
                    'matchedsn' => $d['sn'],
                    'hn_code' => $d['fk_hncode'],
                    'mm_medicine' => $d['mm_medicine'],
                    'hn_name' => $d['hn_name'],
                    'hn_origin' => $d['n_value'],
                    'hn_option' => $this->Product_Option_str($d['t1_name'],$d['t2_name']),
                    'hn_wname' => $d['mi_name'],
                    'w_name' => $d['w_name']
                ];
                $matched[] = $t_arr;
            }
        }

        $matching = [];
        $dRs = $herb_m->Load_Madicine_Decoc_Matching($cfcode,$medicode);
        if(is_array($dRs) && count($dRs)>0){
            foreach ($dRs as $d){
                $t_arr = [
                    'hn_code' => $d['hn_code'],
                    'hn_name' => $d['hn_name'],
                    'hn_origin' => $d['n_value'],
                    'hn_option' => $this->Product_Option_str($d['t1_name'],$d['t2_name']),
                    'hn_wname' => $d['mi_name'],
                    'w_name' => $d['w_name']
                ];
                $matching[] = $t_arr;
            }
        }

        $i_arr = [
            'matched' => $matched,
            'matchedCnt' => count($matched),
            'matching' => $matching,
            'matchingCnt' => count($matching),
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }


}