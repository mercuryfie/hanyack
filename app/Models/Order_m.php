<?php

namespace App\Models;

use Carbon\Carbon;
use CodeIgniter\Model;
use Config\Database;

class Order_m extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect('default');
    }


    public function Update_Order_Step($sn,$step) {
        $this->db->transStart();
        $builder = $this->db->table('herb_order_goods');
        $builder->set('gd_status', $step);
        $builder->where('sn', $sn);
        $builder->update();
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

    public function Cnt_Order_Step_Check($sn, $step, $fk_micode) {
        $builder=$this->db->table('v_order_goods_info');
        $builder->where('primarysn', $sn);
        $builder->where('gd_status !=', $step);
        $builder->where('fk_micode', $fk_micode);
        return $builder->countAllResults();
    }


    public function Load_Order_Pharm_All($params,$fields=['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('v_order_goods_info');
        $builder->select($separated_val);
        $builder->where('fk_micode',$params['micode']);
        if(!empty($params['cfcode'])){
            $builder->where('fk_cfcode',$params['cfcode']);
        }
        if(!empty($params['sdate']) && !empty($params['edate'])) {
            $builder->where('od_regdate >=', $params['sdate'].' 00:00:00');
            $builder->where('od_regdate <=', $params['edate'].' 23:59:59');
        }else{
            $builder->where('delicode','');
        }
        if(!empty($params['delistatus'])){
            $builder->where('gd_status',$params['delistatus']);
        }

        $builder->orderBy('primarysn','DESC');
        $offset = ($params['page'] - 1) * $params['pcnt'];
        $builder->limit($params['pcnt'], $offset);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function Cnt_Order_Pharm_All($params){
        $builder = $this->db->table('v_order_goods_info');
        $builder->where('fk_micode',$params['micode']);
        if(!empty($params['cfcode'])){
            $builder->where('fk_cfcode',$params['cfcode']);
        }
        if(!empty($params['sdate']) && !empty($params['edate'])) {
            $builder->where('od_regdate >=', $params['sdate'].' 00:00:00');
            $builder->where('od_regdate <=', $params['edate'].' 23:59:59');
        }else{
            $builder->where('delicode','');
        }
        if(!empty($params['delistatus'])){
            $builder->where('gd_status',$params['delistatus']);
        }
        return $builder->countAllResults();
    }


    public function Load_Decoc_Goods_Match($hncode,$cfcode,$fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('herb_medicine_decoc_match');
        $builder->select($separated_val);
        $builder->where('cfcode', $cfcode);
        $builder->where('fk_hncode', $hncode);
        $builder->where('is_use', 1);
        $query = $builder->get();

        return $query->getResultArray();
    }


    public function Load_Order_Decoc_Goods($cfcode,$odcode, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('V_ORDER_GOODS_INFO');
        $builder->select($separated_val);
        $builder->where('fk_odcode', $odcode);
        $builder->where('fk_cfcode', $cfcode);
        $builder->where('gd_isdel', 0);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Distinct_Order_Decoc($params){
        $builder = $this->db->table('v_order_goods_info');
        $builder->select('fk_odcode');
        $builder->distinct();
        $builder->like('hn_name', $params['name'], 'both');
        $builder->where('fk_cfcode', $params['cfcode']);
        if(!empty($params['sdate']) && !empty($params['edate'])) {
            $builder->where('od_regdate >=', $params['sdate'].' 00:00:00');
            $builder->where('od_regdate <=', $params['edate'].' 23:59:59');
        }else{
            $builder->where('od_regdate >=', Carbon::now()->startOfDay()->toDateTimeString());
            $builder->where('od_regdate <=', Carbon::now()->endOfDay()->toDateTimeString());
        }
        $query = $builder->get();
        return $query->getResultArray();
    }


    public function Load_Order_Decoc_All($params,$distinct,$fields=['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('v_order_info');
        $builder->select($separated_val);
        $builder->where('od_cfcode', $params['cfcode']);
        if(!empty($params['sdate']) && !empty($params['edate'])) {
            $builder->where('od_regdate >=', $params['sdate'].' 00:00:00');
            $builder->where('od_regdate <=', $params['edate'].' 23:59:59');
        }else{
//            $builder->where('od_regdate >=', Carbon::now()->startOfDay()->toDateTimeString());
//            $builder->where('od_regdate <=', Carbon::now()->endOfDay()->toDateTimeString());
            $builder->where('od_status <',3);
        }
        if (!empty($distinct)) {
            $builder->whereIn('od_code', $distinct);
        }
        $builder->orderBy('sn','DESC');
        $offset = ($params['page'] - 1) * $params['pcnt'];
        $builder->limit($params['pcnt'], $offset);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function Cnt_Order_Decoc_All($params,$distinct)
    {
        $builder = $this->db->table('v_order_info');
        $builder->where('od_cfcode', $params['cfcode']);
        if(!empty($params['sdate']) && !empty($params['edate'])) {
            $builder->where('od_regdate >=', $params['sdate'].' 00:00:00');
            $builder->where('od_regdate <=', $params['edate'].' 23:59:59');
        }else{
            $builder->where('od_regdate >=', Carbon::now()->startOfDay()->toDateTimeString());
            $builder->where('od_regdate <=', Carbon::now()->endOfDay()->toDateTimeString());
        }
        if (!empty($distinct)) {
            $builder->whereIn('od_code', $distinct);
        }
        return $builder->countAllResults();
    }


    public function Insert_order_return($param){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_return');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();

        return $insertID;
    }


    public function Load_Order_Master($param,$fields=['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $where = 'order by sn DESC LIMIT :LIMIT: OFFSET :OFFSET:';


        $condition1 = ($param['decoc']!='') ? ' od_wcode=:WCODE: ' : '';
        $condition2 = ($param['pharm']!='') ? ' fk_micode=:MICODE: ' : '';

        if(($condition1!='') && ($condition2!='')){
            $condition = ' where ' . $condition1 . ' and ' . $condition2;
        }else if(($condition1!='') && ($condition2=='')){
            $condition = ' where ' . $condition1 ;
        }else if(($condition1=='') && ($condition2!='')){
            $condition = ' where ' . $condition2 ;
        }else{
            $condition = '';
        }

        $sql = "SELECT {$separated_val} from v_order_goods_info {$condition} {$where}";
        $bindparam = [
            'WCODE' => $param['decoc'],
            'MICODE' => $param['pharm'],
            'LIMIT' => $param['limit'],
            'OFFSET' => $param['offset']
        ];
        $Query = $this->db->query($sql, $bindparam);
        return $Query->getResultArray();
    }


    public function Load_Company($micode, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('herb_company');
        $builder->select($separated_val);
        $builder->where('mi_code', $micode);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Decoc_Order($param,$fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('V_ORDER_INFO');
        $builder->select($separated_val);
        $builder->where('od_cfcode', $param['cfcode']);
        $builder->orderBy('sn', 'DESC');
        $query = $builder->get($param['limit'], $param['offset']);

        return $query->getResultArray();

    }



    public function Load_Order_Page($param, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('V_ORDER_INFO');
        $builder->select($separated_val);
        $builder->where('od_micode', $param['micode']);
        $builder->orderBy('sn', 'DESC');
        $query = $builder->get($param['limit'], $param['offset']);

        return $query->getResultArray();
    }


    public function Load_Order($odcode, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('V_ORDER_INFO');
        $builder->select($separated_val);
        $builder->where('od_code', $odcode);
        $query = $builder->get();

        return $query->getResultArray();
    }


    public function Load_Order_Goods_Pharm($micode, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('V_ORDER_GOODS_INFO');
        $builder->select($separated_val);
        $builder->where('fk_micode', $micode);
        $builder->where('gd_isdel', 0);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Goods_Pharm_Page($param, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('V_ORDER_GOODS_INFO');
        $builder->select($separated_val);
        $builder->where('fk_micode', $param['micode']);
        $builder->where('gd_isdel', 0);
        //$builder->where('gd_status<', $param['step']);
        $builder->orderBy('sn', 'DESC');
        $query = $builder->get($param['limit'], $param['offset']);

        return $query->getResultArray();
    }

    public function Load_Order_Goods_IN($param, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('v_order_goods_info');
        $builder->select($separated_val);
        $builder->whereIn('sn', $param);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Goods($sn, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('v_order_goods_info');
        $builder->select($separated_val);
        $builder->where('primarysn', $sn);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Return($mitype,$code, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        if($mitype==AUTH_DECOC){
            $sql = "SELECT {$separated_val} from v_order_goods_return WHERE micode=:MICODE: order by sn desc;";
            $bindparam = [ 'MICODE' => $code];
        }else if($mitype==AUTH_PHARM){
            $sql = "SELECT {$separated_val} from v_order_goods_return WHERE wicode=:WICODE: order by sn desc;";
            $bindparam = [ 'WICODE' => $code];
        }else if($mitype==AUTH_MASTER){
            $sql = "SELECT {$separated_val} from v_order_goods_return order by sn desc;";
            $bindparam = [];
        }
        $Query = $this->db->query($sql, $bindparam);
        return $Query->getResultArray();
    }

    public function Load_Package_Goods_Active($param, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('herb_order_Package');
        $builder->select($separated_val);
        $builder->where('mi_code', $param['mi_code']);
        $builder->where('cfcode', $param['cfcode']);
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Insert_Package($param){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_Package');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();

        return $insertID;
    }

    public function Insert_Package_Goods($param){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_Package_Goods');
        $builder->insert($param);
        $insertID = $this->db->insertID();
        $this->db->transComplete();

        return $insertID;
    }

    public function Delete_Order($sn){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_goods');
        $builder->set('gd_isdel', 1);
        $builder->where('sn', $sn);
        $builder->update();
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }



    public function Update_Package_Info($pcode, $param){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_Package');
        $builder->where('pcode', $param['pcode']);
        $builder->set('t_cnt', 't_cnt+' . $param['cnt'], false);
        $builder->set('t_weight', 't_weight+' . $param['weight'], false);
        $builder->update();
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }


    public function Update_Order_Goods_Code($gd_code, $status){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_goods');
        $builder->where('gd_code', $gd_code);
        $builder->set('gd_status', $status);
        $builder->update();
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

    public function Update_Order_Goods_Sn($sn, $status){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_goods');
        $builder->where('sn', $sn);
        $builder->set('gd_status', $status);
        $builder->update();
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

    public function Update_Order_Goods($sn,$param){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_goods');
        $builder->where('sn', $sn);
        $builder->update($param);
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }

    public function Load_Order_Package_Pcode($pcode, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('herb_order_package');
        $builder->select($separated_val);
        $builder->where('pcode', $pcode);
        $builder->orderBy('sn', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Package_Pharm($micode, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('V_ORDER_PACKAGE');
        $builder->select($separated_val);
        $builder->where('mi_code', $micode);
        $builder->orderBy('sn', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Package_Decoc($wcode, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('V_ORDER_PACKAGE');
        $builder->select($separated_val);
        $builder->where('w_code', $wcode);
        $builder->where('p_type>=', 2);
        $builder->orderBy('sn', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Load_Order_Package_List($pcode, $fields = ['ALL']){
        $separated_val = fn_Make_Fields($fields);
        $builder = $this->db->table('V_ORDER_PACKAGE_LIST');
        $builder->select($separated_val);
        $builder->where('fk_pcode', $pcode);
        $builder->where('p_isDel', 0);
        $builder->orderBy('sn', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function Update_Deli_info($pcode,$param){
        $this->db->transStart();
        $builder = $this->db->table('herb_order_Package');
        $builder->where('pcode',$pcode);
        $builder->update($param);
        $affected_rows = $this->db->affectedRows();
        $this->db->transComplete();

        return $affected_rows;
    }
}
