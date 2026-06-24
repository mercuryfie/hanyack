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

    public function Search_Medicine_Pharm(){
        $sessinarr = $this->GetSessionData();
        if (!$sessinarr['islogin']) {
            return $this->respond(ResultDTO::fail('NoLog', [], '로그인이 필요합니다.'));
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
                    'hn_wname' => $d['mi_name']
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