<?php

namespace App\Controllers;

use App\DTOs\ResultDTO;
use App\Libraries\Utils;
use CodeIgniter\API\ResponseTrait;
use Carbon\Carbon;

class ApiPharmController extends BaseController
{
    use ResponseTrait;

    public function __construct()
    {
        $Auth = [AUTH_MASTER, AUTH_PHARM,AUTH_DECOC];
        $this->Check_Auth($Auth);
    }

    public function Insert_Pharm_Medicine_GPrice()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER)  && ($mi_type != AUTH_PHARM)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $mi_code = $sessinarr['user']['mi_code'];
        $datas = [
            'fk_micode' =>$mi_code,
            'grade_a' => $params['grade_a'] ?? 0,
            'grade_b' => $params['grade_b'] ?? 0,
            'grade_c' => $params['grade_c'] ?? 0,
            'grade_d' => $params['grade_d'] ?? 0,
            'grade_e' => $params['grade_e'] ?? 0
        ];
        $pharm_m = model('Pharm_m');
        $nowseq = $pharm_m->Insert_Pharm_Medicine_GPrice($datas);
        $effect = $pharm_m->Delete_Pharm_Medicine_GPrice($mi_code,$nowseq);
        $i_arr = [
            'ecnt' => 1
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Load_Pharm_Medicine_GPrice()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER)  && ($mi_type != AUTH_PHARM)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $list = [];
        $mi_code = $sessinarr['user']['mi_code'];
        $pharm_m = model('Pharm_m');
        $gRs = $pharm_m->Load_Pharm_Medicine_GPrice($mi_code);
//        echo ($gRs);
//        exit();
        if(empty($gRs)){
            $list['a'] = PRICE_GROUP_A;
            $list['b'] = PRICE_GROUP_B;
            $list['c'] = PRICE_GROUP_C;
            $list['d'] = PRICE_GROUP_D;
            $list['e'] = PRICE_GROUP_E;
        }else{
            $list['a'] = $gRs[0]['grade_a'];
            $list['b'] = $gRs[0]['grade_b'];
            $list['c'] = $gRs[0]['grade_c'];
            $list['d'] = $gRs[0]['grade_d'];
            $list['e'] = $gRs[0]['grade_e'];
        }
        $i_arr = [
            'list' => $list,
            'tcnt' => count($list)
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Load_Pharm_Medicine_Product()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $hncode = $params['hncode'] ?? '';
        if(empty($hncode)){
            return $this->respond(ResultDTO::fail('Error004', [], '잘못된 접근입니다.'));
        }
        $pharm_m = model('Pharm_m');
        $Rs = $pharm_m->Load_Pharm_Medicine_ProductByHncode($hncode);
        $list = empty($Rs) ? [] : $Rs;
        $i_arr = [
            'list' => $list,
            'tcnt' => count($list)
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Load_Pharm_Medicine_SearchByMdcode()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $md_code = $params['mdcode'] ?? '';
        if(empty($md_code)){
            return $this->respond(ResultDTO::fail('Error004', [], '잘못된 접근입니다.'));
        }
        $herb_m = model('Herb_m');
        $param = [
            'micode' => $mi_code,
            'mdcode' => $md_code,
        ];
        $Rs = $herb_m->Load_Medicine_infoByMdcode($param);
        $list = empty($Rs) ? [] : $Rs;
        $i_arr = [
            'list' => $list,
            'tcnt' => count($list)
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Load_Pharm_Medicine_TradeList()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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

        $datas = [
            'page' => $page,
            'pcnt' => $pCnt,
            'micode' => $mi_code,
            'sdate' => $params['sdate'] ?? '',
            'edate' => $params['edate'] ?? '',
            'skey' => $params['skey'] ?? '',
            'vendor' => $params['vendor'] ?? '',
            'stype' => $params['stype'] ?? '',
            'tradetype' => $params['tradetype'] ?? ''
        ];
        $list = [];
        $pharm_m = model('Pharm_m');
        $fieleds = ['a.*','b.ve_name','c.hn_name'];
        $totalRs =$pharm_m->Cnt_Pharm_TradeMedicine_LogAll($datas);
        $Rs = $pharm_m->Load_Pharm_TradeMedicine_LogAll($datas,$fieleds);
        if(!empty($Rs)){
            foreach ($Rs as $d) {
                $t_arr = [
                    'tcode' => $d['tcode'],
                    've_name' => $d['ve_name'],
                    'hnname' => $d['hn_name'],
                    'logtype' => $d['logtype'],
                    'quantity' => $d['quantity'],
                    'unit_price' => $d['unit_price'],
                    'price' => $d['price'],
                    'reg_date'  => fn_Short_Date($d['reg_date'])
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

    public function Load_Pharm_Material_TradeList()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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

        $datas = [
            'page' => $page,
            'pcnt' => $pCnt,
            'micode' => $mi_code,
            'sdate' => $params['sdate'] ?? '',
            'edate' => $params['edate'] ?? '',
            'skey' => $params['skey'] ?? '',
            'vendor' => $params['vendor'] ?? '',
            'stype' => $params['stype'] ?? '',
            'tradetype' => $params['tradetype'] ?? ''
        ];
        $list = [];
        $pharm_m = model('Pharm_m');
        $fieleds = ['a.*','b.ve_name','c.mtname'];
        $totalRs =$pharm_m->Cnt_Pharm_TradeMaterial_LogAll($datas);
        $Rs = $pharm_m->Load_Pharm_TradeMaterial_LogAll($datas,$fieleds);
        if(!empty($Rs)){
            foreach ($Rs as $d) {
                $t_arr = [
                    'tcode' => $d['tcode'],
                    've_name' => $d['ve_name'],
                    'mtname' => $d['mtname'],
                    'logtype' => $d['logtype'],
                    'quantity' => $d['quantity'],
                    'unit_price' => $d['unit_price'],
                    'price' => $d['price'],
                    'reg_date'  => fn_Short_Date($d['reg_date'])
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

    public function Input_Pharm_Medicine_InOut()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $hncode = $params['hncode'] ?? '';
        $hpcode = $params['hpcode'] ?? '';
        $typ = $params['typ'] ?? '';
        $stock = $params['stock'] ?? 0;
        $reason = $params['reason'] ?? '';
        $vcode = $params['vcode'] ?? '';
        $v_price= $params['v_price'] ?? '';
        $v_unitprice = $params['v_unitprice'] ?? '';
        $in_memo = $params['in_memo'] ?? '';
        $indate = $params['indate'] ?? '';
        if(empty($hncode) || empty($hpcode) || empty($typ) || empty($stock) || empty($reason) || empty($indate)) {
            return $this->respond(ResultDTO::fail('Error004', [], '필수항목이 누락되었습니다.'));
        }
        if(!empty($vcode)){
            if(empty($v_price)  || empty($v_unitprice)){
                return $this->respond(ResultDTO::fail('Error005', [], '거래내역 필수항목이 누락되었습니다.'));
            }
        }
        $pharm_m = model('Pharm_m');
        $sRs = $pharm_m->Load_Pharm_Medicine_StockLog_Limit($mi_code,$hpcode);
        $nowStock = (empty($sRs)) ? 0 : $sRs[0]['total'];
        if($typ==1){
            $newStock = $nowStock+$stock;
            $m_input = $stock;
            $m_output = 0;
        }else{
            $newStock = $nowStock-$stock;
            $m_input = 0;
            $m_output = $stock;
        }
        $datas = [
            'fk_hpcode' => $hpcode,
            'fk_hncode' => $hncode,
            'fk_micode' => $mi_code,
            'total' => $newStock,
            'm_input' => $m_input,
            'm_output' => $m_output,
            'memo'=> $in_memo,
            'reason' =>$reason,
            'indate' => $indate
        ];
        $effect = $pharm_m->Insert_Pharm_Medicine_StockLog($datas);
        if(!empty($vcode)){
            $datas2 = [
                'tcode' => $this->Make_Code(10),
                'fk_vcode' => $vcode,
                'logtype' => $typ,
                'fk_hpcode' => $hpcode,
                'fk_hncode' => $hncode,
                'fk_micode'=>$mi_code,
                'quantity' => $stock,
                'price' => $v_price,
                'unit_price' => $v_unitprice,
            ];
            $effec2 =$pharm_m->Insert_Pharm_Medicine_TradeLog($datas2);
        }
        $i_arr = [
            'ecnt' => $effect
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Input_Pharm_Material_InOut()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $mtcode = $params['mtcode'] ?? '';
        $typ = $params['typ'] ?? '';
        $stock = $params['stock'] ?? 0;
        $reason = $params['reason'] ?? '';
        $vcode = $params['vcode'] ?? '';
        $v_price= $params['v_price'] ?? '';
        $v_unitprice = $params['v_unitprice'] ?? '';
        $in_memo = $params['in_memo'] ?? '';
        $indate = $params['indate'] ?? '';
        if(empty($mtcode) || empty($typ) || empty($stock) || empty($reason) || empty($indate)) {
            return $this->respond(ResultDTO::fail('Error004', [], '필수항목이 누락되었습니다.'));
        }
        if(!empty($vcode)){
            if(empty($v_price)  || empty($v_unitprice)){
                return $this->respond(ResultDTO::fail('Error005', [], '거래내역 필수항목이 누락되었습니다.'));
            }
        }
        $pharm_m = model('Pharm_m');
        $sRs = $pharm_m->Load_Pharm_MaterialStockLog_Limit($mi_code,$mtcode);
        $nowStock = (empty($sRs)) ? 0 : $sRs[0]['total'];
        if($typ==1){
            $newStock = $nowStock+$stock;
            $m_input = $stock;
            $m_output = 0;
        }else{
            $newStock = $nowStock-$stock;
            $m_input = 0;
            $m_output = $stock;
        }
        $datas = [
            'fk_mtcode' => $mtcode,
            'fk_micode' => $mi_code,
            'total' => $newStock,
            'm_input' => $m_input,
            'm_output' => $m_output,
            'memo'=> $in_memo,
            'reason' =>$reason,
            'indate' => $indate
        ];
        $effect = $pharm_m->Insert_Pharm_Material_StockLog($datas);
        if(!empty($vcode)){
            $datas2 = [
                'tcode' => $this->Make_Code(9),
                'fk_vcode' => $vcode,
                'logtype' => $typ,
                'fk_mtcode' => $mtcode,
                'fk_micode'=>$mi_code,
                'quantity' => $stock,
                'price' => $v_price,
                'unit_price' => $v_unitprice,
            ];
            $effec2 =$pharm_m->Insert_Pharm_Material_TradeLog($datas2);
        }
        $i_arr = [
            'ecnt' => $effect
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Load_Pharm_VendorForSearch()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $pCnt = $params['pcnt'] ?? 30;
        $skey = $params['skey'] ?? '';
        $vcode = $params['ve_code'] ?? '';
        $pharm_m = model('Pharm_m');

        $datas = [
            'micode' => $mi_code,
            'skey' => $skey,
            'page' => $page,
            'pcnt' => $pCnt
        ];

        if (empty($skey) && empty($vcode)) {
            $Rs = $pharm_m->Load_Pharm_Vendor_All($datas);
        } else {
            $datas2 = [
                'skey' => $skey,
                'micode' => $mi_code,
                'page' => $page,
                'pcnt' => $pCnt,
                've_code' => $vcode
            ];
            $list = [];
            $vRs = $pharm_m->Load_Pharm_Vendor_Search($datas2);
            if(!empty($vRs)){
                foreach ($vRs as $d){
                    $t_arr = [
                        've_code' => $d['ve_code'],
                        've_name' => $d['ve_name'],
                        've_desc' => $d['ve_desc'],
                        've_email' => $d['ve_email'],
                        've_busino' => $d['ve_busino'],
                        've_busiemail' => $d['ve_busiemail'],
                        've_busizip' => $d['ve_busizip'],
                        've_busiaddr1' => $d['ve_busiaddr1'],
                        've_busiaddr2' => $d['ve_busiaddr2'],
                        've_busitel' => $d['ve_busitel'],
                        've_indate' => fn_Short_Date($d['ve_indate'])
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

    }


    public function Delete_Pharm_Vendor ()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $vecode = $params['vecode'] ?? '';
        if (empty($vecode)) {
            return $this->respond(ResultDTO::fail('Error004', [], '잘못된 접근입니다.'));
        }
        $datas = ['ve_isdel' => 1];
        $pharm_m = model('Pharm_m');
        $effect = $pharm_m->Update_Pharm_Vendor_Info($vecode,$mi_code,$datas);
        $i_arr = [
            'ecnt' => $effect
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Delete_Pharm_Material()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $mtcode = $params['mtcode'] ?? '';
        if (empty($mtcode)) {
            return $this->respond(ResultDTO::fail('Error004', [], '잘못된 접근입니다.'));
        }
        $datas = ['is_del' => 1];
        $pharm_m = model('Pharm_m');
        $effect = $pharm_m->Update_Pharm_Material($mtcode,$mi_code,$datas);
        $i_arr = [
            'ecnt' => $effect
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Load_Pharm_Material_Log()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $mtcode = $params['mtcode'] ?? '';
        if (empty($mtcode)) {
            return $this->respond(ResultDTO::fail('Error004', [], '잘못된 접근입니다.'));
        }
        $page = $params['page'] ?? 1;
        $pCnt = $params['pCnt'] ?? 30;

        $datas = [
            'mtcode' => $mtcode,
            'page' => $page,
            'pcnt' => $pCnt,
            'micode' => $mi_code,
            'sdate' => $params['sdate'] ?? '',
            'edate' => $params['edate'] ?? '',
            'skey' => $params['$searchkey'] ?? ''
        ];
//        echo ($datas);
//        var_dump($datas);
//        exit();
        $list = [];
        $pharm_m = model('Pharm_m');
        $totalRs =$pharm_m->Cnt_Pharm_Material_LogAll($datas);
        $Rs = $pharm_m->Load_Pharm_Material_LogAll($datas);
        if(!empty($Rs)){
            foreach ($Rs as $d) {
                $t_arr = [
                    'total' => $d['total'],
                    'm_input' => $d['m_input'],
                    'm_output' => $d['m_output'],
                    'memo' => $d['memo'],
                    'reason' => $d['reason'],
                    'indate' => fn_Short_Date($d['indate'])
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

    public function Update_Pharm_Material()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER)  && ($mi_type != AUTH_PHARM)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근권한이 없습니다.'));
        }
        $micode = $sessinarr['user']['mi_code'];
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $mtcode = $params['mtcode'] ?? '';
        if (empty($mtcode)) {
            return $this->respond(ResultDTO::fail('Error004', [], '잘못된 접근입니다.'));
        }
        $datas = [];
        $mtname = $params['mtname'] ?? '';
        $optimal_stock = $params['optimal_stock'] ?? '';
        $waste_rate = $params['waste_rate'] ?? '';
        $memo = $params['memo'] ?? '';
        if(!empty($mtname)){
            $datas['mtname'] = $mtname;
        }
        if(!empty($optimal_stock)){
            $datas['optimal_stock'] = $optimal_stock;
        }
        if(!empty($waste_rate)){
            $datas['waste_rate'] = $waste_rate;
        }
        if(!empty($memo)){
            $datas['memo'] = $memo;
        }

        if(empty($datas)){
            return $this->respond(ResultDTO::fail('Error005', [], '수정할 내용이 없습니다.'));
        }

        $pharm_m = model('Pharm_m');
        $effect = $pharm_m->Update_Pharm_Material($mtcode,$micode,$datas);
        $i_arr = [
            'ecnt' => $effect
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }


    public function Insert_Pharm_Material()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $mtname = $params['mtname'] ?? '';
        $waste_rate = $params['waste_rate'] ?? '';
        $optimal_stock = $params['optimal_stock'] ?? '';
        $memo = $params['memo'] ?? '';
        if(empty($mtname) || empty($waste_rate) || empty($optimal_stock)){
            return $this->respond(ResultDTO::fail('Error004', [], '필수항목이 누락되었습니다.'));
        }
        $datas = [
            'mtcode' => $this->Make_Code(7),
            'mtname' => $mtname,
            'waste_rate' => $waste_rate,
            'optimal_stock' => $optimal_stock,
            'memo' => $memo,
            'fk_micode' => $mi_code
        ];
        $pharm_m = model('Pharm_m');
        $effect = $pharm_m->Insert_Pharm_Material($datas);
        $i_arr = [
            'ecnt' => $effect
        ];
        return $this->respond(ResultDTO::success($i_arr));

    }

    public function Load_Pharm_Material_All()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $pCnt = $params['pcnt'] ?? 30;
        $skey = $params['skey'] ?? '';

        $datas = [
            'page' => $page,
            'pcnt' => $pCnt,
            'micode' => $mi_code,
            'skey' => $skey
        ];
        $list = [];
        $pharm_m = model('Pharm_m');
        $totalRs =$pharm_m->Cnt_Pharm_Material_All($datas);
        $Rs = $pharm_m->Load_Pharm_Material_All($datas);
        if(!empty($Rs)){
            foreach ($Rs as $d) {
                $optimal_stock = $d['optimal_stock'];
                $current_stock = $d['current_stock'];
                $stock_status = ($current_stock > $optimal_stock) ? 'high' : 'low';
                $t_arr = [
                    'mtcode' => $d['mtcode'],
                    'micode' => $d['fk_micode'],
                    'mtname' => $d['mtname'],
                    'optimal_stock' => $optimal_stock,
                    'waste_rate' => $d['waste_rate'],
                    'memo' => $d['memo'],
                    'reg_date' => fn_Short_Date($d['reg_date']),
                    'update_date' => fn_Short_Date($d['update_date']),
                    'current_stock' => $current_stock,
                    'last_stock_update' => (is_null($d['last_stock_update'])) ? '' : fn_Short_Date($d['last_stock_update']),
                    'stock_status' => $stock_status
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

    public function Update_Pharm_Vendor()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
        }
        if (!Check_Token($sessinarr)) {
            return $this->respond(ResultDTO::fail('Error001', [], '잘못된 토큰입니다.'));
        }
        $mi_type = $sessinarr['user']['mi_type'];
        if (($mi_type != AUTH_MASTER)  && ($mi_type != AUTH_PHARM)) {
            return $this->respond(ResultDTO::fail('Error002', [], '접근 권한이 없습니다.'));
        }
        $mi_code = $sessinarr['user']['mi_code'];
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error003', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $vecode = $params['ve_code'] ?? '';
        $datas = [];
        if(!empty($params['ve_name'] ?? '')){
            $datas['ve_name'] = $params['ve_name'];
        }
        if(!empty($params['ve_desc'] ?? '')){
            $datas['ve_desc'] = $params['ve_desc'];
        }
        if(!empty($params['ve_email'] ?? '')){
            $datas['ve_email'] = $params['ve_email'];
        }
        if(!empty($params['ve_busino'] ?? '')){
            $datas['ve_busino'] = $params['ve_busino'];
        }
        if(!empty($params['ve_busiemail'] ?? '')){
            $datas['ve_busiemail'] = $params['ve_busiemail'];
        }
        if(!empty($params['ve_busizip'] ?? '')){
            $datas['ve_busizip'] = $params['ve_busizip'];
        }
        if(!empty($params['ve_busiaddr1'] ?? '')){
            $datas['ve_busiaddr1'] = $params['ve_busiaddr1'];
        }
        if(!empty($params['ve_busiaddr2'] ?? '')){
            $datas['ve_busiaddr2'] = $params['ve_busiaddr2'];
        }
        if(!empty($params['ve_busitel'] ?? '')){
            $datas['ve_busitel'] = $params['ve_busitel'];
        }
        $datas['ve_isdel']=0;

        if(empty($datas)){
            return $this->respond(ResultDTO::fail('Error004', [], '수정하실 정보가 없습니다. '));
        }
        $pharm_m = model('Pharm_m');
        $effect = $pharm_m->Update_Pharm_Vendor_Info($vecode,$mi_code,$params);
        $i_arr = [
            'ecnt' => $effect
        ];
        return $this->respond(ResultDTO::success($i_arr));

    }

    public function Insert_Pharm_Vendor()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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

        $params = array(
            'fk_micode' => $mi_code,
            've_name' => $params['ve_name'] ?? '',
            've_desc' => $params['ve_desc'] ?? '',
            've_email' => $params['ve_email'] ?? '',
            've_busino' => $params['ve_busino'] ?? '',
            've_busiemail' => $params['ve_busiemail'] ?? '',
            've_busizip' => $params['ve_busizip'] ?? '',
            've_busiaddr1' => $params['ve_busiaddr1'] ?? '',
            've_busiaddr2' => $params['ve_busiaddr2'] ?? '',
            've_busitel' => $params['ve_busitel'] ?? ''
        );
        $pharm_m = model('Pharm_m');
        $effect = $pharm_m->Insert_Pharm_Vendor_Info($params);

        if($effect<=0){
            return $this->respond(ResultDTO::fail('Error004', [], '등록에 실패하였습니다.\n다시 시도하여주세요.'));
        }
        $i_arr = [
            'ecnt' => $effect
        ];
        return $this->respond(ResultDTO::success($i_arr));

    }

    public function Load_Pharm_Vendor_All()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $pCnt = $params['pcnt'] ?? 30;
        $skey = $params['skey'] ?? '';

        $datas = [
            'page' => $page,
            'pcnt' => $pCnt,
            'micode' => $mi_code,
            'skey' => $skey
        ];
        $list = [];
        $pharm_m = model('Pharm_m');
        $totalRs =$pharm_m->Cnt_Pharm_Vendor_All($datas);
        $Rs = $pharm_m->Load_Pharm_Vendor_All($datas);
        if(!empty($Rs)){
            foreach ($Rs as $d) {
                $t_arr = [
                    've_code' => $d['ve_code'],
                    've_name' => $d['ve_name'],
                    've_desc' => $d['ve_desc'],
                    've_email' => $d['ve_email'],
                    've_busino' => $d['ve_busino'],
                    've_busiemail' => $d['ve_busiemail'],
                    've_busizip' => $d['ve_busizip'],
                    've_busiaddr1' => $d['ve_busiaddr1'],
                    've_busiaddr2' => $d['ve_busiaddr2'],
                    've_busitel' => $d['ve_busitel'],
                    've_indate' => fn_Short_Date($d['ve_indate'])
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

    public function Update_Pharm_Delivery_Info()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $pcode = $params['pCode'] ?? '';
        $packageStep = $params['pStep'] ?? '';
        $orderStep = $params['oStep'] ?? '';
        $deliType = $params['deliType'] ?? '';
        $deliCode = $params['deliCode'] ?? '';

        if (empty($pcode) || empty($packageStep) || empty($orderStep)) {
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

        if(!empty($deliType) || !empty($deliCode)){
            $params1 = [
                'gd_status' => $orderStep,
                'delicode' =>$deliCode,
                'delitype' => $deliType,
                'delidate' => Carbon::now()->toDateTimeString()
            ];
            $params2 = [
                'p_type' => $packageStep,
                'delicode' =>$deliCode,
                'delitype' => $deliType,
                'delidate' => Carbon::now()->toDateTimeString()
            ];
        }else {
            $params1 = ['gd_status' => $orderStep];
            $params2 = ['p_type' => $packageStep];
        }
        $Cnt1 = $order_m->Process_Order_StepInfo($t_arr, $params1);
        $Cnt2 = $order_m->Update_Package_StepInfo($pcode, $params2);
        $i_arr = ['ecnt' => $Cnt2];
        return $this->respond(ResultDTO::success($i_arr));
    }


    public function Load_Pharm_PackageDetail()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
                if(is_null($d['hp_code'])){
                    $totalPrice = '';
                    $packageStr = '';
                    $geunPrice = '';
                    $defaultCnt = '';
                }else{
                    $unitInfo = $this->getUnitInfo($d['hn_package_type'],$d['hn_package_cnt'],$d['w_value'],1,$d['price']);
                    $totalPrice = $unitInfo['totalPrice'];
                    $packageStr = $unitInfo['packageStr'];
                    $geunPrice = $unitInfo['geunPrice'];
                    $defaultCnt = $unitInfo['defaultCnt'];
                }

                $optimal_stock = $d['optimal_stock'];
                $current_stock = $d['total_stock'];
                $stock_status = ($current_stock > $optimal_stock) ? 'high' : 'low';


                $t_arr = [
                    'sn' => $d['sn'],
                    'hn_code' => $d['hn_code'],
                    'hn_name' => $d['hn_name'],
                    'optimal_stock' => $d['optimal_stock'],
                    'total_stock' => $d['total_stock'],
                    'stock_status' => $stock_status,
                    'hp_code' => $d['hp_code'],
                    'hn_batch_no' => $d['hn_batch_no'],
                    'hn_product_date' => fn_Short_Date($d['hn_product_date']),
                    'hn_expired_date' => fn_Short_Date($d['hn_expired_date']),
                    'hn_package_type' => $d['hn_package_type'],
                    'hn_package_cnt' => $d['hn_package_cnt'],
                    'totalPrice' => $totalPrice,
                    'packageStr' => $packageStr,
                    'geunPrice' => $geunPrice,
                    'defaultCnt' => $defaultCnt,
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


    public function Load_Pharm_MedicineLog()
    {
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
        $mtcode = $params['prdcode'];
        $datas = [
            'page' => $page,
            'pcnt' => $pcnt,
            'skey' => $skey,
            'micode' =>$mi_code,
            'prdcode' =>$mtcode
        ];

        $list = [];
        $pharm_m = model('Pharm_m');
        $totalRs =$pharm_m->Cnt_Pharm_Medicine_StockLog($datas);
        $mRs = $pharm_m->Load_Pharm_Medicine_StockLog($datas);
        if(!empty($mRs)){
            foreach ($mRs as $d){

                $t_arr = [
                    'seq' => $d['seq'],
                    'fk_hpcode' => $d['fk_hpcode'],
                    'fk_hncode' => $d['fk_hncode'],
                    'fk_micode' => $d['fk_micode'],
                    'total' => $d['total'],
                    'm_input' => $d['m_input'],
                    'm_output' => $d['m_output'],
                    'memo' => $d['memo'],
                    'reason' => $d['reason'],
                    'indate' => fn_Short_Date($d['indate']),
                    'regdate' => fn_Short_Date($d['regdate']),
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
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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
            return $this->respond(ResultDTO::fail('NoLogin', [], '로그인이 필요합니다.'));
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



































