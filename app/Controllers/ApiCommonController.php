<?php

namespace App\Controllers;

use App\DTOs\ResultDTO;
use CodeIgniter\API\ResponseTrait;

class ApiCommonController extends BaseController
{
    use ResponseTrait;

    public function Load_Herb_ListAll()
    {
        $sessinarr = $this->GetSessionData();
        $params = $this->request->getPost('params') ?? [];
        if (!is_array($params) || empty($params)) {
            return $this->respond(ResultDTO::fail('Error001', [], '올바른 데이터 형식이 아닙니다.'));
        }
        $page = $params['page'] ?? 1;
        $datas =[
            'pcnt' => $params['pcnt'] ?? 8,
            'page' => $page,
            'skey' => $params['skey'] ?? ''
        ];
        $herb_m = model('Herb_m');
        $list = [];
        $totalRs = $herb_m->Cnt_Herb_CountAll($datas);
        $hRs = $herb_m->Load_Herb_ListAll($datas);
        if (!empty($hRs)) {
            foreach ($hRs as $d) {
                $temparr = [];
                $gunPrice = $d['price']  / ($d['w_value'] / 600);
                $temparr['sn'] = $d['sn'];
                $temparr['hncode'] = $d['hn_code'];
                $temparr['fk_mdcode'] = $d['fk_mdcode'];
                $temparr['fk_mdname'] = $d['fk_mdname'];
                $temparr['fk_micode'] = $d['fk_micode'];
                $temparr['mi_name'] = $d['mi_name'];
                $temparr['fk_medicode'] = $d['fk_medicode'];
                $temparr['n_value'] = $d['n_value'];
                $temparr['t1_value'] = $d['t1_name'];
                $temparr['t2_value'] = $d['t2_name'];
                $temparr['hn_prd'] = $d['hp_code'];
                $temparr['hn_batch_no'] = $d['hn_batch_no'];
                $temparr['hn_product_date'] = $d['hn_product_date'];
                $temparr['hn_expired_date'] = $d['hn_expired_date'];
                $temparr['w_name'] = $d['w_name'];
                $temparr['w_value'] = $d['w_value'];
                $temparr['hn_name'] = $d['hn_name'];
                $temparr['hn_desc'] = $d['hn_desc'];
                $temparr['hn_isSell'] = $d['hn_isSell'];
                $temparr['hn_regdate'] = $d['hn_regdate'];
                $temparr['fname'] = $d['thumnail'];

                $temparr['gunPrice'] = $gunPrice;
                $temparr['hn_package_type'] = $d['hn_package_type'];
                $temparr['hn_package_cnt'] = $d['hn_package_cnt'];
                if($d['hn_package_type']==1){
                    $temparr['price'] = $d['price'];
                    $temparr['unitName'] = '개';
                }else{
                    $temparr['price'] = ($d['price']* $d['hn_package_cnt']);
                    $temparr['unitName'] = "Box({$d['hn_package_cnt']}ea)";
                }

                if($sessinarr['islogin']){
                    $temparr['Auth'] = $sessinarr['user']['mi_type'];
                    $temparr['hn_like'] = $herb_m->Cnt_Product_Like($d['hn_code'],$sessinarr['user']['mi_cf']);
                }else{
                    $temparr['Auth'] = '';
                    $temparr['hn_like'] = 0;
                }
                $list[] = $temparr;
            }
        }
        $i_arr = [
            'totalRs' => $totalRs,
            'list' =>  $list,
            'tcnt' => count($list),
            'nPage' => $page+1,
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }

    public function Load_Herb_ListByMain()
    {
        $sessinarr = $this->GetSessionData();
        $herb_m = model('Herb_m');
        $hot = [];
        $special = [];
        $hRs = $herb_m->Load_Herb_MainAll();
        if (!empty($hRs)) {
            foreach ($hRs as $d) {
                $temparr = [];
                $gunPrice = $d['price']  / ($d['w_value'] / 600);
                $temparr['sn'] = $d['sn'];
                $temparr['hncode'] = $d['hn_code'];
                $temparr['fk_mdcode'] = $d['fk_mdcode'];
                $temparr['fk_mdname'] = $d['fk_mdname'];
                $temparr['fk_micode'] = $d['fk_micode'];
                $temparr['mi_name'] = $d['mi_name'];
                $temparr['fk_medicode'] = $d['fk_medicode'];
                $temparr['n_value'] = $d['n_value'];
                $temparr['t1_value'] = $d['t1_name'];
                $temparr['t2_value'] = $d['t2_name'];
                $temparr['hn_prd'] = $d['hp_code'];
                $temparr['hn_batch_no'] = $d['hn_batch_no'];
                $temparr['hn_product_date'] = $d['hn_product_date'];
                $temparr['hn_expired_date'] = $d['hn_expired_date'];
                $temparr['w_name'] = $d['w_name'];
                $temparr['w_value'] = $d['w_value'];
                $temparr['hn_name'] = $d['hn_name'];
                $temparr['hn_desc'] = $d['hn_desc'];
                $temparr['hn_isSell'] = $d['hn_isSell'];
                $temparr['hn_regdate'] = $d['hn_regdate'];
                $temparr['fname'] = $d['thumnail'];

                $temparr['gunPrice'] = $gunPrice;
                $temparr['hn_package_type'] = $d['hn_package_type'];
                $temparr['hn_package_cnt'] = $d['hn_package_cnt'];
                if($d['hn_package_type']==1){
                    $temparr['price'] = $d['price'];
                    $temparr['unitName'] = '1개';
                }else{
                    $temparr['price'] = ($d['price']* $d['hn_package_cnt']);
                    $temparr['unitName'] = "{$d['hn_package_cnt']}개/박스";
                }

                if($sessinarr['islogin']){
                    $temparr['Auth'] = $sessinarr['user']['mi_type'];
                    $temparr['hn_like'] = $herb_m->Cnt_Product_Like($d['hn_code'],$sessinarr['user']['mi_cf']);
                }else{
                    $temparr['Auth'] = '';
                    $temparr['hn_like'] = 0;
                }
                if ($d['f_type'] == 1) {
                    $hot[] = $temparr;
                } else if ($d['f_type'] == 2) {
                    $special[] = $temparr;
                }
            }

            shuffle($hot);
            shuffle($special);
        }
        $i_arr = [
            'isLogin' => $sessinarr['islogin'],
            'hot' => $hot,
            'hcnt' => count($hot),
            'special' => $special,
            'scnt' => count($special)
        ];
        return $this->respond(ResultDTO::success($i_arr));
    }


}