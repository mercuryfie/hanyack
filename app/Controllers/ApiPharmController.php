<?php

namespace App\Controllers;

use App\DTOs\ResultDTO;
use App\Libraries\Utils;
use CodeIgniter\API\ResponseTrait;

class ApiPharmController extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $Auth = [AUTH_MASTER, AUTH_PHARM,AUTH_DECOC];
        $this->Check_Auth($Auth);
    }


    public function Update_Deli_Data(){
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            $result = 'NoLogin';
            $message = '로그인을 하셔야 합니다.';
        } else {
            $mi_type = $sessinarr['user']['mi_type'];
            $mi_code = $sessinarr['user']['mi_code'];
            if ($mi_type != 'pharm') {
                $result = 'type111';
                $message = '권한이외의 접근입니다.';
            } else {
                $pcode = ($this->request->getPost('pcode') == '') ? '' : $this->request->getPost('pcode');
                if ($pcode == '') {
                    $result = 'type112';
                    $message = '출하 정보를 확인하세요.';
                } else {
                    $order_m = model('Order_m');
                    $Rs = $order_m->Load_Order_Package_List($pcode);
                    if (fn_ArrayCnt($Rs) <= 0) {
                        $result = 'type113';
                        $message = '해당 출고코드에 등록되어 있는 약재가 없습니다.';
                    } else {
                        $t_arr = [];
                        foreach ($Rs as $d) {
                            $t_arr[] = $d['oSN'];
                        }
                        $herb_m = model('Herb_m');
                        $rCnt = $herb_m->Process_Order_StepInfo($t_arr, ORDER_DELIVERY_READY);

                        $param = [
                            'p_type' => PACKAGE_SHIP_READY
                        ];
                        $Cnt = $order_m->Update_Package_StepInfo($pcode, $param);

                        $result = 'ok';
                        $message = '';
                    }
                }
            }
        }
        $return = [
            'result' => $result,
            'message' => $message
        ];
        return $this->respond($return);
    }

    public function Update_Pharm_Delivery_Info()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLog', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_PHARM)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $pcode = $params['pcode'] ?? '';
        if (empty($pcode)) {
            return $this->respond(ResultDTO::fail('Error004', [], '잘못된 접근입니다.'));
        }
        $order_m = model('Order_m');
        $Rs = $order_m->Load_Order_Package_List($pcode);
        if(empty($Rs)){
            return $this->respond(ResultDTO::fail('Error005', [], '존재하지 않는 배송정보입니다.'));
        }
        $order_m = model('Order_m');
        $Rs = $order_m->Load_Order_Package_List($pcode);
        $t_arr = array_column($Rs, 'fk_gdcode');
        $rCnt = $order_m->Process_Order_StepInfo($t_arr, ORDER_DELIVERY_READY);
        $param = ['p_type' => PACKAGE_SHIP_READY];
        $Cnt = $order_m->Update_Package_StepInfo($pcode, $param);
        $i_arr = ['ecnt' => $Cnt];
        return $this->respond(ResultDTO::success($i_arr));
    }


    public function Load_Pharm_PackageDetail()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLog', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_PHARM)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $pcode = $params['pcode'] ?? '';
        if (empty($pcode)) {
            return $this->respond(ResultDTO::fail('Error004', [], '잘못된 접근입니다.'));
        }

        $list = [];
        $order_m = model('Order_m');
        $Rs = $order_m->Load_Order_Package_List($pcode);
        if (!empty($Rs)) {
            foreach ($Rs as $d) {
                $t_arr = [
                    'sn' => $d['sn'],
                    'pa_code' => $d['pa_code'],
                    'gd_status' => $d['gd_status'],
                    'fk_pcode' => $d['fk_pcode'],
                    'fk_hncode' => $d['hn_code'],
                    'hn_name' => $d['hn_name'],
                    't1_value' => $d['t1_name'],
                    't2_value' => $d['t2_name'],
                    't_cnt' => $d['t_cnt'],
                    't_weight' => $d['t_weight'],
                    'delidate' => $d['gd_delidate']
                ];
                $list[] = $t_arr;
            }
        }
        $i_arr = [
            'list' => $list,
            'tcnt' => count($list)
        ];

        return $this->respond(ResultDTO::success($i_arr));
    }
    public function Load_Pharm_Package()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLog', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER)  && ($mi_type != AUTH_PHARM)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $mi_code = $sessinarr['user']['mi_code'];
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }

        $page = $params['page'] ?? 1;
        $pCnt = $params['pCnt'] ?? 10;
        $sdate = $params['sdate'] ?? '';
        $edate = $params['edate'] ?? '';
        $cfcode = $params['cfcode'] ?? '';
        $deliStatus = $params['deliStatus'] ?? '';
        $skey = $params['skey'] ?? '';

        $datas = [
            'page' =>$page,
            'pcnt' => $pCnt,
            'sdate' => $sdate,
            'edate' => $edate,
            'cfcode' => $cfcode,
            'delistatus' => $deliStatus,
            'skey' => $skey,
            'micode' => $mi_code
        ];
        $list = [];
        $order_m = model('Order_m');
        $totalRs =$order_m->Cnt_Order_Package_Pharm($datas);
        $Rs = $order_m->Load_Order_Package_Pharm($datas);
        if(!empty($Rs)){
            foreach ($Rs as $d) {
                $t_arr = [
                    'sn' => $d['sn'],
                    'pcode' => $d['pcode'],
                    'cfcode' => $d['cfcode'],
                    'cfname' => $d['cfname'],
                    't_cnt' => $d['t_cnt'],
                    't_weight' => $d['t_weight'],
                    'delitype' => $d['delitype'],
                    'delicode' => $d['delicode'],
                    'delidate' => $d['delidate'],
                    'p_type' => $d['p_type'],
                    'pa_regdate' => fn_Short_Date($d['pa_regdate'])
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

    public function Update_Pharm_OrderByStep()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLog', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER)  && ($mi_type != AUTH_PHARM)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $mi_code = $sessinarr['user']['mi_code'];
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $sn = $params['sn'] ?? '';
        $nowstep = $params['nowstep'] ?? '';
        $nextstep = $params['nextstep'] ?? '';
        if(empty($sn) || empty($nowstep) || empty($nextstep)) {
            return $this->respond(ResultDTO::fail('Error004', [], '잘못된 접근입니다.'));
        }

        $order_m = model('Order_m');
        $chechcnt = $order_m->Cnt_Order_Step_Check($sn,$nowstep,$mi_code);
        if($chechcnt > 0){
            return $this->respond(ResultDTO::fail('Error005', [], '주문상태가 잘못되었습니다.\n 입력하신 주문 확인하여주세요.'));
        }

        $gRs = $order_m->Load_Order_Goods($sn);
        if(empty($gRs)){
            return $this->respond(ResultDTO::fail('Error006', [], '배송 항목 정보 확인에 실패하였습니다.'));
        }
        $t_cnt = $gRs[0]['gd_cnt'];
        $weight = $gRs[0]['w_value'];
        $od_code = $gRs[0]['fk_odcode'];
        $gd_code = $gRs[0]['gd_code'];
        $cfcode = $gRs[0]['fk_cfcode'];
        $cfname = $gRs[0]['decoc_name'];

        $tarr = [
            'mi_code' => $mi_code,
            'cfcode' => $cfcode
        ];
        $Rs2 = $order_m->Load_Package_Goods_Active($tarr);
        if(empty($Rs2)){
            $fk_pcode = $this->Make_Code(6);
            $marr = [
                'pcode' => $fk_pcode,
                'mi_code' => $mi_code,
                'cfcode' => $cfcode,
                'cfname' => $cfname
            ];
            $Cnt = $order_m->Insert_Package($marr);
        } else {
            $fk_pcode = $Rs2[0]['pcode'];
        }

        $sarr = [
            'pa_code' => $this->Make_Code(5),
            'fk_pcode' => $fk_pcode,
            'fk_odcode' => $od_code,
            'fk_gdcode' => $gd_code,
            't_cnt' => $t_cnt,
            't_weight' => ($t_cnt * $weight)
        ];
        $Cnt = $order_m->Insert_Package_Goods($sarr);

        $p_arr = [
            'pcode' => $fk_pcode,
            'cnt' => $t_cnt,
            'weight' => ($t_cnt * $weight)
        ];
        $eCnt = $order_m->Update_Package_Info($fk_pcode, $p_arr);

        $typ = 'Order_Step';
        $Log = 'Order_Step:' . $this->OrderStepName($nextstep) . '|ostep:' . $nowstep . '|nstep:' . $nextstep . '|data:' . $sn;
        $this->Log_Reg($mi_code, $typ, $Log);

        $rCnt = $order_m->Update_Order_Step($sn, $nextstep);
        $i_arr = ['ecnt' => $eCnt];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Load_Pharm_Medicine_All()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLog', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER)  && ($mi_type != AUTH_PHARM)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $mi_code = $sessinarr['user']['mi_code'];
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $page = $params['page'] ?? 1;
        $pcnt = $params['pcnt'] ?? 30;
        $skey = $params['skey'] ?? '';
        $datas = [
            'page' => $page,
            'pcnt' => $pcnt,
            'skey' => $skey,
            'micode' =>$mi_code
        ];

        $list = [];
        $herb_m = model('Herb_m');
        $totalRs =$herb_m->Cnt_Pharm_Medicine_All($datas);
        $mRs = $herb_m->Load_Pharm_Medicine_All($datas);
        if(!empty($mRs)){
            foreach ($mRs as $d){
                $unitInfo = $this->getUnitInfo($d['hn_package_type'],$d['hn_package_cnt'],$d['w_value'],1,$d['price']);
                $t_arr = [
                    'sn' => $d['sn'],
                    'hn_code' => $d['hn_code'],
                    'hn_name' => $d['hn_name'],
                    'hp_code' => $d['hp_code'],
                    'hn_batch_no' => $d['hn_batch_no'],
                    'hn_product_date' => fn_Short_Date($d['hn_product_date']),
                    'hn_expired_date' => fn_Short_Date($d['hn_expired_date']),
                    'hn_package_type' => $d['hn_package_type'],
                    'hn_package_cnt' => $d['hn_package_cnt'],
                    'totalPrice' => $unitInfo['totalPrice'],
                    'packageStr' => $unitInfo['packageStr'],
                    'geunPrice' => $unitInfo['geunPrice'],
                    'defaultCnt' => $unitInfo['defaultCnt'],
                    'option_str' => $this->Product_Option_str($d['t1_name'], $d['t2_name']),
                    'w_name' => $d['w_name'],
                    'w_value' => $d['w_value'],
                    'n_value' => $d['n_value'],
                    't1_name' => $d['t1_name'],
                    't2_name' => $d['t2_name'],
                    'thumnail' => $d['thumnail']
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


    public function Search_Medicine_Pharm(){
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLog', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC) && ($mi_type != AUTH_PHARM)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $searchKey = $params['skey'];
        if(empty($searchKey)){
            return $this->respond(ResultDTO::fail('Error004', [], '필수항목이 누락되었습니다.'));
        }

        $list = [];
        $herb_m = model('Herb_m');
        $hRs = $herb_m->Search_Medicine_Pharm($searchKey);
        if(is_array($hRs) && count($hRs)>0){
            foreach($hRs as $d){
                $t_arr = [
                    'hn_code' => $d['hn_code'],
                    'hn_name' => $d['hn_name'],
                    'hn_origin' => $d['n_value'],
                    'hn_option' => $this->Product_Option_str($d['t1_name'],$d['t2_name']),
                    'hn_wname' => $d['mi_name'],
                    'w_name' => $d['w_name']
                ];
                $list[] = $t_arr;
            }
        }

        $i_arr = [
            'list' => $list,
            'tcnt' => count($list)
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Load_Pharm_Order(){
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLog', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER) && ($mi_type != AUTH_DECOC) && ($mi_type != AUTH_PHARM)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $mi_code = $sessinarr['user']['mi_code'];
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $page = $params['page'] ?? 1;
        $pCnt = $params['pCnt'] ?? 10;
        $sdate = $params['sdate'] ?? '';
        $edate = $params['edate'] ?? '';
        $cfcode = $params['cfcode'] ?? '';
        $deliStatus = $params['deliStatus'] ?? '';
        $skey = $params['skey'] ?? '';

        $datas = [
            'page' =>$page,
            'pcnt' => $pCnt,
            'sdate' => $sdate,
            'edate' => $edate,
            'cfcode' => $cfcode,
            'delistatus' => $deliStatus,
            'micode' => $mi_code,
            'skey' => $skey
        ];
        $list = [];
        $order_m = model('Order_m');
        $totalRs = $order_m->Cnt_Order_Pharm_All($datas);
        $dRs = $order_m->Load_Order_Pharm_All($datas);
        if(!empty($dRs)){
            foreach($dRs as $d){
                $unitInfo = $this->getUnitInfo($d['hn_package_type'],$d['hn_package_cnt'],$d['w_value'],$d['gd_cnt'],$d['price']);

                $t_arr = [
                    'sn' => $d['primarysn'],
                    'gd_code' => $d['gd_code'],
                    'fk_odcode' => $d['fk_odcode'],
                    'decoc_name' => $d['decoc_name'],
                    'gd_cnt'=> $d['gd_cnt'],
                    'gd_status' =>  $d['gd_status'],
                    'gd_rPrice' => $d['gd_rPrice'],
                    'gd_price' => $d['gd_price'],
                    'gd_delidate' => $d['gd_delidate'],
                    'delicode' => $d['delicode'],
                    'delitype' => $d['delitype'],
                    'od_regdate' => $d['od_regdate'],
                    'gd_delicomplete' => $d['gd_delicomplete'],
                    'hn_code' => $d['hn_code'],
                    'hn_name' => $d['hn_name'],
                    'hp_code' => $d['hp_code'],
                    'hn_batch_no' => $d['hn_batch_no'],
                    'hn_product_date' => $d['hn_product_date'],
                    'hn_expired_date' => $d['hn_expired_date'],
                    'hn_package_type' => $d['hn_package_type'],
                    'hn_package_cnt' => $d['hn_package_cnt'],
                    'totalPrice' => $unitInfo['totalPrice'],
                    'packageStr' => $unitInfo['packageStr'],
                    'geunPrice' => $unitInfo['geunPrice'],
                    'defaultCnt' => $unitInfo['defaultCnt'],
                    'option_str' => $this->Product_Option_str($d['t1_name'], $d['t2_name']),
                    'w_name' => $d['w_name'],
                    'w_value' => $d['w_value'],
                    'n_value' => $d['n_value'],
                    't1_name' => $d['t1_name'],
                    't2_name' => $d['t2_name'],
                    'thumnail' => $d['thumnail']
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


}



































