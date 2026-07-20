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

    public function Order_Step_Do(){
        $o_data = (fn_IsEmpty($this->request->getPost('data'))) ? [] : $this->request->getPost('data');
        $o_step = ($this->request->getPost('ostep') == '') ? '' : $this->request->getPost('ostep');
        $n_step = ($this->request->getPost('nstep') == '') ? '' : $this->request->getPost('nstep');

        if(($o_data=='') || ($o_step=='')|| ($n_step=='')){
            $result = 'type101';
            $info = '';
            $message = '선택하신 약재 정보를 확인하여주세요.';
        }else {
            $sessinarr = $this->GetSessionData();
            if (!$sessinarr['islogin']) {
                $result = 'NoLogin';
                $info = '';
                $message = '로그인을 하셔야 합니다.';
            } else {
                $mi_code = $sessinarr['user']['mi_code'];
                $mi_type = $sessinarr['user']['mi_type'];
                if($mi_type==AUTH_DECOC) {
                    $result = 'AUTH_FAIL';
                    $info = '';
                    $message = '접근 권한이 없습니다.';
                }else {

                    $data = json_decode($o_data, true);
                    $sn = $data[0]['sn'];
                    $status = $data[0]['status'];
                    $delidate = $data[0]['delidate'];

                    $herb_m = model('Herb_m');
                    $Cnt = $herb_m->Cnt_Order_Step_Check($sn, $o_step, $mi_code);
                    if ($Cnt > 0) {
                        $result = 'type103';
                        $info = '';
                        $message = "주문상태가 잘못되었습니다.\n 입력하신 주문 확인하여주세요.";
                    } else {
                        $order_m = model('Order_m');
                        if ($n_step == ORDER_PROCESSING) {
                            $Rs = $order_m->Load_Order_Goods($sn);
                            if (fn_ArrayCnt($Rs) <= 0) {
                                $result = 'type113';
                                $message = '배송 항목 정보 확인에 실패하였습니다.';
                            } else {
                                $u_Cnt = 0;
                                $u_weight = 0;

                                $t_cnt = $Rs[0]['gd_cnt'];
                                $weight = $Rs[0]['w_value'];
                                $od_code = $Rs[0]['fk_odcode'];
                                $gd_code = $Rs[0]['gd_code'];
                                $od_wcode = $Rs[0]['od_wcode'];
                                $od_wname = $Rs[0]['od_wname'];

                                $tarr = [
                                    'mi_code' => $mi_code,
                                    'w_code' => $od_wcode,
                                    'p_type' => 0
                                ];

                                $Rs2 = $order_m->Load_Package_Goods_Active($tarr);
                                if (fn_ArrayCnt($Rs2) <= 0) {
                                    $fk_pcode = $this->Make_Code(6);
                                    $marr = [
                                        'pcode' => $fk_pcode,
                                        'mi_code' => $mi_code,
                                        'w_code' => $od_wcode,
                                        'w_name' => $od_wname
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

                            }
                        }

                        $rCnt = $herb_m->Update_Order_Step($sn, $delidate, $n_step);
                        $i_arr = [
                            'eCnt' => $rCnt,
                            'sn' => $sn,
                            'n_step' => $n_step
                        ];

                        $typ = 'Order_Step';
                        $Log = 'Order_Step:' . $this->OrderStepName($n_step) . '|ostep:' . $o_step . '|nstep:' . $n_step . '|data:' . $sn;
                        $this->Log_Reg($mi_code, $typ, $Log);

                        $result = 'ok';
                        $info = $i_arr;
                        $message = '';
                    }
                }
            }
        }

        $return = [
            'result' => $result,
            'info' => $info,
            'message' => $message
        ];
        return $this->respond($return);
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
        if(empty($sn) || $nowstep==='' || $nextstep==='') {
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

        $datas = [
            'page' =>$page,
            'pcnt' => $pCnt,
            'sdate' => $sdate,
            'edate' => $edate,
            'cfcode' => $cfcode,
            'delistatus' => $deliStatus,
            'micode' => $mi_code
        ];

        Prn_Log($datas);

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



































